@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- SIDEBAR (Integrated into Grid) -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 sticky top-24">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-blue-400 to-purple-500 shadow-inner mb-4 flex items-center justify-center text-white text-3xl font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">{{ Auth::user()->name ?? 'Caregiver' }}</h2>
                    <p class="text-slate-500 text-sm">{{ Auth::user()->email }}</p>
                    <div class="mt-2 inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-wide">
                        Caregiver
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="{{ route('caregiver.dashboard') }}" class="flex items-center w-full px-4 py-3 rounded-xl bg-blue-50 text-blue-700 font-bold transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        My Patients
                    </a>
                    <a href="#" class="flex items-center w-full px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Appointments
                    </a>
                    <a href="{{ route('profile.show') }}" class="flex items-center w-full px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        My Profile
                    </a>
                </nav>

                <div class="mt-8 pt-6 border-t border-slate-100">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-red-50 to-red-100 text-red-600 font-bold hover:from-red-100 hover:to-red-200 transition-all flex justify-center items-center">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="lg:col-span-3">
            
            <!-- STATS Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                 <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
                     <div>
                         <p class="text-slate-500 font-bold text-sm uppercase tracking-wide">Active Patients</p>
                         <h3 class="text-3xl font-extrabold text-slate-800 mt-1">{{ count($patients) }}</h3>
                     </div>
                     <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                     </div>
                 </div>
                 <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
                     <div>
                         <p class="text-slate-500 font-bold text-sm uppercase tracking-wide">Pending Requests</p>
                         <h3 class="text-3xl font-extrabold text-slate-800 mt-1">0</h3>
                     </div>
                     <div class="w-12 h-12 rounded-full bg-yellow-50 text-yellow-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                     </div>
                 </div>
                 <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
                     <div>
                         <p class="text-slate-500 font-bold text-sm uppercase tracking-wide">Appointments</p>
                         <h3 class="text-3xl font-extrabold text-slate-800 mt-1">0</h3>
                     </div>
                     <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                     </div>
                 </div>
            </div>

            <!-- Add Patient Section -->
            <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl p-8 mb-8 text-white shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                
                <h3 class="text-2xl font-bold mb-2 relative z-10">Connect with a New Patient</h3>
                <p class="text-indigo-100 mb-6 relative z-10">Enter the email address of the patient you wish to assist. They will receive a notification to approve your request.</p>

                <form action="{{ route('caregiver.request') }}" method="POST" class="relative z-10">
                    <div class="flex flex-col md:flex-row gap-4">
                        @csrf
                        <input type="email" name="email" required 
                            class="flex-grow px-6 py-4 rounded-xl text-slate-900 font-medium placeholder-slate-400 focus:ring-4 focus:ring-white/30 outline-none border-none shadow-lg"
                            placeholder="Enter patient email address (e.g., user@example.com)">
                        <button type="submit" class="px-8 py-4 rounded-xl bg-white text-indigo-700 font-bold shadow-lg hover:shadow-xl hover:bg-indigo-50 transition-all transform hover:-translate-y-1">
                            Send Request
                        </button>
                    </div>
                </form>
                @error('email')
                    <p class="text-red-200 bg-red-900/40 px-4 py-2 rounded-lg mt-4 inline-block font-bold">{{ $message }}</p>
                @enderror
                @if(session('success'))
                    <p class="text-green-300 bg-green-900/40 px-4 py-2 rounded-lg mt-4 inline-block font-bold">{{ session('success') }}</p>
                @endif
            </div>

            <!-- Patients List -->
            @if($patients->isEmpty())
                <div class="text-center py-16 border-2 border-dashed border-slate-200 rounded-3xl bg-slate-50/50">
                    <div class="text-slate-300 mb-4">
                        <svg class="w-20 h-20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700">No patients linked yet</h3>
                    <p class="text-slate-500">Send a connection request to get started.</p>
                </div>
            @else
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-slate-800">Linked Patients</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($patients as $patient)
                        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden hover:shadow-xl transition-all group">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center space-x-4">
                                        <div class="h-14 w-14 rounded-2xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg group-hover:scale-110 transition-transform">
                                            {{ substr($patient->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-slate-900 text-lg">{{ $patient->name }}</h3>
                                            <p class="text-sm text-slate-500">{{ $patient->email }}</p>
                                        </div>
                                    </div>
                                    @if($patient->pivot->status === 'active')
                                        <div class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold uppercase tracking-wide border border-green-200">
                                            Active
                                        </div>
                                    @else
                                        <div class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-bold uppercase tracking-wide border border-yellow-200">
                                            Pending
                                        </div>
                                    @endif
                                </div>

                                <div class="space-y-3">
                                    @if($patient->pivot->status === 'active')
                                        <a href="{{ route('caregiver.patient.edit', $patient) }}" 
                                        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl transition-all shadow-md hover:shadow-lg">
                                            Manage Profile
                                        </a>
                                    @else
                                        <button disabled class="w-full bg-slate-100 text-slate-400 font-bold py-3.5 px-4 rounded-xl cursor-not-allowed border border-slate-200">
                                            Waiting User Approval
                                        </button>
                                    @endif
                                    
                                    <form action="{{ route('caregiver.patient.unlink', $patient) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-red-500 hover:bg-red-50 font-bold py-3.5 px-4 rounded-xl transition-colors text-sm border border-transparent hover:border-red-100">
                                            Remove Connection
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
