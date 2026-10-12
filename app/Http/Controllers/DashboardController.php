<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin', 'manager' => Inertia::render('Manager/Dashboard'),
            'worker' => Inertia::render('Worker/Dashboard'),
            default => Inertia::render('Dashboard'),
        };
    }
}
