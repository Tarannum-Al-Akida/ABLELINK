@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">Edit Media</h1>
            <p class="text-slate-600 mt-2">Update media and accessibility assets.</p>
        </div>
        <a href="{{ route('admin.courses.edit', $media->course) }}" class="text-sm font-bold text-slate-600 hover:text-slate-900">Back</a>
    </div>

    @if (session('status'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl p-4 font-semibold">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.courses.media.update', $media) }}" enctype="multipart/form-data"
          class="bg-white border border-slate-200 rounded-2xl p-6">
        @csrf
        @method('PUT')

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
                            <option value="{{ $kind }}" {{ old('kind', $media->kind) === $kind ? 'selected' : '' }}>{{ ucfirst($kind) }}</option>
                        @endforeach
                    </select>
                    @error('kind') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-extrabold text-slate-900">Title</label>
                    <input name="title" value="{{ old('title', $media->title) }}"
                           class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                    @error('title') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-extrabold text-slate-900">Sort order</label>
                    <input name="sort_order" type="number" min="0" value="{{ old('sort_order', $media->sort_order) }}"
                           class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                    @error('sort_order') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-center gap-3 mt-7">
                    <input id="is_primary" name="is_primary" type="checkbox" value="1"
                           {{ old('is_primary', (bool) $media->is_primary) ? 'checked' : '' }}
                           class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" />
                    <label for="is_primary" class="text-sm font-bold text-slate-800">Set as primary</label>
                    @error('is_primary') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-extrabold text-slate-900">External URL (optional)</label>
                <input name="external_url" value="{{ old('external_url', $media->external_url) }}" placeholder="https://..."
                       class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                @error('external_url') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
            </div>

            <div class="border border-slate-200 rounded-xl p-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <div class="text-sm font-extrabold text-slate-900">Current media</div>
                        <div class="text-sm text-slate-700 mt-1">
                            @if($media->media_url)
                                <a class="font-bold text-blue-700 hover:text-blue-900 underline" href="{{ $media->media_url }}" target="_blank" rel="noreferrer">
                                    Open current media
                                </a>
                            @else
                                <span class="text-slate-500">None</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <input id="remove_media_file" name="remove_media_file" type="checkbox" value="1"
                               class="rounded border-slate-300 text-red-600 focus:ring-red-500" />
                        <label for="remove_media_file" class="text-sm font-bold text-red-700">Remove file</label>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-extrabold text-slate-900">Upload new file (optional)</label>
                    <input name="media_file" type="file" class="mt-2 w-full rounded-xl border border-slate-300 p-2 bg-white" />
                    @error('media_file') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="border-t border-slate-200 pt-6">
                <h2 class="text-lg font-extrabold text-slate-900">Accessibility</h2>

                <div class="mt-4 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-extrabold text-slate-900">Captions language</label>
                            <input name="captions_language" value="{{ old('captions_language', $media->captions_language ?: 'en') }}"
                                   class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500" />
                            @error('captions_language') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-extrabold text-slate-900">Upload captions (.vtt)</label>
                            <input name="captions_file" type="file" class="mt-2 w-full rounded-xl border border-slate-300 p-2 bg-white" />
                            @error('captions_file') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded-xl p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-sm font-extrabold text-slate-900">Current captions</div>
                                <div class="text-sm text-slate-700 mt-1">
                                    @if($media->captions_url)
                                        <a class="font-bold text-blue-700 hover:text-blue-900 underline" href="{{ $media->captions_url }}" target="_blank" rel="noreferrer">
                                            Download captions
                                        </a>
                                    @else
                                        <span class="text-slate-500">None</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <input id="remove_captions_file" name="remove_captions_file" type="checkbox" value="1"
                                       class="rounded border-slate-300 text-red-600 focus:ring-red-500" />
                                <label for="remove_captions_file" class="text-sm font-bold text-red-700">Remove</label>
                            </div>
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded-xl p-4">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-sm font-extrabold text-slate-900">Audio description track</div>
                                <div class="text-sm text-slate-700 mt-1">
                                    @if($media->audio_description_url)
                                        <a class="font-bold text-blue-700 hover:text-blue-900 underline" href="{{ $media->audio_description_url }}" target="_blank" rel="noreferrer">
                                            Open audio description
                                        </a>
                                    @else
                                        <span class="text-slate-500">None</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <input id="remove_audio_description_file" name="remove_audio_description_file" type="checkbox" value="1"
                                       class="rounded border-slate-300 text-red-600 focus:ring-red-500" />
                                <label for="remove_audio_description_file" class="text-sm font-bold text-red-700">Remove</label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-extrabold text-slate-900">Upload new audio description (optional)</label>
                            <input name="audio_description_file" type="file" class="mt-2 w-full rounded-xl border border-slate-300 p-2 bg-white" />
                            @error('audio_description_file') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-extrabold text-slate-900">Transcript</label>
                        <textarea name="transcript" rows="7"
                                  class="mt-2 w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">{{ old('transcript', $media->transcript) }}</textarea>
                        @error('transcript') <p class="text-sm text-red-700 mt-1 font-semibold">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-end gap-3">
            <button type="submit" class="px-6 py-3 rounded-full bg-slate-900 text-white font-bold hover:bg-slate-800 transition">
                Save changes
            </button>
        </div>
    </form>

    <form method="POST" action="{{ route('admin.courses.media.destroy', $media) }}" class="mt-4"
          onsubmit="return confirm('Delete this media item?');">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="px-6 py-3 rounded-full bg-red-600 text-white font-bold hover:bg-red-700 transition">
            Delete media
        </button>
    </form>
</div>
@endsection

