<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Auth;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all(); // Отримати всіх користувачів
        return view('user.index', compact('users'));
    }

    public function userTasks(User $user): View
    {
        $tasks = User::find($user->id)->tasks;
        return view('user.task', compact('tasks', 'user'));
    }

    public function edit(User $user): View
    {
        return view('user.edit', compact('user'));
    }


    public function updateName(Request $request, $id): RedirectResponse
    {
        // Отримуємо користувача за ID
        $user = User::findOrFail($id);

        // Валідація даних
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // додайте інші поля, якщо потрібно
        ]);

        // Заповнюємо модель валідованими даними
        $user->fill($validated);

        // Якщо змінився email, скидати підтвердження
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Редирект назад на редагування користувача або на список
        return redirect()->route('users.edit', $user->id)
            ->with('success', 'Користувача оновлено!');
    }


    public function updatePassword(Request $request, $id): RedirectResponse
    {
        // Отримуємо користувача за ID
        $user = User::findOrFail($id);

        // Валідація
        $validated = $request->validateWithBag('updatePassword', [
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Оновлюємо пароль користувача по id
        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->route('users.edit', $user->id)
            ->with('success', 'Пароль оновлено!');
    }


    // Метод для оновлення ролі
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:manager,methodist',
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Роль користувача оновлено.');
    }

    // Метод для видалення користувача
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'Користувача видалено.');
    }
}
