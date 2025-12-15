<?php

namespace App\Http\Controllers\Caregiver;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//F4 - Farhan Zarif
class ConnectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $requests = $user->caregivers()
                         ->wherePivot('status', 'pending')
                         ->get();

        return view('user.requests', compact('requests'));
    }

    public function approve(User $caregiver)
    {
        $user = Auth::user();

        $hasRequest = $user->caregivers()
                           ->where('caregiver_id', $caregiver->id)
                           ->wherePivot('status', 'pending')
                           ->exists();

        if (!$hasRequest) {
            abort(404, 'Request not found.');
        }

        $hasActive = $user->caregivers()
                          ->wherePivot('status', 'active')
                          ->exists();
        
        if ($hasActive) {
            return redirect()->back()->with('error', 'You already have an active caregiver. Please unlink them first.');
        }

        $user->caregivers()->updateExistingPivot($caregiver->id, ['status' => 'active']);

        return redirect()->route('dashboard')->with('success', 'Caregiver approved.');
    }

    public function deny(User $caregiver)
    {
        Auth::user()->caregivers()->detach($caregiver->id);

        return redirect()->back()->with('success', 'Request declined.');
    }
}
