<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public $users;
    public $authId;
    public $csrfToken;

    public function __construct()
    {
        $this->authId = Auth::id();
        $this->csrfToken = csrf_token(); // отримуємо CSRF
        // Отримуємо всіх користувачів крім себе
        $this->users = User::where('id', '!=', $this->authId)
            ->get(['id', 'name']);
    }

    public function render()
    {
        return view('components.chat');
    }
}

