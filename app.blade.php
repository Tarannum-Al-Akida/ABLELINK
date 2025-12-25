<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AbleLink') }}</title>

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="antialiased text-slate-900 bg-slate-50">
    
    <!-- Navbar -->
    <header class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
        <div class="container mx-auto px-6 h-20 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                    A
                </div>
                <span class="text-2xl font-extrabold text-slate-900 tracking-tight">AbleLink</span>
            </a>
            
            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center space-x-2">
                @if (Route::has('login'))
                    <!-- Courses -->
                    <a href="{{ route('courses.index') }}"
                       class="px-5 py-2.5 rounded-full font-semibold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition-all">
                       Courses
                    </a>

                    @auth
                        <!-- Dashboard Link -->
                        <a href="{{ url('/dashboard') }}" 
                           class="px-5 py-2.5 rounded-full font-semibold text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition-all">
                           Dashboard
                        </a>

                        <!-- Profile Link -->
                        <a href="{{ route('profile.show') }}" 
                           class="px-5 py-2.5 rounded-full font-semibold text-slate-600 hover:text-purple-600 hover:bg-purple-50 transition-all">
                           Profile
                        </a>

                        <!-- User Menu (Simple logout for now) -->
                        <div class="ml-4 pl-4 border-l border-slate-200">
                             <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-700">Logout</button>
                            </form>
                        </div>
                    @else
                        <!-- Login -->
                        <a href="{{ route('login') }}" 
                           class="px-6 py-3 rounded-full font-bold text-slate-700 hover:text-slate-900 hover:bg-slate-100 transition-all">
                           Log in
                        </a>

                        <!-- Admin -->
                        <a href="{{ route('admin.login') }}" 
                           class="px-4 py-3 rounded-full font-semibold text-slate-500 hover:text-blue-600 transition-all text-sm">
                           Admin
                        </a>

                        <!-- Register -->
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="ml-2 px-7 py-3 rounded-full bg-slate-900 text-white font-bold shadow-lg hover:shadow-xl hover:bg-slate-800 hover:-translate-y-0.5 transition-all">
                               Get Started
                            </a>
                        @endif
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <div class="relative min-h-screen flex flex-col">
        <!-- Decoration -->
        <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
             <div class="absolute -top-[20%] -right-[10%] w-[800px] h-[800px] bg-blue-100/50 rounded-full blur-3xl opacity-60"></div>
             <div class="absolute top-[20%] -left-[10%] w-[600px] h-[600px] bg-purple-100/50 rounded-full blur-3xl opacity-60"></div>
        </div>

        <!-- Main Content -->
        <main class="relative z-10 flex-grow container mx-auto px-6 py-12">
            @yield('content')
        </main>

        <footer class="relative z-10 border-t border-slate-200 bg-white py-12 mt-auto">
            <div class="container mx-auto px-6 text-center">
                <p class="text-slate-500 font-medium">&copy; {{ date('Y') }} AbleLink. Building bridges for better care.</p>
            </div>
        </footer>
    </div>
</body>
</html>