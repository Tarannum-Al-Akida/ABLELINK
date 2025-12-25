@extends('layouts.app')

@section('title', 'Manage Aid Directory - AbleLink')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">Aid Directory (Admin)</h1>
            <p class="mt-1 text-slate-600">Create, edit, and publish resources shown on the public Aid Directory.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('aid-directory.index') }}" class="px-5 py-3 rounded-2xl bg-white border border-slate-200 font-bold text-slate-700 hover:bg-slate-50 transition">
                View public directory
            </a>
            <a href="{{ route('admin.aid-resources.create') }}" class="px-5 py-3 rounded-2xl bg-slate-900 text-white font-extrabold hover:bg-slate-800 transition">
                Add resource
            </a>
        </div>
    </div>

    @if (session('status'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 px-6 py-4 rounded-2xl font-bold">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-6 md:p-8">
            <form method="GET" action="{{ route('admin.aid-resources.index') }}" class="flex flex-col md:flex-row gap-3 md:items-center">
                <input name="q" value="{{ $q }}" placeholder="Search name/category/region..."
                       class="flex-1 rounded-2xl border-2 border-slate-200 bg-white px-5 py-4 focus:outline-none focus:ring-4 focus:ring-blue-100">
                <button class="px-6 py-4 rounded-2xl bg-slate-900 text-white font-extrabold hover:bg-slate-800 transition">
                    Search
                </button>
                <a href="{{ route('admin.aid-resources.index') }}" class="px-6 py-4 rounded-2xl bg-white border border-slate-200 font-bold text-slate-700 hover:bg-slate-50 transition text-center">
                    Reset
                </a>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-6 md:p-8 overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs uppercase tracking-wider text-slate-400">
                        <th class="py-3">Name</th>
                        <th class="py-3">Category</th>
                        <th class="py-3">Region</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($resources as $res)
                        <tr>
                            <td class="py-4 font-extrabold text-slate-900">{{ $res->name }}</td>
                            <td class="py-4 text-slate-700 font-bold">{{ $res->category }}</td>
                            <td class="py-4 text-slate-600">{{ $res->region ?? '—' }}</td>
                            <td class="py-4">
                                @if($res->is_active)
                                    <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-extrabold">Active</span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-extrabold">Hidden</span>
                                @endif
                            </td>
                            <td class="py-4">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.aid-resources.edit', $res) }}" class="px-4 py-2 rounded-xl bg-white border border-slate-200 font-bold text-slate-700 hover:bg-slate-50 transition">
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.aid-resources.destroy', $res) }}" onsubmit="return confirm('Delete this resource?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-4 py-2 rounded-xl bg-red-600 text-white font-extrabold hover:bg-red-700 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                {{ $resources->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

