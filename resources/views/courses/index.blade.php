@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">Accessible Course Library</h1>
            <p class="text-slate-600 mt-2">
                Courses with multimedia accessibility features like subtitles, transcripts, and audio descriptions.
            </p>
        </div>
        @auth
            @if (Auth::user()->isAdmin())
                <a href="{{ route('admin.courses.index') }}"
                   class="px-5 py-3 rounded-full bg-slate-900 text-white font-bold shadow hover:bg-slate-800 transition">
                    Manage courses
                </a>
            @endif
        @endauth
    </div>

    @if($courses->isEmpty())
        <div class="bg-white border border-slate-200 rounded-2xl p-8 text-center">
            <p class="text-slate-700 font-semibold">No courses published yet.</p>
            <p class="text-slate-500 mt-1">Admins can add courses from the dashboard.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($courses as $course)
                @php
                    $media = $course->media ?? collect();
                    $hasCaptions = $media->contains(fn($m) => !empty($m->captions_path));
                    $hasTranscript = $media->contains(fn($m) => !empty($m->transcript));
                    $hasAudioDesc = $media->contains(fn($m) => !empty($m->audio_description_path));
                @endphp

                <a href="{{ route('courses.show', ['course' => $course->slug]) }}"
                   class="group bg-white border border-slate-200 rounded-2xl p-6 shadow-sm hover:shadow-md transition block">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-extrabold text-slate-900 group-hover:text-blue-700 transition">
                                {{ $course->title }}
                            </h2>
                            @if($course->summary)
                                <p class="text-slate-600 mt-2">{{ $course->summary }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            @if($course->level)
                                <div class="text-xs font-bold uppercase tracking-wide text-slate-500">{{ $course->level }}</div>
                            @endif
                            @if($course->estimated_minutes)
                                <div class="text-sm font-semibold text-slate-700 mt-1">{{ $course->estimated_minutes }} min</div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                            Media: {{ $media->count() }}
                        </span>
                        @if($hasCaptions)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700">Subtitles</span>
                        @endif
                        @if($hasTranscript)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700">Transcript</span>
                        @endif
                        @if($hasAudioDesc)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-50 text-purple-700">Audio description</span>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection

