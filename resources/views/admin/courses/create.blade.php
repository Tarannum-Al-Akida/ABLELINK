@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">New Course</h1>
            <p class="text-slate-600 mt-2">Add a course and publish it when ready.</p>
        </div>
        <a href="{{ route('admin.courses.index') }}" class="text-sm font-bold text-slate-600 hover:text-slate-900">Back</a>
    </div>

    <form method="POST" action="{{ route('admin.courses.store') }}" class="bg-white border border-slate-200 rounded-2xl p-6">
        @csrf

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 font-semibold">
                Please fix the errors below.
            </div>
        @endif

        <div class="space-y-5">
            <div>
                <label class="block text-sm font-extrabold text-slate-900">Title</label>
                <input name="title" value="{{ old('title') }}" required
                       class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                @error('title') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-slate-900">Slug (optional)</label>
                <input name="slug" value="{{ old('slug') }}"
                       class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                <p class="text-xs text-slate-500 mt-1">Leave blank to auto-generate from title.</p>
                @error('slug') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-slate-900">Summary</label>
                <input name="summary" value="{{ old('summary') }}"
                       class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                @error('summary') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-slate-900">Description</label>
                <textarea name="description" rows="6"
                          class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                @error('description') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-extrabold text-slate-900">Level</label>
                    <input name="level" value="{{ old('level') }}"
                           placeholder="beginner / intermediate / advanced"
                           class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                    @error('level') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-extrabold text-slate-900">Estimated minutes</label>
                    <input name="estimated_minutes" type="number" min="1" value="{{ old('estimated_minutes') }}"
                           class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                    @error('estimated_minutes') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input id="published" name="published" type="checkbox" value="1" {{ old('published') ? 'checked' : '' }}
                       class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" />
                <label for="published" class="text-sm font-bold text-slate-800">Publish now</label>
                @error('published') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <button type="submit" class="px-6 py-3 rounded-full bg-slate-900 text-white font-bold hover:bg-slate-800 transition">
                Create course
            </button>
        </div>
    </form>
</div>
@endsection

