<x-app-layout>
    <x-slot name="header">
        <x-header />
    </x-slot>

    <x-slot name="main">
        <aside class="bg-white p-6 text-gray-900 sm:rounded-lg">
            <nav>
                <ul class="space-y-2">
                    <li><a href="{{ route('users.index') }}" class="block px-2 py-1 rounded-md text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">Методисти</a></li>
                    <li><a href="{{ route('files.index') }}" class="block px-2 py-1 rounded-md text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">Документи</a></li>
                    <li><a href="{{ route('tasks.index') }}" class="block px-2 py-1 rounded-md text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition">Завдання</a></li>
                </ul>
            </nav>
        </aside>
        <section class="bg-white p-6 text-gray-900 sm:rounded-lg">
            {{ $slot }}
        </section>
    </x-slot>

    <x-slot name="footer">
        <x-chat />
        <x-footer />
    </x-slot>
</x-app-layout>
