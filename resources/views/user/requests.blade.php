@extends('layouts.app')

@section('content')

    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Caregiver Requests</h1>
        <p class="text-gray-500 mb-8">Manage incoming connection requests from caregivers who want to assist you.</p>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r">
                {{ session('error') }}
            </div>
        @endif

        @if($requests->isEmpty())
            <div class="text-center py-16 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                <p class="text-gray-500 font-medium">No pending requests at this time.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($requests as $caregiver)
                    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="h-14 w-14 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xl">
                                {{ substr($caregiver->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $caregiver->name }}</h3>
                                <p class="text-sm text-gray-500">wants to connect as your caregiver</p>
                                <p class="text-xs text-blue-500 mt-1 font-medium bg-blue-50 inline-block px-2 py-1 rounded">
                                    Allows access to profile & preferences
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                             <form action="{{ route('user.requests.approve', $caregiver) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white font-bold rounded-xl shadow-sm hover:bg-blue-700 transition-colors">
                                    Accept
                                </button>
                            </form>
                            
                            <form action="{{ route('user.requests.deny', $caregiver) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-5 py-2.5 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                                    Decline
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
