<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased" style="background-image: url('/bg.jpg'); background-size: cover; background-position: center;">
    <div class="bg-background/90 backdrop-blur-xs flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-sm flex-col gap-2">
            <div class="bg-white dark:bg-neutral-800/90 rounded-xl p-6 shadow-lg">
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
    </body>
</html>
