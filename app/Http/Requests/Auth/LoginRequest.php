<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan untuk request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validasi input login.
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Jalankan proses autentikasi.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Authentikasi berdasarkan username dan password
        if (! Auth::attempt($this->only(['username', 'password']), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Batasi percobaan login (rate limiting).
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Key unik untuk rate limiter berdasarkan username & IP.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower((string) $this->input('username')).'|'.$this->ip());
    }
}
