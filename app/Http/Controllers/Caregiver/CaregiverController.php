<?php

namespace App\Http\Controllers\Caregiver;

use App\Http\Controllers\Controller;

use App\Models\EmergencySosEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

//F4 - Farhan Zarif
class CaregiverController extends Controller
{
    public function index()
    {
        $caregiver = Auth::user();
        
        if (!$caregiver->hasRole('caregiver')) {
            abort(403, 'Unauthorized action.');
        }

        $patients = $caregiver->patients;

        $activePatientIds = $caregiver->patients()
            ->wherePivot('status', 'active')
            ->pluck('users.id')
            ->all();

        $sosAlerts = empty($activePatientIds)
            ? collect()
            : (Schema::hasTable('emergency_sos_events') ? EmergencySosEvent::query()
                ->whereNull('resolved_at')
                ->whereIn('user_id', $activePatientIds)
                ->with(['user.profile'])
                ->latest()
                ->take(10)
                ->get() : collect());

        return view('caregiver.dashboard', compact('patients', 'sosAlerts'));
    }

    public function sendRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $caregiver = Auth::user();
        $targetUser = User::where('email', $request->email)->first();

        if (!$targetUser->hasRole('user') && !$targetUser->hasRole('disabled')) {
            throw ValidationException::withMessages([
                'email' => 'This user is not registered as a person with disability.',
            ]);
        }

        if ($caregiver->patients()->where('user_id', $targetUser->id)->exists()) {
             throw ValidationException::withMessages([
                'email' => 'You have already sent a request to this user.',
            ]);
        }

        $hasActiveCaregiver = $targetUser->caregivers()->wherePivot('status', 'active')->exists();
        if ($hasActiveCaregiver) {
             throw ValidationException::withMessages([
                'email' => 'This user already has a linked caregiver.',
            ]);
        }

        $caregiver->patients()->attach($targetUser->id, ['status' => 'pending']);

        return redirect()->back()->with('success', 'Connection request sent to ' . $targetUser->name);
    }

    public function editPatient(User $user)
    {
        $caregiver = Auth::user();

        $isLinked = $caregiver->patients()
                            ->where('user_id', $user->id)
                            ->wherePivot('status', 'active')
                            ->exists();

        if (!$isLinked) {
            abort(403, 'You are not linked to this patient.');
        }

        if (!$user->profile) {
            $user->profile()->create([]);
        }

        return view('caregiver.patient-edit', compact('user'));
    }

    public function updatePatient(Request $request, User $user)
    {
        $caregiver = Auth::user();
        
        $isLinked = $caregiver->patients()
                            ->where('user_id', $user->id)
                            ->wherePivot('status', 'active')
                            ->exists();

        if (!$isLinked) {
            abort(403, 'Unauthorized.');
        }

        $validated = $request->validate([
            'bio' => 'nullable|string|max:1000',
            'disability_type' => 'nullable|string|max:255',
            'phone_number' => 'nullable|regex:/^[0-9]+$/|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:today',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|regex:/^[0-9]+$/|max:20',
            'accessibility_preferences' => 'nullable|array',
        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'bio' => $validated['bio'],
                'disability_type' => $validated['disability_type'] ?? null,
                'phone_number' => $validated['phone_number'] ?? null,
                'address' => $validated['address'] ?? null,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
                'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
                'accessibility_preferences' => $validated['accessibility_preferences'] ?? [],
            ]
        );

        return redirect()->route('caregiver.dashboard')->with('success', 'Patient profile updated successfully.');
    }

    public function unlink(User $user)
    {
        Auth::user()->patients()->detach($user->id);
        return redirect()->back()->with('success', 'Patient removed.');
    }
}
