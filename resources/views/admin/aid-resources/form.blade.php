@extends('layouts.app')

@section('title', $mode === 'create' ? 'Add Aid Resource - AbleLink' : 'Edit Aid Resource - AbleLink')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">
                {{ $mode === 'create' ? 'Add aid resource' : 'Edit aid resource' }}
            </h1>
            <p class="mt-1 text-slate-600">These entries appear on the public Aid Directory when set to Active.</p>
        </div>
        <a href="{{ route('admin.aid-resources.index') }}" class="px-5 py-3 rounded-2xl bg-white border border-slate-200 font-bold text-slate-700 hover:bg-slate-50 transition">
            Back
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-6 md:p-8">
            <form method="POST"
                  action="{{ $mode === 'create' ? route('admin.aid-resources.store') : route('admin.aid-resources.update', $resource) }}"
                  class="space-y-6">
                @csrf
                @if($mode !== 'create')
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Name</label>
                        <input name="name" value="{{ old('name', $resource->name) }}" required
                               class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Category</label>
                        <input name="category" value="{{ old('category', $resource->category) }}" required
                               placeholder="e.g., Food, Housing, Legal Aid"
                               class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Region (optional)</label>
                        <input name="region" value="{{ old('region', $resource->region) }}"
                               placeholder="e.g., San Jose, CA"
                               class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Description (optional)</label>
                        <textarea name="description" rows="4"
                                  class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">{{ old('description', $resource->description) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Phone (optional)</label>
                        <input name="phone" value="{{ old('phone', $resource->phone) }}"
                               class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email (optional)</label>
                        <input name="email" value="{{ old('email', $resource->email) }}"
                               class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Website (optional)</label>
                        <input name="website" value="{{ old('website', $resource->website) }}" placeholder="https://..."
                               class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Address (optional)</label>
                        <input name="address" value="{{ old('address', $resource->address) }}"
                               class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Hours (optional)</label>
                        <input name="hours" value="{{ old('hours', $resource->hours) }}" placeholder="e.g., Mon–Fri 9am–5pm"
                               class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tags (optional)</label>
                        <input name="tags"
                               value="{{ old('tags', is_array($resource->tags) ? implode(', ', $resource->tags) : '') }}"
                               placeholder="comma-separated (e.g., wheelchair, free, hotline)"
                               class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                    </div>
                    <div class="md:col-span-2">
                        <label class="flex items-center gap-3 p-4 rounded-2xl border border-slate-200 bg-slate-50">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $resource->is_active ? '1' : '') ? 'checked' : '' }}
                                   class="w-5 h-5 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="font-extrabold text-slate-800">Active (visible in public directory)</span>
                        </label>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-end pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.aid-resources.index') }}" class="px-6 py-3 rounded-2xl bg-white border border-slate-200 font-bold text-slate-700 hover:bg-slate-50 transition text-center">
                        Cancel
                    </a>
                    <button class="px-6 py-3 rounded-2xl bg-slate-900 text-white font-extrabold hover:bg-slate-800 transition">
                        {{ $mode === 'create' ? 'Create' : 'Save changes' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

