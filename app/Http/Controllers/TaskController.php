<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::all(); // Отримати всі завдання
        return view('task.index', compact('tasks'));
    }

    public function edit(Task $task): View
    {
        $user = $task->user;
        return view('task.edit', compact('task', 'user'));
    }


    public function create(User $user): View
    {
        return view('task.create', compact('user'));
    }


    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        Task::create([
            'description' => $validated['description'],
            'user_id' => $user->id,
        ]);

        return redirect()->route('users.tasks', compact('user'))->with('success', 'Завдання додано!');
    }



    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        // Оновлюємо опис завдання
        $task->description = $validated['description'];
        $task->save();
        $user = $task->user;

        return redirect()->route('users.tasks', compact('user'))
            ->with('success', 'Завдання відредаговано!');
    }

    // Вказуємо дату до якої виконати (дедлайн)
    public function updateDueDate(Request $request, Task $task)
    {
        $request->validate([
            'due_date' => 'nullable|date',
        ]);

        $task->due_date = $request->due_date;
        $task->save();

        return back()->with('success', 'Дата виконання оновлена');
    }

    public function show(Task $task): View
    {
        return view('task.show', compact('task'));
    }

    // Додавання галочки виконано
    public function updateDone(Request $request, Task $task)
    {
        $task->is_done = $request->has('is_done');
        $task->save();

        return back();
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Завдання успішно видалено.');
    }
}
