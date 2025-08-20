<x-manager.dashboard>
    <div class="flex items-center justify-between">
        <h3 class="text-xl font-medium mb-2">📄 Список файлів:</h3>
        <div class="max-w-xl">
            {{-- Форма завантаження --}}
            <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="flex">
                @csrf
                <input type="file" name="file" required class="border p-1 w-full">
                <button type="submit" class="px-3 bg-sky-700 text-white rounded hover:bg-sky-800">
                    Завантажити
                </button>
            </form>
        </div>
    </div>

    {{-- Список файлів --}}
    <div class="mt-6">

        @if (count($files) > 0)
            <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg">
                <thead class="bg-gray-100">
                    <tr class="border">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">№</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Назва документу</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Завантажено</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Дедлайн</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Завдання</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Виконаний</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Скачати</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Видалити</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($files as $file)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $file->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $file->original_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $file->created_at }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                <form action="{{ route('files.updateDueDate', $file->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="date" name="due_date" value="{{ $file->due_date }}"
                                        class="border rounded p-1 text-sm" onchange="this.form.submit()">
                                </form>
                            </td>

                            <td class="px-6 py-4 text-2xl text-gray-800"><a href="{{ route('files.task', $file) }}" class="text-blue-600" title="Додати завдання">+</td>

                            <td class="px-6 py-4 text-sm text-gray-800">
                                <form action="{{ route('files.updateDone', $file->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="checkbox" name="is_done" value="1" onchange="this.form.submit()"
                                        {{ $file->is_done ? 'checked' : '' }}>
                                </form>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-800"><a
                                    href="{{ route('files.download', $file->id) }}"
                                    class="text-blue-600 hover:underline"><x-download-icon /></a></td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                <form method="POST" action="{{ route('files.delete', $file) }}"
                                    onsubmit="return confirm('Ви впевнені, що хочете видалити цей файл?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><x-delete-icon /></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">Немає завантажених файлів.</p>
        @endif
    </div>


</x-manager.dashboard>
