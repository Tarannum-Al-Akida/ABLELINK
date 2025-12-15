@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <a href="{{ route('caregiver.dashboard') }}" class="text-blue-600 hover:text-blue-800 mb-6 inline-block font-medium">
        &larr; Back to Dashboard
    </a>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">
            <h1 class="text-3xl font-bold text-white">Manage Profile: {{ $user->name }}</h1>
            <p class="text-blue-100 mt-1">Update profile and accessibility settings for your patient</p>
        </div>

        <form action="{{ route('caregiver.patient.update', $user) }}" method="POST" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Full Name</label>
                        <input type="text" value="{{ $user->name }}" disabled
                               class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed text-gray-500">
                        <p class="text-xs text-gray-500 mt-1">Name can only be changed by the user.</p>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                        <input type="email" value="{{ $user->email }}" disabled
                               class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed text-gray-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="phone_number">Phone Number</label>
                        <input type="tel" name="phone_number" id="phone_number"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('phone_number', $user->profile->phone_number ?? '') }}">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="date_of_birth">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('date_of_birth', $user->profile && $user->profile->date_of_birth ? $user->profile->date_of_birth->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="bio">Biography / About</label>
                    <textarea name="bio" id="bio" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Share a little about {{ $user->name }}...">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                </div>

                <div class="mt-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="disability_type">Disability Type</label>
                    <input type="text" name="disability_type" id="disability_type"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           value="{{ old('disability_type', $user->profile->disability_type ?? '') }}"
                           placeholder="e.g. Visual Impairment">
                </div>

                <div class="mt-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="address">Address</label>
                    <textarea name="address" id="address" rows="2"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('address', $user->profile->address ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="emergency_contact_name">Emergency Contact Name</label>
                        <input type="text" name="emergency_contact_name" id="emergency_contact_name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('emergency_contact_name', $user->profile->emergency_contact_name ?? '') }}">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2" for="emergency_contact_phone">Emergency Contact Phone</label>
                        <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               value="{{ old('emergency_contact_phone', $user->profile->emergency_contact_phone ?? '') }}">
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Accessibility Preferences</h2>
                
                @php
                    $prefs = $user->profile->accessibility_preferences ?? [];
                @endphp

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-3">Font Size</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach(['small', 'normal', 'large', 'extra_large'] as $size)
                            <label class="cursor-pointer">
                                <input type="radio" name="accessibility_preferences[font_size]" value="{{ $size }}" 
                                       {{ ($prefs['font_size'] ?? 'normal') === $size ? 'checked' : '' }}
                                       class="peer sr-only">
                                <div class="border-2 border-gray-200 peer-checked:border-blue-600 peer-checked:bg-blue-50 rounded-lg p-3 text-center transition">
                                    <span class="font-medium text-gray-700 peer-checked:text-blue-800 capitalize">{{ str_replace('_', ' ', $size) }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-3">Contrast Mode</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach(['normal', 'high', 'inverted'] as $mode)
                            <label class="cursor-pointer">
                                <input type="radio" name="accessibility_preferences[contrast_mode]" value="{{ $mode }}" 
                                       {{ ($prefs['contrast_mode'] ?? 'normal') === $mode ? 'checked' : '' }}
                                       class="peer sr-only">
                                <div class="border-2 border-gray-200 peer-checked:border-blue-600 peer-checked:bg-blue-50 rounded-lg p-3 text-center transition">
                                    <span class="font-medium text-gray-700 peer-checked:text-blue-800 capitalize">{{ $mode }} Control</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-3">Content Spacing</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach(['compact', 'normal', 'relaxed'] as $spacing)
                            <label class="cursor-pointer">
                                <input type="radio" name="accessibility_preferences[spacing]" value="{{ $spacing }}" 
                                       {{ ($prefs['spacing'] ?? 'normal') === $spacing ? 'checked' : '' }}
                                       class="peer sr-only">
                                <div class="border-2 border-gray-200 peer-checked:border-blue-600 peer-checked:bg-blue-50 rounded-lg p-3 text-center transition">
                                    <span class="font-medium text-gray-700 peer-checked:text-blue-800 capitalize">{{ $spacing }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50">
                        <input type="checkbox" name="accessibility_preferences[screen_reader_enabled]" value="1"
                               {{ ($prefs['screen_reader_enabled'] ?? false) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 rounded">
                        <span class="text-gray-700 font-medium">Screen Reader Support</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50">
                        <input type="checkbox" name="accessibility_preferences[text_to_speech_enabled]" value="1"
                               {{ ($prefs['text_to_speech_enabled'] ?? false) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 rounded">
                        <span class="text-gray-700 font-medium">Text-to-Speech</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50">
                        <input type="checkbox" name="accessibility_preferences[voice_navigation_enabled]" value="1"
                               {{ ($prefs['voice_navigation_enabled'] ?? false) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 rounded">
                        <span class="text-gray-700 font-medium">Voice Navigation</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 border rounded-lg hover:bg-gray-50">
                        <input type="checkbox" name="accessibility_preferences[animation_reduced]" value="1"
                               {{ ($prefs['animation_reduced'] ?? false) ? 'checked' : '' }}
                               class="w-5 h-5 text-blue-600 rounded">
                        <span class="text-gray-700 font-medium">Reduce Animations</span>
                    </label>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Color Blind Mode</label>
                    <select name="accessibility_preferences[color_blind_mode]" 
                            class="w-full md:w-1/2 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="none" {{ ($prefs['color_blind_mode'] ?? 'none') === 'none' ? 'selected' : '' }}>None</option>
                        <option value="protanopia" {{ ($prefs['color_blind_mode'] ?? 'none') === 'protanopia' ? 'selected' : '' }}>Protanopia (Red-Blind)</option>
                        <option value="deuteranopia" {{ ($prefs['color_blind_mode'] ?? 'none') === 'deuteranopia' ? 'selected' : '' }}>Deuteranopia (Green-Blind)</option>
                        <option value="tritanopia" {{ ($prefs['color_blind_mode'] ?? 'none') === 'tritanopia' ? 'selected' : '' }}>Tritanopia (Blue-Blind)</option>
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200 flex justify-end gap-4">
                <a href="{{ route('caregiver.dashboard') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-lg">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
