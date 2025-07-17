<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $role = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $isValid = \App\Models\User::checkRoles($this->role, $this->email);

        if (!$isValid) {
            toastr()->error('Email atau role tidak cocok!');
            return;
        }

        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        if (Auth::user()->role == 'PETANI') {
            $this->redirectIntended(default: route('petani.dashboard', absolute: false), navigate: true);
        } elseif (Auth::user()->role == 'KOPERASI') {
            $this->redirectIntended(default: route('koperasi.dashboard', absolute: false), navigate: true);
        } elseif (Auth::user()->role == 'PIMPINAN') {
            $this->redirectIntended(default: route('pimpinan.dashboard', absolute: false), navigate: true);
        } else {
            $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
        }
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

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
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

<div class="flex flex-col lg:flex-row w-full ">
    <!-- Left Side - Title -->
    <div class="flex-1 flex items-center justify-center p-6 bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800">
        <div class="text-center lg:text-left rounded-2xl p-8 ">
            <h1 class="text-white text-xl md:text-2xl lg:text-3xl font-bold leading-tight mb-4">
                SISTEM INFORMASI PEMBELIAN TBS PADA KOPERASI PRODUSEN TUNAS MUDA BERBASIS WEB
            </h1>
            <p class="text-white/90 text-lg hidden lg:block">
                Solusi digital untuk manajemen pembelian TBS yang efisien dan transparan
            </p>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="flex-1 flex items-center justify-center bg-white">
        <div class="w-full max-w-md  dark:bg-neutral-800/90 rounded-xl p-8 ">
            <div class="space-y-6">
                <!-- Header -->
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Masuk ke Akun Anda</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Masukkan email dan password untuk login</p>
                </div>

                <!-- Form -->
                <form wire:submit="login" class="flex flex-col gap-6">
                    <!-- Email Address -->
                    <flux:input wire:model="email" :label="__('Email address')" type="email" required autofocus
                        autocomplete="email" placeholder="email@example.com" />

                    <!-- Role -->
                    <div class="relative">
                        <flux:select wire:model="role" :label="__('Role')" required
                            class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">{{ __('Role') }}</option>
                            <option value="ADMIN">Admin</option>
                            <option value="PETANI">Petani</option>
                            <option value="KOPERASI">Koperasi</option>
                            <option value="PIMPINAN">Pimpinan</option>
                        </flux:select>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <flux:input wire:model="password" :label="__('Password')" type="password" required
                            autocomplete="current-password" :placeholder="__('Password')" viewable />
                    </div>

                    <div class="flex items-center justify-end">
                        <flux:button variant="primary" type="submit" class="w-full">{{ __('Log in') }}</flux:button>
                    </div>
                </form>

                @if (Route::has('register'))
                    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                        {{ __('Don\'t have an account?') }}
                        <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
