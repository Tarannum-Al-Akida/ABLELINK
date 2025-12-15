@extends('layouts.app')

@section('title', 'Result - AbleLink')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">Result</h1>
            @if(!empty($source_filename))
                <p class="mt-1 text-slate-600">Source: <span class="font-semibold">{{ $source_filename }}</span></p>
            @endif
        </div>
        <a href="{{ url('/upload') }}" class="px-5 py-3 rounded-2xl bg-white border border-slate-200 font-bold text-slate-700 hover:bg-slate-50 transition">
            New Upload
        </a>
    </div>

    @if(!empty($warnings))
        <div class="bg-amber-50 border border-amber-200 text-amber-900 px-6 py-4 rounded-2xl">
            <p class="font-extrabold">Notes</p>
            <ul class="list-disc list-inside mt-2 space-y-1">
                @foreach($warnings as $w)
                    <li>{{ $w }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex items-center justify-between gap-4">
                    <h2 class="text-xl font-extrabold text-slate-900">Extracted text</h2>
                    <form action="{{ url('/simplify') }}" method="POST">
                        @csrf
                        <input type="hidden" name="text" value="{{ $original_text }}">
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-slate-900 text-white font-extrabold hover:bg-slate-800 transition">
                            Simplify
                        </button>
                    </form>
                </div>

                <textarea readonly rows="18" class="mt-4 w-full rounded-2xl border-2 border-slate-200 bg-slate-50 px-5 py-4 font-mono text-sm text-slate-800">{{ $original_text }}</textarea>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-6 md:p-8">
                <h2 class="text-xl font-extrabold text-slate-900">Simplified</h2>

                @if(!empty($simplified_bullets))
                    <div class="mt-4 bg-purple-50 border border-purple-100 rounded-2xl p-5">
                        <p class="font-extrabold text-purple-900">Key points</p>
                        <ul class="list-disc list-inside mt-2 space-y-1 text-purple-900/90">
                            @foreach($simplified_bullets as $b)
                                <li>{{ $b }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(isset($simplified_text) && trim($simplified_text) !== '')
                    <textarea readonly rows="18" class="mt-4 w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4 font-mono text-sm text-slate-800">{{ $simplified_text }}</textarea>
                @else
                    <div class="mt-4 rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-6 text-slate-600">
                        <p class="font-bold">No simplified text yet.</p>
                        <p class="mt-1">Click “Simplify” to generate a clearer version of the extracted text.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
