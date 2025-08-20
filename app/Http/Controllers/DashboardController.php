<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $role = Auth::user()->role;

        if ($role === 'manager' || $role === 'admin') {
            $users = User::all();
            return view('manager.index', compact('users'));
        }

        if ($role === 'methodist') {
            $users = User::all();
            return view('methodist.index', compact('users'));
        }

        return view('welcome');
    }
}
