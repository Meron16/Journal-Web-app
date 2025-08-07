@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white rounded-2xl shadow-lg mt-10">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $journal->title }}</h1>

    <p class="text-gray-600 mb-1">By <span class="font-semibold">{{ $journal->user->name }}</span></p>
    <p class="text-gray-700 whitespace-pre-line mb-6">{{ $journal->body }}</p>

    @if ($journal->image)
        <div class="mb-6">
            <img src="{{ asset('storage/' . $journal->image) }}" alt="Journal Image" class="rounded-lg shadow-md max-w-full h-auto">
        </div>
    @endif

    @if (auth()->id() === $journal->user_id)
        <div class="flex gap-4">
            <a href="{{ route('journals.edit', $journal->id) }}" 
                class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-5 py-2 rounded-lg font-semibold transition duration-200">
                ✏️ Edit
            </a>

            <form action="{{ route('journals.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this journal?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-semibold transition duration-200">
                    🗑 Delete
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
