<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {
            User::ROLE_DISABLED => view('dashboards.user', compact('user')),
            User::ROLE_CAREGIVER => redirect()->route('caregiver.dashboard'),
            User::ROLE_VOLUNTEER => view('dashboards.volunteer', compact('user')),
            User::ROLE_EMPLOYER => view('dashboards.employer', compact('user')),
            User::ROLE_ADMIN => redirect()->route('admin.dashboard'),
            default => view('dashboards.user', compact('user')),
        };
    }
}
