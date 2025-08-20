<x-manager.dashboard>

    <div class="flex items-center gap-5 mb-4">
        <h1 class="">Список методистів</h1>
        <a href="{{ route('register') }}" title="Додати методиста"
            class="group inline-flex items-center text-sm transition-all duration-300 transform hover:scale-110 hover:text-blue-600">
            <x-add-icon class="inline-block" />
        </a>
    </div>

    <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
        <thead class="bg-gray-100">
            <tr class="border">
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">№</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Прізвище</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Завдання</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Завдань</th>
                {{-- <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Email</th> --}}
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Роль</th>
                @if (auth()->user()->role === 'admin')
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Дія</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Дія</th>
                @endif
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $user->id }}</td>

                    <td class="px-6 py-4 text-sm text-gray-800">{{ $user->lastname }}</td>

                    <td class="px-6 py-4 text-sm text-gray-800">
                        <a href="{{ route('users.tasks', $user) }}" title="Переглянути завдання"><x-eye-icon /></a>
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-800">Кількість</td>

                    {{-- <td class="px-6 py-4 text-sm text-gray-800">{{ $user->email }}</td> --}}

                    {{-- Колонка ролі --}}
                    <td class="px-6 py-4 text-sm text-gray-800">
                        @if ($user->role !== 'admin')
                            <form method="POST" action="{{ route('users.updateRole', $user->id) }}">
                                @csrf
                                @method('PATCH')
                                <select name="role" onchange="this.form.submit()" class="border p-1 rounded w-full">
                                    <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>
                                        Менеджер</option>
                                    <option value="methodist" {{ $user->role === 'methodist' ? 'selected' : '' }}>
                                        Методист</option>
                                </select>
                            </form>
                        @else
                            <span class="text-gray-500 font-semibold">Адмін</span>
                        @endif
                    </td>

                    {{-- Колонка дії --}}
                    @if (auth()->user()->role === 'admin')
                        <td class="px-6 py-4 text-sm text-gray-800">
                            @if ($user->role === 'admin')
                                <span class="text-gray-400">—</span>
                            @else
                                <a href="{{ route('users.edit', $user) }}" title="Редагувати данні користувача" class="text-blue-600"><x-edit-icon /></a>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-800">
                            @if ($user->role === 'admin')
                                <span class="text-gray-400">—</span>
                            @else
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                    onsubmit="return confirm('Видалити користувача?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Видалити користувача" class="text-red-600 hover:underline"><x-delete-icon /></button>
                                </form>
                            @endif
                    @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Користувачів не знайдено.</td>
                </tr>
            @endforelse
        </tbody>

    </table>

</x-manager.dashboard>
