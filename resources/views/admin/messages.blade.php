@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-6 bottom-10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <header class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-900">Messages</h1>
        </header>

        @if($messages->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500">No messages available</p>
            </div>
        @else
            <div class="grid gap-4">
                @foreach($messages as $message)
                    <div class="bg-white rounded-lg border border-gray-100">
                        <div class="p-4">
                            <div class="text-gray-700">{{ $message->message }}</div>
                            <div class="mt-3 flex items-center text-sm text-gray-500">
                                <span class="mr-4">ID: {{ $message->admin_id }}</span>
                                <span>{{ $message->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
