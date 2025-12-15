@extends('layouts.app')

@section('title', 'Content Simplification & OCR - AbleLink')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-8 md:p-10">
            <h1 class="text-3xl font-extrabold text-slate-900">Content simplification & OCR</h1>
            <p class="mt-2 text-slate-600">
                Upload a PDF/image to extract text, then simplify it into clearer language and key points.
            </p>

            @if ($errors->any())
                <div class="mt-6 bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
                @csrf

                <div>
                    <label class="block text-slate-800 font-bold mb-2">Document</label>
                    <input
                        type="file"
                        name="document"
                        required
                        class="block w-full rounded-2xl border-2 border-slate-200 bg-slate-50 px-5 py-4"
                        accept=".pdf,.png,.jpg,.jpeg,.txt"
                    >
                    <p class="mt-2 text-sm text-slate-500">Supported: PDF, PNG, JPG, TXT (max 10MB).</p>
                </div>

                <label class="flex items-center gap-3 p-4 rounded-2xl border border-slate-200 bg-slate-50">
                    <input type="checkbox" name="auto_simplify" value="1" checked class="w-5 h-5 rounded border-slate-300 text-purple-600 focus:ring-purple-500">
                    <span class="font-bold text-slate-700">Auto-simplify after extraction</span>
                </label>

                <button type="submit" class="w-full px-6 py-4 rounded-2xl bg-slate-900 text-white font-extrabold hover:bg-slate-800 transition">
                    Upload & Process
                </button>
            </form>

            <div class="mt-10 pt-8 border-t border-slate-100">
                <h2 class="text-xl font-extrabold text-slate-900">Paste text to simplify (no upload)</h2>
                <p class="mt-1 text-slate-600">If OCR isn’t available on the server, you can still simplify pasted text here.</p>

                <form action="{{ url('/simplify') }}" method="POST" class="mt-4 space-y-4">
                    @csrf
                    <textarea name="text" rows="7" class="w-full rounded-2xl border-2 border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-4 focus:ring-purple-100" placeholder="Paste text here...">{{ old('text') }}</textarea>
                    <button type="submit" class="w-full px-6 py-4 rounded-2xl bg-gradient-to-r from-purple-600 to-blue-600 text-white font-extrabold shadow-lg hover:shadow-xl transition">
                        Simplify Text
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
