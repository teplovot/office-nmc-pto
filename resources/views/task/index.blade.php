<x-manager.dashboard>

    <h1 class="text-xl mb-5">Список всіх завдань</h1>

    <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
        <thead class="bg-gray-100">
            <tr class="border">
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">№</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Завдання</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Виконавець</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Створення</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Дедлайн</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Виконання</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Прийнято</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Дія</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Дія</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($tasks as $task)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-800">{{ $task->id }}</td>

                    <td class="relative px-6 py-4 text-sm text-gray-800 group max-w-[200px]">
                        <a href="{{ route('tasks.show', $task) }}"
                            class="block overflow-hidden whitespace-nowrap text-ellipsis text-blue-700">
                            {{ strip_tags($task->description) }}
                        </a>
                        <div
                            class="absolute top-0 left-full hidden w-[500px] rounded-lg bg-white p-4 text-base text-black shadow-sm shadow-black group-hover:block">
                            {!! $task->description !!}
                        </div>
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-800">{{ $task->user->lastname }}</td>

                    <td class="px-6 py-4 text-sm text-gray-800">{{ $task->created_at }}</td>

                    <td class="px-6 py-4 text-sm text-gray-800">
                        <form action="{{ route('tasks.updateDueDate', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="date" name="due_date" value="{{ $task->due_date }}"
                                class="border rounded p-1 text-sm" onchange="this.form.submit()">
                        </form>
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-800">Виконання</td>

                    <td class="px-6 py-4 text-sm text-gray-800">
                        <form action="{{ route('tasks.updateDone', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="checkbox" name="is_done" value="1" onchange="this.form.submit()"
                                {{ $task->is_done ? 'checked' : '' }}>
                        </form>
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-800">
                        <a href="{{ route('tasks.edit', $task) }}" title="Редагувати завдання" class="text-blue-600"><x-edit-icon /></a>
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-800">
                        <form method="POST" action="{{ route('tasks.delete', $task) }}"
                            onsubmit="return confirm('Ви впевнені, що хочете видалити це завдання?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"><x-delete-icon /></button>
                        </form>
                    </td>
            @endforeach
        </tbody>

    </table>

</x-manager.dashboard>
