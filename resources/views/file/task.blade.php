<x-manager.dashboard>

    <h1 class="text-xl mb-5">Документ</h1>

    <div class="flex items-center gap-5 mb-5">
        <p>Назва: {{ $file->original_name }}</p>
        <div><a href="{{ route('files.download', $file->id) }}" class="text-blue-600 hover:underline"
                title="скачати"><x-download-icon /></a>
        </div>
    </div>

    <form method="POST" action="#">
        @csrf

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                Опис завдання
            </label>

            <!-- Контейнер текстового редактора Quill підключаємо через js -->
            <div id="editor" class="bg-white border rounded p-2" style="min-height: 400px;"></div>

            <!-- Сховане поле для відправки HTML в БД -->
            <input type="hidden" name="description" id="description">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
            Зберегти
        </button>
    </form>

</x-manager.dashboard>
