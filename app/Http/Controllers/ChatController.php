<?php

namespace App\Http\Controllers;

use App\Events\PrivatChat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chatPrivate(Request $request)
    {
        $request->validate([
            'to' => 'required|integer|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        $fromId = Auth::user()->id;                 // id відправника
        $fromLastName = Auth::user()->lastname;     // прізвище відправника
        $to = $request->to;                         // id отримувача
        $message = $request->message;               // Зміст сповіщення

        // створюємо подію
        PrivatChat::dispatch($fromId, $fromLastName, $to, $message);
    }
}
