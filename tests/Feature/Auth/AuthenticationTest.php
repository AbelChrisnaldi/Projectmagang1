<?php

use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertSee('Email lokal');
    $response->assertDontSee('Username SSO Tel-U / Email lokal');
});

test('login screen advertises Tel-U SSO only when it is configured', function () {
    config()->set([
        'services.telkom_sso.enabled' => true,
        'services.telkom_sso.app_key' => 'test-app-key',
    ]);

    $response = $this->get('/login');

    $response->assertOk();
    $response->assertSee('Username SSO Tel-U / Email lokal');
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();
    Http::fake();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
    Http::assertNothingSent();
});

test('existing users can authenticate through Tel-U SSO', function () {
    $user = User::factory()->create(['email' => 'dosen@telkomuniversity.ac.id']);

    config()->set([
        'services.telkom_sso.enabled' => true,
        'services.telkom_sso.app_key' => 'test-app-key',
        'services.telkom_sso.local_fallback' => true,
    ]);

    Http::fake([
        config('services.telkom_sso.auth_url') => Http::response([
            'data' => ['access_token' => 'test-access-token'],
        ]),
        config('services.telkom_sso.profile_url') => Http::response([
            'profile' => [
                'username' => 'dosen.sso',
                'name' => 'Dosen SSO',
                'email' => $user->email,
            ],
        ]),
    ]);

    $response = $this->post('/login', [
        'email' => 'dosen.sso',
        'password' => 'campus-password',
    ]);

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect(route('dashboard', absolute: false));
    Http::assertSentCount(2);
    Http::assertSent(fn (Request $request): bool => $request->url() === config('services.telkom_sso.auth_url')
        && $request->method() === 'POST'
        && $request->isMultipart()
        && collect($request->data())->pluck('name')->all() === ['username', 'password']
        && $request->hasHeader('X-AuthApplication-Name', config('services.telkom_sso.app_name'))
        && $request->hasHeader('X-AuthApplication-Key', 'test-app-key')
        && $request->hasHeader('origin', config('services.telkom_sso.origin'))
    );
    Http::assertSent(fn (Request $request): bool => $request->url() === config('services.telkom_sso.profile_url')
        && $request->method() === 'GET'
        && $request->hasHeader('Authorization', 'Bearer test-access-token')
    );
});

test('Tel-U SSO does not provision users with an unknown email', function () {
    config()->set([
        'services.telkom_sso.enabled' => true,
        'services.telkom_sso.app_key' => 'test-app-key',
        'services.telkom_sso.local_fallback' => true,
    ]);

    Http::fake([
        config('services.telkom_sso.auth_url') => Http::response(['token' => 'test-token']),
        config('services.telkom_sso.profile_url') => Http::response([
            'data' => [
                'username' => 'unknown.user',
                'name' => 'Unknown User',
                'email' => 'unknown@telkomuniversity.ac.id',
            ],
        ]),
    ]);

    $response = $this->from('/login')->post('/login', [
        'email' => 'unknown.user',
        'password' => 'campus-password',
    ]);

    $this->assertGuest();
    $response->assertRedirect('/login');
    $response->assertSessionHasErrors('email');
    expect(User::query()->where('email', 'unknown@telkomuniversity.ac.id')->exists())->toBeFalse();
    Http::assertSentCount(2);
});

test('Tel-U SSO rejects ambiguous case-variant local emails', function () {
    User::factory()->create(['email' => 'Dosen@telkomuniversity.ac.id']);
    User::factory()->create(['email' => 'dosen@telkomuniversity.ac.id']);

    config()->set([
        'services.telkom_sso.enabled' => true,
        'services.telkom_sso.app_key' => 'test-app-key',
        'services.telkom_sso.local_fallback' => false,
    ]);

    Http::fake([
        config('services.telkom_sso.auth_url') => Http::response(['token' => 'test-token']),
        config('services.telkom_sso.profile_url') => Http::response([
            'data' => [
                'username' => 'dosen.sso',
                'email' => 'dosen@telkomuniversity.ac.id',
            ],
        ]),
    ]);

    $response = $this->from('/login')->post('/login', [
        'email' => 'dosen.sso',
        'password' => 'campus-password',
    ]);

    $this->assertGuest();
    $response->assertRedirect('/login')->assertSessionHasErrors('email');
});

test('disabled Tel-U SSO never calls the campus API', function () {
    config()->set([
        'services.telkom_sso.enabled' => false,
        'services.telkom_sso.app_key' => 'test-app-key',
        'services.telkom_sso.local_fallback' => false,
    ]);
    Http::fake();

    $this->post('/login', [
        'email' => 'dosen.sso',
        'password' => 'campus-password',
    ]);

    $this->assertGuest();
    Http::assertNothingSent();
});

test('Tel-U SSO without an app key never calls the campus API', function () {
    config()->set([
        'services.telkom_sso.enabled' => true,
        'services.telkom_sso.app_key' => '',
        'services.telkom_sso.local_fallback' => false,
    ]);
    Http::fake();

    $this->post('/login', [
        'email' => 'dosen.sso',
        'password' => 'campus-password',
    ]);

    $this->assertGuest();
    Http::assertNothingSent();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->from('/login')->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
    $response->assertRedirect('/login')->assertSessionHasErrors('email');

    $this->get('/login')
        ->assertSee('Email/username atau password tidak sesuai. Silakan coba lagi.')
        ->assertDontSee('auth.failed');
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
