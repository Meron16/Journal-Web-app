@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">My Journals</h2>
    <a href="{{ route('journals.create') }}" class="bg-teal-500 text-white px-4 py-2 rounded hover:bg-teal-600">+ Add Journal</a>
</div>

@if (session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@forelse ($journals as $journal)
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 mb-4">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-semibold">{{ $journal->title }}</h3>
            <small class="text-sm text-gray-500">by {{ $journal->user->name }}</small>
        </div>
        @if($journal->image)
            <img src="{{ asset('storage/' . $journal->image) }}" class="mt-2 rounded w-full max-h-60 object-cover">
        @endif
        <p class="mt-2 text-gray-700 dark:text-gray-200">{{ Str::limit($journal->body, 150) }}</p>
        <div class="mt-4 flex gap-2">
            <a href="{{ route('journals.show', $journal->id) }}" class="text-blue-500 hover:underline">View</a>
            @if(auth()->id() === $journal->user_id)
                <a href="{{ route('journals.edit', $journal->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                <form action="{{ route('journals.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                </form>
            @endif
        </div>
    </div>
@empty
    <p>No journals yet.</p>
@endforelse
@endsection
