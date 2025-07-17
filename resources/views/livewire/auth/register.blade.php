<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
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
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Akun Anda</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Masukkan email dan password untuk daftar</p>
                </div>

                <!-- Form -->
                <form wire:submit="register" class="flex flex-col gap-6">
                    <!-- Name -->
                    <flux:input wire:model="name" :label="__('Name')" type="text" required autofocus
                        autocomplete="name" :placeholder="__('Full name')" />

                    <!-- Email Address -->
                    <flux:input wire:model="email" :label="__('Email address')" type="email" required
                        autocomplete="email" placeholder="email@example.com" />

                    <!-- Password -->
                    <flux:input wire:model="password" :label="__('Password')" type="password" required
                        autocomplete="new-password" :placeholder="__('Password')" viewable />

                    <!-- Confirm Password -->
                    <flux:input wire:model="password_confirmation" :label="__('Confirm password')" type="password"
                        required autocomplete="new-password" :placeholder="__('Confirm password')" viewable />

                    <div class="flex items-center justify-end">
                        <flux:button type="submit" variant="primary" class="w-full">
                            {{ __('Create account') }}
                        </flux:button>
                    </div>
                </form>

                <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                    {{ __('Already have an account?') }}
                    <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
                </div>
            </div>
        </div>
    </div>
</div>
