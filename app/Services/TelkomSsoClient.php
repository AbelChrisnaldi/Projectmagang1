<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Throwable;

class TelkomSsoClient
{
    /**
     * Validate campus credentials and return a normalized profile.
     *
     * @return array{username: ?string, name: ?string, email: string}|null
     */
    public function authenticate(string $identifier, string $password): ?array
    {
        if (! $this->isConfigured()) {
            return null;
        }

        try {
            $authResponse = Http::acceptJson()
                ->asMultipart()
                ->withHeaders($this->applicationHeaders())
                ->timeout($this->timeout())
                ->connectTimeout($this->connectTimeout())
                ->withoutRedirecting()
                ->post((string) config('services.telkom_sso.auth_url'), [
                    [
                        'name' => 'username',
                        'contents' => $identifier,
                    ],
                    [
                        'name' => 'password',
                        'contents' => $password,
                    ],
                ]);

            if (! $authResponse->successful()) {
                return null;
            }

            $authPayload = $authResponse->json();

            if (! is_array($authPayload)) {
                return null;
            }

            $token = $this->extractToken($authPayload);

            if ($token === null) {
                return null;
            }

            $profileResponse = Http::acceptJson()
                ->withHeaders($this->applicationHeaders())
                ->withToken($token)
                ->timeout($this->timeout())
                ->connectTimeout($this->connectTimeout())
                ->withoutRedirecting()
                ->get((string) config('services.telkom_sso.profile_url'));

            if (! $profileResponse->successful()) {
                return null;
            }

            $profilePayload = $profileResponse->json();

            return is_array($profilePayload)
                ? $this->normalizeProfile($profilePayload)
                : null;
        } catch (Throwable) {
            // Authentication failures stay generic; credentials, tokens, and profile data
            // must never be written to application logs.
            return null;
        }
    }

    private function isConfigured(): bool
    {
        if (! config('services.telkom_sso.enabled', false)) {
            return false;
        }

        foreach (['app_name', 'app_key', 'origin', 'auth_url', 'profile_url'] as $key) {
            $value = config("services.telkom_sso.{$key}");

            if (! is_string($value) || trim($value) === '') {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array<string, string>
     */
    private function applicationHeaders(): array
    {
        return [
            'X-AuthApplication-Name' => (string) config('services.telkom_sso.app_name'),
            'X-AuthApplication-Key' => (string) config('services.telkom_sso.app_key'),
            'origin' => (string) config('services.telkom_sso.origin'),
        ];
    }

    private function timeout(): int
    {
        return max(1, (int) config('services.telkom_sso.timeout', 10));
    }

    private function connectTimeout(): int
    {
        return min($this->timeout(), max(1, (int) config('services.telkom_sso.connect_timeout', 5)));
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    private function extractToken(array $payload): ?string
    {
        foreach (['token', 'access_token', 'data.token', 'data.access_token'] as $path) {
            $token = data_get($payload, $path);

            if (is_string($token) && trim($token) !== '') {
                return trim($token);
            }
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array{username: ?string, name: ?string, email: string}|null
     */
    private function normalizeProfile(array $payload): ?array
    {
        $containers = $this->profileContainers($payload);
        $email = $this->firstString($containers, ['email', 'email_address', 'emailAddress', 'mail']);

        if ($email === null || strlen($email) > 320 || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return null;
        }

        $email = strtolower($email);

        return [
            'username' => $this->firstString($containers, ['username', 'user_name', 'userName', 'login']),
            'name' => $this->firstString($containers, ['name', 'full_name', 'fullName', 'fullname', 'display_name', 'displayName']),
            'email' => $email,
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return list<array<string, mixed>>
     */
    private function profileContainers(array $payload): array
    {
        $containers = [$payload];

        foreach ([
            'data',
            'profile',
            'user',
            'result',
            'data.profile',
            'data.user',
            'data.result',
            'result.profile',
            'result.user',
            'result.data',
        ] as $path) {
            $candidate = data_get($payload, $path);

            if (is_array($candidate)) {
                $containers[] = $candidate;
            }
        }

        return $containers;
    }

    /**
     * @param  list<array<string, mixed>>  $containers
     * @param  list<string>  $keys
     */
    private function firstString(array $containers, array $keys): ?string
    {
        foreach ($containers as $container) {
            foreach ($keys as $key) {
                $value = $container[$key] ?? null;

                if (is_string($value) && trim($value) !== '') {
                    return trim($value);
                }
            }
        }

        return null;
    }
}
