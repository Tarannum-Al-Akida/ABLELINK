<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\EmergencySosEvent;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;
use Illuminate\View\View;

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
        $activeSosCount = 0;
        /** @var Collection<int, EmergencySosEvent> $activeSos */
        $activeSos = collect();

        // If migrations haven't been run yet, avoid a 500 and show zero alerts.
        if (Schema::hasTable('emergency_sos_events')) {
            $activeSosCount = EmergencySosEvent::query()
                ->whereNull('resolved_at')
                ->count();

            $activeSos = EmergencySosEvent::query()
                ->whereNull('resolved_at')
                ->with(['user.profile'])
                ->latest()
                ->take(10)
                ->get();
        }

        return view('dashboards.admin', [
            'counts' => [
                'employer' => User::where('role', User::ROLE_EMPLOYER)->count(),
                'volunteer' => User::where('role', User::ROLE_VOLUNTEER)->count(),
                'disabled' => User::where('role', User::ROLE_DISABLED)->count(),
                'caregiver' => User::where('role', User::ROLE_CAREGIVER)->count(),
            ],
            'recentUsers' => User::whereIn('role', User::COMMUNITY_ROLES)
                ->latest()
                ->take(5)
                ->get(),
            'activeSos' => $activeSos,
            'activeSosCount' => $activeSosCount,
        ]);
    }
}
