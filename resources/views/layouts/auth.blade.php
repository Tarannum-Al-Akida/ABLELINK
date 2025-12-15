<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

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
<body class="antialiased text-slate-800 bg-white min-h-screen flex flex-col relative overflow-x-hidden">

    <!-- Hero Background Split -->
    <div class="absolute top-0 inset-x-0 h-[400px] bg-gradient-to-br from-blue-600 to-purple-700 z-0 rounded-b-[3rem] shadow-2xl"></div>

    <!-- Header -->
    <div class="relative z-10 pt-12 pb-6 text-center">
        <a href="{{ route('home') }}" class="inline-block">
             <span class="text-4xl font-extrabold text-white tracking-tight drop-shadow-md">AbleLink</span>
        </a>
        <h2 class="mt-4 text-center text-xl text-blue-100 font-medium">
            @yield('title', 'Welcome Back')
        </h2>
    </div>

    <!-- Main Content Container -->
    <div class="flex-grow flex items-start justify-center px-4 sm:px-6 lg:px-8 relative z-10 -mt-4">
        <div class="w-full max-w-[500px]">
            <!-- Card -->
            <div class="bg-white rounded-[2rem] shadow-2xl border border-slate-100 overflow-hidden">
                <div class="p-10 sm:p-12"> <!-- Massive Padding as requested -->
                    
                    @if (session('status'))
                        <div class="mb-8 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl text-sm font-medium flex items-center shadow-sm">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-8 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl text-sm font-medium shadow-sm">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Content yields forms -->
                    <div class="space-y-6">
                        @yield('content')
                    </div>
                </div>
            </div>

            <p class="mt-8 text-center text-sm text-slate-500 font-medium">
                &copy; {{ date('Y') }} AbleLink. Secure & Inclusive.
                <span class="mx-2">·</span>
                <a href="{{ route('admin.login') }}" class="hover:text-blue-600 transition-colors">Admin Portal</a>
            </p>
        </div>
    </div>

    <!-- Override Default Styles specifically for Auth inputs -->
    <style>
        /* Form Inputs - High Spacing & Visibility */
        input[type="email"],
        input[type="password"],
        input[type="text"],
        input[type="number"],
        select {
            display: block;
            width: 100%;
            height: 3.5rem; /* h-14 equivalent for larger touch target */
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            border-width: 2px; /* Thicker border */
            border-color: #e2e8f0;
            border-radius: 1rem;
            background-color: #f8fafc;
            color: #0f172a;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #4f46e5; /* Indigo-600 */
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        input::placeholder {
            color: #94a3b8;
        }

        /* Labels */
        label {
            display: block;
            font-size: 0.95rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 0.75rem; /* More space between label and input */
            margin-left: 0.25rem;
        }

        /* Submit Button */
        button[type="submit"] {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            height: 3.5rem;
            border-radius: 1rem;
            background-image: linear-gradient(to right, #2563eb, #7c3aed);
            font-size: 1.125rem;
            font-weight: 700;
            color: #ffffff;
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.5);
        }

        /* Links */
        a.text-sm {
            color: #64748b;
            font-weight: 600;
            transition: color 0.2s;
        }
        a.text-sm:hover {
            color: #2563eb;
            text-decoration: underline;
        }
    </style>
</body>
</html>
