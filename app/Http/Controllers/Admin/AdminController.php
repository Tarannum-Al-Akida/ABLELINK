<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class AdminController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.admin-login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Those credentials do not match our records.',
            ])->onlyInput('email');
        }

        if (! Auth::user()?->isAdmin()) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'This portal is only for admin users.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function dashboard(): View
    {
        $courseCount = 0;
        try {
            // Avoid a 500 if the courses migrations haven't been run yet.
            if (Schema::hasTable('courses')) {
                $courseCount = Course::query()->published()->count();
            }
        } catch (Throwable $e) {
            Log::warning('Admin dashboard course count failed.', [
                'error' => $e->getMessage(),
            ]);
        }

        return view('dashboards.admin', [
            'counts' => [
                'employer' => User::where('role', User::ROLE_EMPLOYER)->count(),
                'volunteer' => User::where('role', User::ROLE_VOLUNTEER)->count(),
                'disabled' => User::where('role', User::ROLE_DISABLED)->count(),
                'caregiver' => User::where('role', User::ROLE_CAREGIVER)->count(),
                'courses' => $courseCount,
            ],
            'recentUsers' => User::whereIn('role', User::COMMUNITY_ROLES)
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
