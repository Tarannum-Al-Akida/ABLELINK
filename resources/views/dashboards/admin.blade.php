@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- SIDEBAR -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6 sticky top-24">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-slate-700 to-slate-900 shadow-inner mb-4 flex items-center justify-center text-white text-3xl font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">{{ Auth::user()->name ?? 'Admin' }}</h2>
                    <p class="text-slate-500 text-sm">{{ Auth::user()->email }}</p>
                    <div class="mt-2 inline-block px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold uppercase tracking-wide">
                        Administrator
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="#" class="flex items-center w-full px-4 py-3 rounded-xl bg-slate-50 text-slate-800 font-bold transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center w-full px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Users
                    </a>
                    <a href="#" class="flex items-center w-full px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Volunteers
                    </a>
                     <a href="#" class="flex items-center w-full px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Employers
                    </a>
                    <a href="#" class="flex items-center w-full px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        Jobs
                    </a>
                    <a href="#" class="flex items-center w-full px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Learning Hub
                    </a>
                    <a href="#" class="flex items-center w-full px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-50 font-medium transition-all">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Community
                    </a>
                   
                </nav>

                <div class="mt-8 pt-6 border-t border-slate-100">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-red-600 to-red-700 text-white font-bold hover:from-red-700 hover:to-red-800 transition-all flex justify-center items-center shadow-md">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="lg:col-span-3">
             <!-- HEADER -->
             <div class="flex justify-between items-end mb-8">
                <div>
                    <h3 class="text-2xl font-extrabold text-slate-900">Admin Overview</h3>
                    <p class="text-slate-500 font-medium uppercase tracking-wide text-xs">PLATFORM DASHBOARD</p>
                </div>
                <button class="px-6 py-3 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold shadow-lg hover:shadow-xl transition-all animate-pulse">
                    Emergency Mode
                </button>
            </div>

            <!-- TOP STATS -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                 <!-- Total Users -->
                 <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-all">
                     <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Total Users</p>
                     <h3 class="text-3xl font-extrabold text-slate-800">{{ array_sum($counts) }}</h3>
                 </div>

                 <!-- Volunteers -->
                 <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-all">
                     <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Active Volunteers</p>
                     <h3 class="text-3xl font-extrabold text-slate-800">{{ $counts['volunteer'] }}</h3>
                 </div>

                 <!-- Employers -->
                 <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-all">
                     <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Employers</p>
                     <h3 class="text-3xl font-extrabold text-slate-800">{{ $counts['employer'] }}</h3>
                 </div>

                 <!-- Emergency Alerts -->
                 <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center hover:shadow-md transition-all">
                     <p class="text-xs font-bold text-red-400 uppercase tracking-wider mb-2">Emergency Alerts</p>
                     <h3 class="text-3xl font-extrabold text-red-600">{{ $activeSosCount ?? 0 }}</h3>
                 </div>
            </div>

            <!-- ACTIVE SOS ALERTS -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 mb-8">
                <div class="flex items-center justify-between mb-4 border-b border-slate-100 pb-3">
                    <div>
                        <h5 class="text-lg font-bold text-slate-800">Active SOS Alerts</h5>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Newest first</p>
                    </div>
                    <div class="px-3 py-1 rounded-full bg-red-50 text-red-700 text-xs font-bold border border-red-100">
                        {{ $activeSosCount ?? 0 }} Active
                    </div>
                </div>

                @if(empty($activeSos) || $activeSos->isEmpty())
                    <div class="text-slate-500 font-medium">No active SOS alerts right now.</div>
                @else
                    <div class="space-y-4">
                        @foreach($activeSos as $event)
                            <div class="rounded-2xl border border-red-100 bg-red-50/40 p-5">
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-red-700 uppercase tracking-wide">SOS</p>
                                        <p class="text-lg font-extrabold text-slate-900 truncate">
                                            {{ $event->user?->name ?? 'Unknown user' }}
                                        </p>
                                        <p class="text-sm text-slate-600">
                                            <span class="font-bold">Email:</span> {{ $event->user?->email ?? 'N/A' }}
                                            @if($event->user && $event->user->profile && $event->user->profile->phone_number)
                                                <span class="mx-2 text-slate-300">|</span>
                                                <span class="font-bold">Phone:</span> {{ $event->user->profile->phone_number }}
                                            @endif
                                        </p>
                                        <p class="text-sm text-slate-600 mt-1">
                                            <span class="font-bold">Time:</span> {{ $event->created_at?->format('M j, Y g:i A') }}
                                        </p>

                                        <div class="mt-3 text-sm text-slate-700 space-y-1">
                                            @if($event->latitude !== null && $event->longitude !== null)
                                                <p>
                                                    <span class="font-bold">Location:</span>
                                                    {{ $event->latitude }}, {{ $event->longitude }}
                                                    @if($event->accuracy_m)
                                                        <span class="text-slate-500">(±{{ $event->accuracy_m }}m)</span>
                                                    @endif
                                                </p>
                                                <p>
                                                    <a class="text-blue-700 font-bold hover:underline"
                                                       target="_blank"
                                                       href="https://www.google.com/maps?q={{ $event->latitude }},{{ $event->longitude }}">
                                                        Open in Google Maps
                                                    </a>
                                                </p>
                                            @elseif($event->address)
                                                <p><span class="font-bold">Address:</span> {{ $event->address }}</p>
                                            @else
                                                <p class="text-slate-500 italic">No location provided (permission denied/unavailable).</p>
                                            @endif

                                            @if($event->notes)
                                                <p><span class="font-bold">Notes:</span> {{ $event->notes }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex-shrink-0">
                                        <form method="POST" action="{{ route('admin.sos.resolve', $event) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="w-full md:w-auto px-5 py-3 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 transition-all">
                                                Mark Resolved
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- USER ACTIVITY + JOB PLATFORM -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
                    <h5 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">User Activity</h5>
                    <ul class="space-y-3">
                        <li class="flex justify-between text-slate-600 font-medium">New Users Today: <span class="font-bold text-slate-900">0</span></li>
                        <li class="flex justify-between text-slate-600 font-medium">Active Users: <span class="font-bold text-slate-900">0</span></li>
                        <li class="flex justify-between text-slate-600 font-medium">Blocked Users: <span class="font-bold text-slate-900">0</span></li>
                    </ul>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
                    <h5 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Job Platform</h5>
                     <ul class="space-y-3">
                        <li class="flex justify-between text-slate-600 font-medium">Jobs Posted Today: <span class="font-bold text-slate-900">0</span></li>
                        <li class="flex justify-between text-slate-600 font-medium">Total Active Jobs: <span class="font-bold text-slate-900">0</span></li>
                        <li class="flex justify-between text-slate-600 font-medium">Applications Today: <span class="font-bold text-slate-900">0</span></li>
                    </ul>
                </div>
            </div>

            <!-- LEARNING + COMMUNITY -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
                    <h5 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Learning Hub</h5>
                    <ul class="space-y-3">
                        <li class="flex justify-between text-slate-600 font-medium">Active Courses: <span class="font-bold text-slate-900">0</span></li>
                        <li class="flex justify-between text-slate-600 font-medium">Enrolled Users: <span class="font-bold text-slate-900">0</span></li>
                        <li class="flex justify-between text-slate-600 font-medium">Certificates Issued: <span class="font-bold text-slate-900">0</span></li>
                    </ul>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
                    <h5 class="text-lg font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Community & Safety</h5>
                     <ul class="space-y-3">
                        <li class="flex justify-between text-slate-600 font-medium">New Posts Today: <span class="font-bold text-slate-900">0</span></li>
                        <li class="flex justify-between text-slate-600 font-medium">Reports Pending: <span class="font-bold text-slate-900">0</span></li>
                        <li class="flex justify-between text-slate-600 font-medium">Banned Users: <span class="font-bold text-slate-900">0</span></li>
                    </ul>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
