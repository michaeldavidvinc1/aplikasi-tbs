<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                Aplikasi TBS
            </a>

            <flux:navlist variant="outline">
                @if(auth()->user()?->role === 'PETANI')
                    <flux:navlist.group :heading="__('Menu')" class="grid">
                        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Beranda') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="briefcase" :href="route('petani.kirim.penawaran')" :current="request()->routeIs('petani.kirim.penawaran')" wire:navigate>{{ __('Kirim Penawaran') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="newspaper" :href="route('petani.riwayat.penawaran')" :current="request()->routeIs('petani.riwayat.penawaran')" wire:navigate>{{ __('Riwayat Penawaran') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="document" :href="route('petani.riwayat.pembayaran')" :current="request()->routeIs('petani.riwayat.pembayaran')" wire:navigate>{{ __('Riwayat Pembayaran') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="document-currency-dollar" :href="route('petani.salur')" :current="request()->routeIs('petani.salur')" wire:navigate>{{ __('Invoice') }}</flux:navlist.item>
                    </flux:navlist.group>
                @elseif(auth()->user()?->role === 'KOPERASI')
                    <flux:navlist.group :heading="__('Menu')" class="grid">
                        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Beranda') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="archive-box-arrow-down" :href="route('koperasi.penawaran.masuk')" :current="request()->routeIs('koperasi.penawaran.masuk')" wire:navigate>{{ __('Penawaran Masuk') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="document-check" :href="route('koperasi.transaksi.aktif')" :current="request()->routeIs('koperasi.transaksi.aktif')" wire:navigate>{{ __('Transaksi Aktif') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="banknotes" :href="route('koperasi.riwayat.pembelian')" :current="request()->routeIs('koperasi.riwayat.pembelian')" wire:navigate>{{ __('Riwayat Pembelian') }}</flux:navlist.item>
                    </flux:navlist.group>
                @elseif(auth()->user()?->role === 'ADMIN')
                    <flux:navlist.group :heading="__('Menu')" class="grid">
                        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Beranda') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="currency-dollar" :href="route('admin.harga.tbs')" :current="request()->routeIs('admin.harga.tbs')" wire:navigate>{{ __('Harga TBS') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="users" :href="route('admin.manajemen.user')" :current="request()->routeIs('admin.manajemen.user')" wire:navigate>{{ __('Manajemen User') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="archive-box" :href="route('admin.semua.penawaran')" :current="request()->routeIs('admin.semua.penawaran')" wire:navigate>{{ __('Semua Penawaran') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="shopping-bag" :href="route('login')" :current="request()->routeIs('login')" wire:navigate>{{ __('Semua Transaksi') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="wallet" :href="route('login')" :current="request()->routeIs('login')" wire:navigate>{{ __('Semua Invoice') }}</flux:navlist.item>
                    </flux:navlist.group>
                    <flux:navlist.group class="grid">
                        <flux:navlist.item icon="document-arrow-down" :href="route('login')" :current="request()->routeIs('login')" wire:navigate>{{ __('Laporan Bulanan') }}</flux:navlist.item>
                    </flux:navlist.group>
                @endif
            </flux:navlist>

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Pengaturan') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('confirmDelete', id => {
                Swal.fire({
                    title: 'Yakin mau hapus?',
                    text: "Data ini akan hilang permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteConfirmed', id)
                    }
                })
            })
        </script>
    </body>
</html>
