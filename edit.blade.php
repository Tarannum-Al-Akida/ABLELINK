@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">Edit Course</h1>
            <p class="text-slate-600 mt-2">Update course metadata and manage accessible media.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('courses.show', ['course' => $course->slug]) }}" target="_blank" rel="noreferrer"
               class="px-5 py-3 rounded-full bg-white border border-slate-200 text-slate-900 font-bold hover:bg-slate-50 transition">
                View public page
            </a>
            <a href="{{ route('admin.courses.index') }}" class="text-sm font-bold text-slate-600 hover:text-slate-900">Back</a>
        </div>
    </div>

    @if (session('status'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 font-semibold">
            {{ session('status') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('admin.courses.update', $course) }}"
                  class="bg-white border border-slate-200 rounded-2xl p-6">
                @csrf
                @method('PUT')

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 font-semibold">
                        Please fix the errors below.
                    </div>
                @endif

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-extrabold text-slate-900">Title</label>
                        <input name="title" value="{{ old('title', $course->title) }}" required
                               class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                        @error('title') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-extrabold text-slate-900">Slug</label>
                        <input name="slug" value="{{ old('slug', $course->slug) }}" required
                               class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                        @error('slug') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-extrabold text-slate-900">Summary</label>
                        <input name="summary" value="{{ old('summary', $course->summary) }}"
                               class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                        @error('summary') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-extrabold text-slate-900">Description</label>
                        <textarea name="description" rows="6"
                                  class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">{{ old('description', $course->description) }}</textarea>
                        @error('description') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-extrabold text-slate-900">Level</label>
                            <input name="level" value="{{ old('level', $course->level) }}"
                                   class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                            @error('level') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-extrabold text-slate-900">Estimated minutes</label>
                            <input name="estimated_minutes" type="number" min="1" value="{{ old('estimated_minutes', $course->estimated_minutes) }}"
                                   class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                            @error('estimated_minutes') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <input id="published" name="published" type="checkbox" value="1"
                               {{ old('published', (bool) $course->published_at) ? 'checked' : '' }}
                               class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" />
                        <label for="published" class="text-sm font-bold text-slate-800">Published</label>
                        @if($course->published_at)
                            <span class="text-xs text-slate-500">({{ $course->published_at->toDayDateTimeString() }})</span>
                        @endif
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-3">
                    <button type="submit" class="px-6 py-3 rounded-full bg-slate-900 text-white font-bold hover:bg-slate-800 transition">
                        Save changes
                    </button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white border border-slate-200 rounded-2xl p-6">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="text-lg font-extrabold text-slate-900">Media</h2>
                    <a href="{{ route('admin.courses.media.create', $course) }}"
                       class="text-sm font-bold text-blue-700 hover:text-blue-900">
                        + Add
                    </a>
                </div>

                <div class="mt-4 space-y-3">
                    @forelse($course->media as $media)
                        <div class="border border-slate-200 rounded-xl p-4">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="font-extrabold text-slate-900">
                                        {{ $media->title ?: ucfirst($media->kind) }}
                                    </div>
                                    <div class="text-xs text-slate-500 mt-1">
                                        {{ $media->kind }}
                                        @if($media->is_primary) · primary @endif
                                    </div>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @if($media->captions_path)
                                            <span class="px-2 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700">subtitles</span>
                                        @endif
                                        @if($media->audio_description_path)
                                            <span class="px-2 py-1 rounded-full text-[11px] font-bold bg-purple-50 text-purple-700">audio desc</span>
                                        @endif
                                        @if($media->transcript)
                                            <span class="px-2 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700">transcript</span>
                                        @endif
                                    </div>
                                </div>
                                <a href="{{ route('admin.courses.media.edit', $media) }}"
                                   class="text-sm font-bold text-slate-900 hover:text-slate-700">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-slate-600 font-semibold">
                            No media yet. Add a video/audio/document and attach captions/transcript/audio description.
                        </div>
                    @endforelse
                </div>
            </div>

            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="mt-6"
                  onsubmit="return confirm('Delete this course? This will delete all attached media too.');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full px-6 py-3 rounded-full bg-red-600 text-white font-bold hover:bg-red-700 transition">
                    Delete course
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

//Akida-f11