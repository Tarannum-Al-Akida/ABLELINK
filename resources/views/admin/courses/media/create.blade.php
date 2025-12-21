@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">Add Media</h1>
            <p class="text-slate-600 mt-2">Attach a video/audio/document or external link and add accessibility assets.</p>
        </div>
        <a href="{{ route('admin.courses.edit', $course) }}" class="text-sm font-bold text-slate-600 hover:text-slate-900">Back</a>
    </div>

    <form method="POST" action="{{ route('admin.courses.media.store', $course) }}" enctype="multipart/form-data"
          class="bg-white border border-slate-200 rounded-2xl p-6">
        @csrf

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 font-semibold">
                Please fix the errors below.
            </div>
        @endif

        <div class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-extrabold text-slate-900">Kind</label>
                    <select name="kind" class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">
                        @foreach(\App\Models\CourseMedia::KINDS as $kind)
                            <option value="{{ $kind }}" {{ old('kind') === $kind ? 'selected' : '' }}>{{ ucfirst($kind) }}</option>
                        @endforeach
                    </select>
                    @error('kind') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-extrabold text-slate-900">Title (optional)</label>
                    <input name="title" value="{{ old('title') }}"
                           class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                    @error('title') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-extrabold text-slate-900">Sort order</label>
                    <input name="sort_order" type="number" min="0" value="{{ old('sort_order', 0) }}"
                           class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                    @error('sort_order') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-center gap-3 mt-7">
                    <input id="is_primary" name="is_primary" type="checkbox" value="1" {{ old('is_primary') ? 'checked' : '' }}
                           class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" />
                    <label for="is_primary" class="text-sm font-bold text-slate-800">Set as primary</label>
                    @error('is_primary') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-extrabold text-slate-900">External URL (optional)</label>
                <input name="external_url" value="{{ old('external_url') }}" placeholder="https://..."
                       class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                <p class="text-xs text-slate-500 mt-1">
                    Tip: If you choose <span class="font-bold">Video</span> and paste a YouTube URL, it will be embedded and playable for everyone.
                </p>
                @error('external_url') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-extrabold text-slate-900">Upload file (optional)</label>
                <input name="media_file" type="file"
                       class="mt-2 w-full rounded-xl border border-slate-300 p-2 bg-white" />
                <p class="text-xs text-slate-500 mt-1">Provide either a file or an external URL (except for “link”).</p>
                @error('media_file') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div class="border-t border-slate-200 pt-6">
                <h2 class="text-lg font-extrabold text-slate-900">Accessibility</h2>

                <div class="mt-4 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-extrabold text-slate-900">Captions language</label>
                            <input name="captions_language" value="{{ old('captions_language', 'en') }}"
                                   class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                            @error('captions_language') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-extrabold text-slate-900">Captions file (.vtt)</label>
                            <input name="captions_file" type="file"
                                   class="mt-2 w-full rounded-xl border border-slate-300 p-2 bg-white" />
                            @error('captions_file') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-extrabold text-slate-900">Audio description file (optional)</label>
                        <input name="audio_description_file" type="file"
                               class="mt-2 w-full rounded-xl border border-slate-300 p-2 bg-white" />
                        @error('audio_description_file') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-extrabold text-slate-900">Transcript (optional)</label>
                        <textarea name="transcript" rows="7"
                                  class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">{{ old('transcript') }}</textarea>
                        @error('transcript') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <button type="submit" class="px-6 py-3 rounded-full bg-slate-900 text-white font-bold hover:bg-slate-800 transition">
                Add media
            </button>
        </div>
    </form>
</div>
@endsection

