@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-green-800 font-bold">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-red-800 font-bold">
            {{ session('error') }}
        </div>
    @endif
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- LEFT COLUMN: Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 sticky top-24 text-center relative overflow-hidden">
                <!-- Decorative Top Gradient -->
                <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-br from-blue-500 to-purple-600 opacity-10"></div>
                
                <div class="relative z-10">
                    <!-- Avatar -->
                    <div class="relative inline-block mb-6">
                        @if($user->profile && $user->profile->avatar)
                            <img src="{{ asset('storage/' . $user->profile->avatar) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg mx-auto">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-100 to-purple-400 flex items-center justify-center text-4xl font-bold text-white border-4 border-white shadow-lg mx-auto shadow-indigo-200">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="absolute bottom-1 right-1 w-6 h-6 bg-green-400 border-4 border-white rounded-full"></div>
                    </div>

                    <h1 class="text-2xl font-extrabold text-slate-900 mb-1 tracking-tight">{{ $user->name }}</h1>
                    <p class="text-slate-500 font-medium mb-4">{{ $user->email }}</p>

                    <span class="inline-block px-4 py-1.5 rounded-full bg-blue-50 text-blue-700 text-sm font-bold uppercase tracking-wider mb-8 border border-blue-100">
                        {{ ucfirst($user->role) }}
                    </span>

                    <div class="space-y-3">
                        <a href="{{ route('profile.edit') }}" class="flex items-center justify-center w-full px-6 py-4 rounded-xl bg-slate-900 text-white font-bold shadow-lg shadow-slate-200 hover:bg-slate-800 hover:shadow-xl hover:-translate-y-0.5 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Edit Profile
                        </a>
                        <a href="{{ route('accessibility.edit') }}" class="flex items-center justify-center w-full px-6 py-4 rounded-xl bg-white border-2 border-slate-100 text-slate-700 font-bold hover:border-purple-200 hover:bg-purple-50 hover:text-purple-700 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                            Accessibility Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Details -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- BIOGRAPHY -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 relative overflow-hidden">
                <div class="flex items-center mb-6 relative z-10">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl mr-4 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">About Me</h3>
                        <p class="text-sm text-slate-500">A little bit about yourself</p>
                    </div>
                </div>
                
                @if($user->profile && $user->profile->bio)
                    <p class="text-slate-600 leading-relaxed text-lg relative z-10">{{ $user->profile->bio }}</p>
                @else
                    <div class="bg-slate-50 rounded-2xl p-8 text-center border-2 border-dashed border-slate-200 relative z-10 group hover:border-blue-300 transition-colors">
                        <div class="text-slate-300 mb-3 group-hover:text-blue-300 transition-colors">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <p class="text-slate-500 font-medium mb-2">No biography provided yet.</p>
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center text-blue-600 font-bold hover:underline">
                            Add a bio to your profile
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @endif
            </div>

            <!-- PERSONAL INFO GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Phone -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Phone Number</p>
                    </div>
                    <p class="text-lg font-bold text-slate-900 pl-13">
                        @if($user->profile && $user->profile->phone_number)
                            {{ $user->profile->phone_number }}
                        @else
                            <span class="text-slate-400 italic font-normal">Not provided</span>
                        @endif
                    </p>
                </div>

                <!-- DOB -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Date of Birth</p>
                    </div>
                    <p class="text-lg font-bold text-slate-900">
                        @if($user->profile && $user->profile->date_of_birth)
                            {{ \Carbon\Carbon::parse($user->profile->date_of_birth)->format('F j, Y') }}
                        @else
                           <span class="text-slate-400 italic font-normal">Not provided</span>
                        @endif
                    </p>
                </div>

                <!-- Disability Info -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-cyan-50 text-cyan-600 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Disability Type</p>
                    </div>
                    <p class="text-lg font-bold text-slate-900">
                        @if($user->profile && $user->profile->disability_type)
                            {{ $user->profile->disability_type }}
                        @else
                            <span class="text-slate-400 italic font-normal">Not specified</span>
                        @endif
                    </p>
                </div>

                <!-- Address -->
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Address</p>
                    </div>
                    <p class="text-lg font-bold text-slate-900">
                        @if($user->profile && $user->profile->address)
                            {{ $user->profile->address }}
                        @else
                            <span class="text-slate-400 italic font-normal">Not provided</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- EMERGENCY CONTACT -->
            <div class="bg-red-50 rounded-3xl p-8 border border-red-100 relative overflow-hidden group hover:border-red-200 transition-colors">
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-100 rounded-full blur-3xl -mr-16 -mt-16 opacity-50 group-hover:opacity-100 transition-opacity"></div>
                
                <div class="flex items-start relative z-10">
                    <div class="p-3 bg-red-100 text-red-600 rounded-xl mr-4 flex-shrink-0 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M12 12h.01M12 6h.01M12 12a9 9 0 110-18 9 9 0 010 18z"></path></svg>
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between items-start">
                            <div class="mb-2">
                                <h3 class="text-lg font-bold text-red-900 mb-1">Emergency Contact</h3>
                                <p class="text-red-700/80 text-sm">Primary contact in case of emergency</p>
                            </div>
                            @if(!$user->profile || !$user->profile->emergency_contact_name)
                                <a href="{{ route('profile.edit') }}" class="text-xs bg-white/50 hover:bg-white text-red-600 px-3 py-1 rounded-full font-bold transition-colors">Setup Now</a>
                            @endif
                        </div>
                        
                        @if($user->profile && $user->profile->emergency_contact_name)
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Contact Name -->
                                <div class="bg-white p-4 rounded-2xl border border-red-100 shadow-sm flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-red-50 text-red-500 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-red-400 uppercase tracking-wider">Name</p>
                                        <p class="text-lg font-bold text-slate-900">{{ $user->profile->emergency_contact_name }}</p>
                                    </div>
                                </div>

                                <!-- Contact Phone -->
                                @if($user->profile->emergency_contact_phone)
                                <div class="bg-white p-4 rounded-2xl border border-red-100 shadow-sm flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-red-50 text-red-500 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-red-400 uppercase tracking-wider">Phone</p>
                                        <p class="text-lg font-bold text-slate-900">{{ $user->profile->emergency_contact_phone }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        @else
                            <div class="mt-4 bg-white/50 rounded-xl p-6 border border-dashed border-red-200 text-center">
                                <p class="text-red-400 italic font-medium mb-3">No emergency contact information provided.</p>
                                <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm font-bold hover:bg-red-200 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Add Contact
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @if($user->role === \App\Models\User::ROLE_DISABLED)
            <!-- EMERGENCY SOS -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 relative overflow-hidden">
                <div class="flex items-center mb-6">
                    <div class="p-3 bg-red-50 text-red-600 rounded-xl mr-4 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 100 20 10 10 0 000-20zM12 8v4m0 4h.01"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">Emergency SOS</h3>
                        <p class="text-sm text-slate-500">One-touch alert to your caregiver & admin with your location</p>
                    </div>
                </div>

                <form id="sos-form" action="{{ route('sos.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="latitude" id="sos-latitude" value="">
                    <input type="hidden" name="longitude" id="sos-longitude" value="">
                    <input type="hidden" name="accuracy_m" id="sos-accuracy" value="">
                    <input type="hidden" name="address" id="sos-address" value="">
                    <input type="hidden" name="notes" id="sos-notes" value="SOS triggered from profile.">

                    <div class="flex flex-col md:flex-row gap-4 items-start md:items-center">
                        <button type="button" id="sos-button"
                                class="w-full md:w-auto inline-flex items-center justify-center px-8 py-5 rounded-2xl bg-red-600 text-white font-extrabold shadow-lg hover:bg-red-700 hover:shadow-xl transition-all">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 100 20 10 10 0 000-20zM12 8v4m0 4h.01"></path></svg>
                            Send SOS
                        </button>

                        <div class="text-sm text-slate-600">
                            <p class="font-bold text-slate-900">Tip:</p>
                            <p>Allow location permission for accurate help.</p>
                            <p id="sos-status" class="mt-1 text-slate-500"></p>
                        </div>
                    </div>

                    @if($errors->any())
                        <p class="mt-4 text-sm text-red-600 font-bold">Unable to send SOS. Please try again.</p>
                    @endif
                </form>
            </div>
            @endif

        </div>
    </div>
</div>

<script>
(() => {
  const btn = document.getElementById('sos-button');
  const form = document.getElementById('sos-form');
  const status = document.getElementById('sos-status');
  if (!btn || !form) return;

  const setStatus = (text) => { if (status) status.textContent = text || ''; };

  const submitWith = (coords) => {
    const lat = document.getElementById('sos-latitude');
    const lng = document.getElementById('sos-longitude');
    const acc = document.getElementById('sos-accuracy');
    const address = document.getElementById('sos-address');

    if (coords && typeof coords.latitude === 'number' && typeof coords.longitude === 'number') {
      lat.value = coords.latitude;
      lng.value = coords.longitude;
      acc.value = coords.accuracy ? Math.round(coords.accuracy) : '';
      address.value = '';
    }

    form.submit();
  };

  btn.addEventListener('click', () => {
    btn.disabled = true;
    btn.classList.add('opacity-70', 'cursor-not-allowed');
    setStatus('Getting your location…');

    if (!navigator.geolocation) {
      setStatus('Location not supported. Sending SOS without location…');
      submitWith(null);
      return;
    }

    navigator.geolocation.getCurrentPosition(
      (pos) => {
        setStatus('Location captured. Sending SOS…');
        submitWith(pos.coords);
      },
      () => {
        setStatus('Location permission denied/unavailable. Sending SOS without location…');
        submitWith(null);
      },
      { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
    );
  });
})();
</script>
@endsection
