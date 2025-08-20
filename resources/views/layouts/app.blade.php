<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<x-head />

<body class="font-sans antialiased h-full">
    <div class="min-h-screen flex flex-col bg-gray-100">

        <!-- Page Heading -->
        @isset($header)
            {{ $header }}
        @endisset

        <!-- Page Content -->
        <main class="flex-1 grid grid-cols-[200px_1fr] gap-2 sm:px-3 lg:px-3 py-2">

            {{ $slot }}

            @isset($main)
                {{ $main }}
            @endisset

        </main>

        @isset($footer)
            {{ $footer }}
        @endisset
    </div>
</body>

</html>
