<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $loggedInUserId = Auth::id(); // Mendapatkan ID user yang sedang login

        $users = User::where('id', '!=', $loggedInUserId)->get();
        return view('dashboard', compact('users'));
    }
}
