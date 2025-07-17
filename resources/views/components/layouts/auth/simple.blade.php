<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased" style="background-image: url('/bg.jpg'); background-size: cover; background-position: center;">
    <div class="bg-background/90 backdrop-blur-xs flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <!-- Updated container with larger max-width for left-right layout -->
        <div class="flex w-full max-w-6xl flex-col gap-2">
            {{ $slot }}
        </div>
    </div>
    @fluxScripts
    </body>
</html>
