<x-manager.dashboard>
    <h1 class="text-2xl mb-5">Редагувати завдання №{{ $task->id }}</h1>

    <p class="pb-5">Виконавець: {{ $task->user->lastname }}</p>

    <div class="pb-5 flex gap-6 items-center"><p>Дедлайн:</p>
        <form action="{{ route('tasks.updateDueDate', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="date" name="due_date" value="{{ $task->due_date }}" class="border rounded p-1 text-sm"
                onchange="this.form.submit()">
        </form>
    </div>

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                Опис завдання
            </label>

            <!-- Контейнер текстового редактора Quill підключаємо через js -->
            <div id="editor" class="bg-white border rounded p-2" style="min-height: 400px;">
                {!! $task->description !!}
            </div>

            <!-- Сховане поле для відправки HTML в БД -->
            <input type="hidden" name="description" id="description">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
            Зберегти
        </button>
    </form>
</x-manager.dashboard>
