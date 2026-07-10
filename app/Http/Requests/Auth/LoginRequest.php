<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Services\TelkomSsoClient;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(TelkomSsoClient $ssoClient): void
    {
        $this->ensureIsNotRateLimited();

        $identifier = trim((string) $this->input('email'));
        $password = (string) $this->input('password');
        $remember = $this->boolean('remember');

        if (config('services.telkom_sso.local_fallback', true)
            && Auth::attempt(['email' => $identifier, 'password' => $password], $remember)) {
            RateLimiter::clear($this->throttleKey());

            return;
        }

        $profile = $ssoClient->authenticate($identifier, $password);

        if ($profile !== null) {
            $email = Str::lower($profile['email']);
            $matches = User::query()
                ->whereRaw('LOWER(email) = ?', [$email])
                ->limit(2)
                ->get();
            $user = $matches->count() === 1 ? $matches->first() : null;

            if ($user !== null && hash_equals(Str::lower((string) $user->email), $email)) {
                Auth::guard('web')->login($user, $remember);
                RateLimiter::clear($this->throttleKey());

                return;
            }
        }

        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        $identifier = Str::lower(trim((string) $this->input('email')));

        return Str::transliterate($identifier.'|'.$this->ip());
    }
}
