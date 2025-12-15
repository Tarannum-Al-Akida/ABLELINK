@extends('layouts.app')

@section('title', 'Accessibility Settings - AbleLink')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('profile.show') }}" class="inline-flex items-center text-slate-500 hover:text-purple-600 font-bold mb-6 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Profile
        </a>

        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden relative">
             <!-- Decorative Gradient -->
             <div class="absolute top-0 left-0 w-full h-3 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500"></div>

             <div class="p-8 md:p-12">
                 <div class="flex items-center justify-between mb-8">
                     <div>
                         <h2 class="text-3xl font-extrabold text-slate-900">Accessibility Settings</h2>
                         <p class="text-slate-500 mt-1">Customize your experience to match your needs.</p>
                     </div>
                     <div class="p-4 bg-purple-50 text-purple-600 rounded-2xl hidden md:block">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                     </div>
                 </div>

                 <form action="{{ route('accessibility.update') }}" method="POST" id="accessibilityForm">
                     @csrf
                     @method('PUT')

                     @php
                        $prefs = $user->profile->accessibility_preferences ?? [];
                     @endphp

                     <!-- Font Size -->
                     <div class="mb-10 bg-slate-50 rounded-2xl p-8 border border-slate-100">
                         <label class="block text-slate-800 font-bold text-lg mb-4 flex items-center">
                             <span class="p-2 bg-blue-100 text-blue-600 rounded-lg mr-3">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                             </span>
                             Font Size
                         </label>
                         <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                             @foreach(['small' => 'Small', 'normal' => 'Normal', 'large' => 'Large', 'extra_large' => 'Extra Large'] as $value => $label)
                                 <label class="cursor-pointer relative group">
                                     <input type="radio" name="font_size" value="{{ $value }}" 
                                         {{ ($prefs['font_size'] ?? 'normal') === $value ? 'checked' : '' }}
                                         class="peer sr-only">
                                     <div class="border-2 border-slate-200 bg-white peer-checked:border-purple-500 peer-checked:bg-purple-50 rounded-xl p-4 text-center hover:border-purple-300 transition-all h-full flex items-center justify-center">
                                         <p class="font-bold text-slate-700 peer-checked:text-purple-700"
                                            style="font-size: {{ $value === 'small' ? '0.8rem' : ($value === 'large' ? '1.1rem' : ($value === 'extra_large' ? '1.2rem' : '1rem')) }}">
                                             {{ $label }}
                                         </p>
                                     </div>
                                 </label>
                             @endforeach
                         </div>
                     </div>

                     <!-- Contrast Mode -->
                     <div class="mb-10 bg-slate-50 rounded-2xl p-8 border border-slate-100">
                         <label class="block text-slate-800 font-bold text-lg mb-4 flex items-center">
                             <span class="p-2 bg-gray-200 text-gray-700 rounded-lg mr-3">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                             </span>
                             Contrast Mode
                         </label>
                         <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                             @php
                                $modes = [
                                    'normal' => ['title' => 'Normal', 'desc' => 'Standard color scheme', 'color' => 'bg-white'],
                                    'high' => ['title' => 'High Contrast', 'desc' => 'Black background, white text', 'color' => 'bg-slate-900 text-white'],
                                    'inverted' => ['title' => 'Inverted', 'desc' => 'Inverted color values', 'color' => 'bg-white invert'],
                                ];
                             @endphp
                             @foreach($modes as $value => $info)
                                 <label class="cursor-pointer relative group">
                                     <input type="radio" name="contrast_mode" value="{{ $value }}" 
                                         {{ ($prefs['contrast_mode'] ?? 'normal') === $value ? 'checked' : '' }}
                                         class="peer sr-only">
                                     <div class="border-2 border-slate-200 bg-white peer-checked:border-purple-500 peer-checked:bg-purple-50 peer-checked:shadow-lg rounded-xl p-5 hover:border-purple-300 transition-all h-full">
                                         <div class="h-10 w-full {{ $info['color'] }} rounded-md mb-3 border border-slate-200 flex items-center justify-center text-xs opacity-75">
                                             Aa
                                         </div>
                                         <p class="font-bold text-slate-800 peer-checked:text-purple-700">{{ $info['title'] }}</p>
                                         <p class="text-xs text-slate-500 mt-1">{{ $info['desc'] }}</p>
                                     </div>
                                 </label>
                             @endforeach
                         </div>
                     </div>

                     <!-- Spacing -->
                     <div class="mb-10 bg-slate-50 rounded-2xl p-8 border border-slate-100">
                         <label class="block text-slate-800 font-bold text-lg mb-4 flex items-center">
                             <span class="p-2 bg-green-100 text-green-600 rounded-lg mr-3">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                             </span>
                             Content Spacing
                         </label>
                         <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                             @foreach(['compact' => 'Compact', 'normal' => 'Normal', 'relaxed' => 'Relaxed'] as $value => $label)
                                 <label class="cursor-pointer relative group">
                                     <input type="radio" name="spacing" value="{{ $value }}" 
                                         {{ ($prefs['spacing'] ?? 'normal') === $value ? 'checked' : '' }}
                                         class="peer sr-only">
                                     <div class="border-2 border-slate-200 bg-white peer-checked:border-purple-500 peer-checked:bg-purple-50 rounded-xl p-4 text-center hover:border-purple-300 transition-all">
                                         <p class="font-bold text-slate-800 peer-checked:text-purple-700">{{ $label }}</p>
                                     </div>
                                 </label>
                             @endforeach
                         </div>
                     </div>

                     <!-- Assistive Features -->
                     <div class="mb-10 bg-slate-50 rounded-2xl p-8 border border-slate-100">
                         <label class="block text-slate-800 font-bold text-lg mb-4 flex items-center">
                             <span class="p-2 bg-orange-100 text-orange-600 rounded-lg mr-3">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                             </span>
                             Assistive & Motion Features
                         </label>
                         <div class="space-y-3">
                             @php
                                $features = [
                                    'screen_reader_enabled' => 'Enable Screen Reader Support',
                                    'text_to_speech_enabled' => 'Enable Text-to-Speech',
                                    'voice_navigation_enabled' => 'Enable Voice Navigation',
                                    'animation_reduced' => 'Reduce Animations',
                                ];
                             @endphp
                             @foreach($features as $key => $label)
                                <label class="flex items-center p-4 bg-white border border-slate-200 rounded-xl hover:border-purple-300 transition-all cursor-pointer">
                                    <input type="checkbox" name="{{ $key }}" value="1"
                                        {{ ($prefs[$key] ?? false) ? 'checked' : '' }}
                                        class="w-6 h-6 text-purple-600 rounded-md border-slate-300 focus:ring-purple-500">
                                    <span class="ml-4 font-bold text-slate-700">{{ $label }}</span>
                                </label>
                             @endforeach
                         </div>
                     </div>

                     <!-- Color Blind Mode -->
                     <div class="mb-10 bg-slate-50 rounded-2xl p-8 border border-slate-100">
                         <label class="block text-slate-800 font-bold text-lg mb-4 flex items-center">
                             <span class="p-2 bg-pink-100 text-pink-600 rounded-lg mr-3">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path></svg>
                             </span>
                             Color Blind Mode
                         </label>
                         <div class="relative">
                             <select name="color_blind_mode" 
                                     class="w-full px-5 py-4 bg-white border border-slate-200 rounded-xl font-bold text-slate-700 focus:outline-none focus:ring-4 focus:ring-purple-100 appearance-none cursor-pointer">
                                 <option value="none" {{ ($prefs['color_blind_mode'] ?? 'none') === 'none' ? 'selected' : '' }}>None</option>
                                 <option value="protanopia" {{ ($prefs['color_blind_mode'] ?? 'none') === 'protanopia' ? 'selected' : '' }}>Protanopia (Red-Blind)</option>
                                 <option value="deuteranopia" {{ ($prefs['color_blind_mode'] ?? 'none') === 'deuteranopia' ? 'selected' : '' }}>Deuteranopia (Green-Blind)</option>
                                 <option value="tritanopia" {{ ($prefs['color_blind_mode'] ?? 'none') === 'tritanopia' ? 'selected' : '' }}>Tritanopia (Blue-Blind)</option>
                             </select>
                             <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                 <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                             </div>
                         </div>
                     </div>

                     <!-- Actions -->
                     <div class="flex justify-end gap-4 pt-4 border-t border-slate-100">
                         <a href="{{ route('profile.show') }}" class="px-8 py-3.5 rounded-xl text-slate-500 font-bold hover:bg-slate-50 transition-all">Cancel</a>
                         <button type="submit" class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold shadow-lg hover:shadow-xl hover:from-purple-700 hover:to-pink-700 transition-all transform hover:-translate-y-0.5">
                             Save Preferences
                         </button>
                     </div>

                 </form>
             </div>
        </div>
        
        <!-- Preview Section -->
        <div class="mt-8 bg-blue-50 border border-blue-100 rounded-2xl p-6 flex flex-col md:flex-row items-center gap-4 text-center md:text-left">
             <div class="p-3 bg-white text-blue-600 rounded-xl shadow-sm">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
             </div>
             <div>
                <h3 class="text-lg font-bold text-blue-900">Instant Preview</h3>
                <p class="text-blue-800/80">Your accessibility preferences will be applied immediately after saving. You can always come back and adjust them.</p>
            </div>
        </div>

    </div>
</div>
@endsection
