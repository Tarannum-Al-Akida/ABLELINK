@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-start justify-between gap-6 mb-8">
        <div>
            <a href="{{ route('courses.index') }}" class="text-sm font-bold text-slate-500 hover:text-slate-800">
                ← Back to courses
            </a>
            <h1 class="text-3xl font-extrabold text-slate-900 mt-2">{{ $course->title }}</h1>
            <div class="mt-3 flex flex-wrap gap-2">
                @if($course->level)
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                        Level: {{ $course->level }}
                    </span>
                @endif
                @if($course->estimated_minutes)
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                        {{ $course->estimated_minutes }} minutes
                    </span>
                @endif
                @if($course->published_at)
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700">
                        Published {{ $course->published_at->toFormattedDateString() }}
                    </span>
                @endif
            </div>
        </div>
        @auth
            @if (Auth::user()->isAdmin())
                <a href="{{ route('admin.courses.edit', $course) }}"
                   class="px-5 py-3 rounded-full bg-slate-900 text-white font-bold shadow hover:bg-slate-800 transition">
                    Edit course
                </a>
            @endif
        @endauth
    </div>

    @if($course->summary)
        <div class="bg-white border border-slate-200 rounded-2xl p-6 mb-6">
            <h2 class="text-lg font-extrabold text-slate-900">Summary</h2>
            <p class="text-slate-700 mt-2">{{ $course->summary }}</p>
        </div>
    @endif

    @if($course->description)
        <div class="bg-white border border-slate-200 rounded-2xl p-6 mb-6">
            <h2 class="text-lg font-extrabold text-slate-900">About this course</h2>
            <div class="text-slate-700 mt-2 whitespace-pre-wrap">{{ $course->description }}</div>
        </div>
    @endif

    <div class="space-y-6">
        @forelse($course->media as $media)
            <div class="bg-white border border-slate-200 rounded-2xl p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">
                            {{ $media->title ?: ucfirst($media->kind) }}
                            @if($media->is_primary)
                                <span class="ml-2 align-middle px-2 py-1 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700">
                                    Primary
                                </span>
                            @endif
                        </h3>
                        <p class="text-sm text-slate-500 mt-1">Type: {{ $media->kind }}</p>
                    </div>
                    <div class="text-right">
                        @if($media->captions_url)
                            <div class="text-xs font-bold text-blue-700">Subtitles available</div>
                        @endif
                        @if($media->audio_description_url)
                            <div class="text-xs font-bold text-purple-700 mt-1">Audio description available</div>
                        @endif
                        @if(!empty($media->transcript))
                            <div class="text-xs font-bold text-emerald-700 mt-1">Transcript available</div>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    @if($media->kind === \App\Models\CourseMedia::KIND_VIDEO && $media->media_url)
                        <video class="w-full rounded-xl border border-slate-200 bg-black" controls>
                            <source src="{{ $media->media_url }}" type="{{ $media->mime_type ?: 'video/mp4' }}">
                            @if($media->captions_url)
                                <track kind="subtitles"
                                       src="{{ $media->captions_url }}"
                                       srclang="{{ $media->captions_language ?: 'en' }}"
                                       label="Subtitles ({{ strtoupper($media->captions_language ?: 'en') }})"
                                       default>
                            @endif
                            Your browser does not support the video tag.
                        </video>
                    @elseif($media->kind === \App\Models\CourseMedia::KIND_AUDIO && $media->media_url)
                        <audio class="w-full" controls src="{{ $media->media_url }}"></audio>
                    @elseif($media->kind === \App\Models\CourseMedia::KIND_DOCUMENT && $media->media_url)
                        <a href="{{ $media->media_url }}"
                           class="inline-flex items-center px-4 py-2 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 transition"
                           target="_blank" rel="noreferrer">
                            Open document
                        </a>
                    @elseif($media->kind === \App\Models\CourseMedia::KIND_LINK && $media->media_url)
                        <a href="{{ $media->media_url }}"
                           class="inline-flex items-center px-4 py-2 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 transition"
                           target="_blank" rel="noreferrer">
                            Open link
                        </a>
                    @elseif($media->media_url)
                        <a href="{{ $media->media_url }}"
                           class="inline-flex items-center px-4 py-2 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 transition"
                           target="_blank" rel="noreferrer">
                            Open media
                        </a>
                    @else
                        <p class="text-slate-600">No media file or URL attached yet.</p>
                    @endif
                </div>

                @if($media->audio_description_url)
                    <div class="mt-5">
                        <h4 class="text-sm font-extrabold text-slate-900">Audio description track</h4>
                        <audio class="w-full mt-2" controls src="{{ $media->audio_description_url }}"></audio>
                        <p class="text-xs text-slate-500 mt-1">Use this track if you prefer audio-described narration.</p>
                    </div>
                @endif

                @if($media->captions_url)
                    <div class="mt-5">
                        <h4 class="text-sm font-extrabold text-slate-900">Subtitles file</h4>
                        <a class="text-sm font-bold text-blue-700 hover:text-blue-900 underline"
                           href="{{ $media->captions_url }}"
                           target="_blank" rel="noreferrer">
                            Download captions ({{ strtoupper($media->captions_language ?: 'en') }})
                        </a>
                    </div>
                @endif

                @if(!empty($media->transcript))
                    <div class="mt-5">
                        <details class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                            <summary class="cursor-pointer font-extrabold text-slate-900">Transcript</summary>
                            <div class="mt-3 text-slate-700 whitespace-pre-wrap">{{ $media->transcript }}</div>
                        </details>
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center">
                <p class="text-slate-700 font-semibold">This course has no media yet.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

