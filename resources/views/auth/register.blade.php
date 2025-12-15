@extends('layouts.auth')

@section('title', 'Join Ablelink')

@section('content')
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-extrabold text-slate-900 mb-4">Create your account</h1>
        <p class="text-slate-500 text-lg leading-relaxed">Join our community of employers, volunteers, and caregivers. Simple, secure, and accessible.</p>
    </div>

    <form method="POST" action="{{ route('register.store') }}" aria-label="Ablelink registration form" class="space-y-6">
        @csrf
        
        <div>
            <label for="name" class="block text-sm font-bold text-slate-700 mb-2 ml-1">Full Name</label>
            <input id="name" name="name" type="text" 
                   class="w-full px-5 py-4 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 font-medium focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-lg placeholder-slate-400"
                   placeholder="e.g. John Doe"
                   value="{{ old('name') }}" required autofocus>
        </div>

        <div>
            <label for="email" class="block text-sm font-bold text-slate-700 mb-2 ml-1">Email Address</label>
            <input id="email" name="email" type="email" 
                   class="w-full px-5 py-4 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 font-medium focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-lg placeholder-slate-400"
                   placeholder="you@example.com"
                   value="{{ old('email') }}" required inputmode="email">
        </div>

        <div>
            <label for="phone" class="block text-sm font-bold text-slate-700 mb-2 ml-1">Mobile Number</label>
            <input id="phone" name="phone" type="tel" 
                   class="w-full px-5 py-4 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 font-medium focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-lg placeholder-slate-400"
                   placeholder="+1 (555) 000-0000"
                   value="{{ old('phone') }}" required inputmode="tel">
            <p class="text-xs text-slate-400 mt-2 ml-1">We'll use this for secure OTP verification.</p>
        </div>

        <div>
            <label for="role" class="block text-sm font-bold text-slate-700 mb-2 ml-1">I am registering as</label>
            <div class="relative">
                <select id="role" name="role" required 
                        class="w-full px-5 py-4 rounded-2xl border-2 border-slate-200 bg-slate-50 text-slate-900 font-medium focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-lg appearance-none cursor-pointer">
                    <option value="" disabled @selected(! old('role'))>Select your role...</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" @selected(old('role') === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>

        <button type="submit" 
                class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold text-lg shadow-xl hover:shadow-2xl hover:-translate-y-1 hover:brightness-110 transition-all duration-300 transform">
            Create Account
        </button>
    </form>
@endsection
