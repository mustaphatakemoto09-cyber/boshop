<?php

declare(strict_types=1);

namespace App\Data\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelData\Data;

final class LoginData extends Data
{
    public function __construct(
        #[\Spatie\LaravelData\Attributes\Validation\Required, \Spatie\LaravelData\Attributes\Validation\StringType, \Spatie\LaravelData\Attributes\Validation\Email]
        public string $email,

        #[\Spatie\LaravelData\Attributes\Validation\Required, \Spatie\LaravelData\Attributes\Validation\StringType]
        public string $password,
    ) {}

    /**
     * Validate the credentials and return the user without logging them in.
     *
     * @throws ValidationException
     */
    public function validateCredentials(): User
    {
        $this->ensureIsNotRateLimited();

        /** @var User|null $user */
        $user = Auth::getProvider()->retrieveByCredentials([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if (! $user || ! Auth::getProvider()->validateCredentials($user, ['password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

        return $user;
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        // Lockout event expects an instance of \Illuminate\Http\Request
        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate-limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return mb_strtolower($this->email).'|'.request()->ip();
    }
}
