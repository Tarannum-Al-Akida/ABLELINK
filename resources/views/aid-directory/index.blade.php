@extends('layouts.app')

@section('title', 'Aid Directory - AbleLink')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">Aid Directory</h1>
            <p class="mt-1 text-slate-600">Find helpful services and resources in your area.</p>
        </div>
        <a href="{{ route('documents.upload') }}" class="px-5 py-3 rounded-2xl bg-white border border-slate-200 font-bold text-slate-700 hover:bg-slate-50 transition">
            OCR & Simplify
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-6 md:p-8">
            <form method="GET" action="{{ url('/aid-directory') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Search</label>
                    <input name="q" value="{{ $q }}" placeholder="e.g., food, legal aid, transport..."
                           class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-100">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Category</label>
                    <select name="category" class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                        <option value="">All</option>
                        @foreach($categories as $c)
                            <option value="{{ $c }}" {{ $category === $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Region</label>
                    <select name="region" class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4">
                        <option value="">All</option>
                        @foreach($regions as $r)
                            <option value="{{ $r }}" {{ $region === $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-4 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between pt-2">
                    <button class="px-6 py-3 rounded-2xl bg-slate-900 text-white font-extrabold hover:bg-slate-800 transition">
                        Search
                    </button>
                    <a href="{{ url('/aid-directory') }}" class="text-sm font-bold text-slate-600 hover:text-slate-900">
                        Reset filters
                    </a>
                </div>
            </form>
        </div>
    </div>

    @if($resources->count() === 0)
        <div class="bg-slate-50 border border-slate-200 rounded-3xl p-10 text-center">
            <h2 class="text-xl font-extrabold text-slate-900">No results</h2>
            <p class="mt-2 text-slate-600">Try a different search term or clear filters.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($resources as $res)
                <div class="bg-white rounded-3xl shadow-lg border border-slate-100 p-6">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400">{{ $res->category }}</p>
                            <h3 class="mt-1 text-lg font-extrabold text-slate-900">{{ $res->name }}</h3>
                            @if($res->region)
                                <p class="mt-1 text-sm text-slate-600">{{ $res->region }}</p>
                            @endif
                        </div>
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-600 to-purple-600"></div>
                    </div>

                    @if($res->description)
                        <p class="mt-4 text-slate-700 text-sm leading-relaxed">{{ $res->description }}</p>
                    @endif

                    <div class="mt-5 space-y-2 text-sm">
                        @if($res->phone)
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-600">Phone</span>
                                <a class="font-extrabold text-blue-700 hover:underline" href="tel:{{ $res->phone }}">{{ $res->phone }}</a>
                            </div>
                        @endif
                        @if($res->email)
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-600">Email</span>
                                <a class="font-extrabold text-blue-700 hover:underline" href="mailto:{{ $res->email }}">{{ $res->email }}</a>
                            </div>
                        @endif
                        @if($res->website)
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-600">Website</span>
                                <a class="font-extrabold text-blue-700 hover:underline" href="{{ $res->website }}" target="_blank" rel="noopener">Open</a>
                            </div>
                        @endif
                        @if($res->address)
                            <div class="pt-2 text-slate-600">
                                <span class="font-bold text-slate-600">Address:</span> {{ $res->address }}
                            </div>
                        @endif
                        @if($res->hours)
                            <div class="text-slate-600">
                                <span class="font-bold text-slate-600">Hours:</span> {{ $res->hours }}
                            </div>
                        @endif
                    </div>

                    @if(is_array($res->tags) && count($res->tags) > 0)
                        <div class="mt-5 flex flex-wrap gap-2">
                            @foreach($res->tags as $t)
                                <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold">{{ $t }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div>
            {{ $resources->links() }}
        </div>
    @endif
</div>
@endsection

