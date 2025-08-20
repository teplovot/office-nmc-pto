<x-manager.dashboard>

    <h1 class="text-xl mb-5">Завдання №{{ $task->id }}</h1>

    <div class="text-xl mb-5">
        <p class="text-sm flex items-center gap-4"><span class="font-medium">Створено:</span>{{ $task->created_at }}</p>
    </div>

    <div class="text-xl mb-5">
        <p class="text-sm flex items-center gap-4"><span class="font-medium">Дедлайн:</span>{{ $task->due_date }}</p>
    </div>

    <div class="flex gap-4 items-center mb-5">
        <p class="font-medium text-sm">Прийнято:</p>
        <form action="{{ route('tasks.updateDone', $task) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="checkbox" name="is_done" value="1" onchange="this.form.submit()"
                {{ $task->is_done ? 'checked' : '' }}>
        </form>
    </div>

    <p class="mb-2 font-medium text-sm">Зміст завдання</p>
    <div class="border rounded p-5">
        {!! $task->description !!}
    </div>

</x-manager.dashboard>
