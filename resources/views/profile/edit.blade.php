@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('profile.show') }}" class="inline-flex items-center text-slate-500 hover:text-blue-600 font-bold mb-6 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Profile
        </a>

        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden relative">
             <!-- Decorative Gradient -->
             <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>

             <div class="p-8 md:p-12">
                 <div class="flex items-center justify-between mb-8">
                     <div>
                         <h2 class="text-3xl font-extrabold text-slate-900">Edit Profile</h2>
                         <p class="text-slate-500 mt-1">Update your personal information and contact details.</p>
                     </div>
                     <div class="p-4 bg-blue-50 text-blue-600 rounded-2xl hidden md:block">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                     </div>
                 </div>

                 <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')

                     <!-- Avatar Section -->
                     <div class="mb-10 bg-slate-50 rounded-2xl p-6 border border-slate-100">
                         <label class="block text-slate-700 font-bold mb-4 text-lg">Profile Avatar</label>
                         <div class="flex items-center space-x-6">
                            <div class="relative group">
                                @if($user->avatar)
                                    <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar) }}" class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md">
                                @else
                                    <div id="avatar-preview-placeholder" class="w-24 h-24 rounded-full bg-slate-200 flex items-center justify-center text-slate-400 border-4 border-white shadow-md">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/30 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <input type="file" name="avatar" class="block w-full text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer">
                                <p class="text-xs text-slate-400 mt-2">JPG, GIF or PNG. Max size 2MB.</p>
                            </div>
                         </div>
                     </div>

                     <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                         <!-- Full Name -->
                         <div>
                             <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full Name</label>
                             <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-5 py-3.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-semibold focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all placeholder-slate-300" placeholder="Your Full Name">
                             @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                         </div>
                         
                         <!-- Email Address -->
                         <div>
                             <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address</label>
                             <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-5 py-3.5 rounded-xl bg-slate-100 border border-slate-200 text-slate-500 font-semibold focus:outline-none cursor-not-allowed" readonly>
                             @error('email') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                         </div>

                         <!-- Phone Number -->
                         <div>
                             <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Phone Number</label>
                             <input type="text" name="phone_number" value="{{ old('phone_number', $user->profile->phone_number ?? '') }}" class="w-full px-5 py-3.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-semibold focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all placeholder-slate-300" placeholder="e.g. 1234567890">
                              @error('phone_number') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                         </div>

                          <!-- Date of Birth -->
                          <div>
                             <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Date of Birth</label>
                             <input type="date" name="date_of_birth" value="{{ old('date_of_birth', optional($user->profile->date_of_birth ?? null)->format('Y-m-d')) }}" class="w-full px-5 py-3.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-semibold focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all">
                              @error('date_of_birth') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                         </div>

                         <!-- Address -->
                         <div>
                             <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Address</label>
                             <input type="text" name="address" value="{{ old('address', $user->profile->address ?? '') }}" class="w-full px-5 py-3.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-semibold focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all placeholder-slate-300" placeholder="Your residential address">
                              @error('address') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                         </div>

                         <!-- Disability Type (Full Width) -->
                         <div class="md:col-span-2">
                             <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Disability Type (Optional)</label>
                             <input type="text" name="disability_type" value="{{ old('disability_type', $user->profile->disability_type ?? '') }}" class="w-full px-5 py-3.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-semibold focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all placeholder-slate-300" placeholder="e.g., Mobility Impairment, Visual Impairment">
                              @error('disability_type') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                         </div>

                         <!-- Bio (Full Width) -->
                         <div class="md:col-span-2">
                             <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Biography</label>
                             <textarea name="bio" rows="4" class="w-full px-5 py-3.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-800 font-semibold focus:outline-none focus:ring-4 focus:ring-blue-100 transition-all placeholder-slate-300" placeholder="Tell us a little about yourself...">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                              @error('bio') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                         </div>
                     </div>

                     <!-- Emergency Contact Section -->
                     <div class="bg-red-50/50 rounded-2xl p-8 border border-red-100 mb-8">
                         <div class="flex items-center mb-6">
                             <div class="p-2 bg-red-100 text-red-600 rounded-lg mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                             </div>
                             <h3 class="text-xl font-bold text-red-900">Emergency Contact</h3>
                         </div>
                         
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                             <div>
                                 <label class="block text-xs font-bold text-red-400 uppercase tracking-wider mb-2">Contact Name</label>
                                 <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $user->profile->emergency_contact_name ?? '') }}" class="w-full px-5 py-3.5 rounded-xl bg-white border border-red-200 text-slate-800 font-semibold focus:outline-none focus:ring-4 focus:ring-red-100 transition-all placeholder-red-200" placeholder="Name of contact">
                             </div>
                             <div>
                                 <label class="block text-xs font-bold text-red-400 uppercase tracking-wider mb-2">Contact Phone</label>
                                 <input type="text" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $user->profile->emergency_contact_phone ?? '') }}" class="w-full px-5 py-3.5 rounded-xl bg-white border border-red-200 text-slate-800 font-semibold focus:outline-none focus:ring-4 focus:ring-red-100 transition-all placeholder-red-200" placeholder="Phone number">
                             </div>
                         </div>
                     </div>

                     <!-- Actions -->
                     <div class="flex justify-end gap-4 pt-6 border-t border-slate-100">
                         <a href="{{ route('profile.show') }}" class="px-8 py-3.5 rounded-xl text-slate-500 font-bold hover:bg-slate-50 transition-all">Cancel</a>
                         <button type="submit" class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-purple-700 transition-all transform hover:-translate-y-0.5">
                             Save Changes
                         </button>
                     </div>

                 </form>
             </div>
        </div>
    </div>
</div>
@endsection
