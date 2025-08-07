@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white rounded-2xl shadow-lg mt-10">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">✏️ Edit Journal</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('journals.update', $journal->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-lg font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $journal->title) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="body" class="block text-lg font-medium text-gray-700 mb-1">Content</label>
            <textarea name="body" id="body" rows="6"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Update your journal entry...">{{ old('body', $journal->body) }}</textarea>
        </div>

        <div>
            <label for="image" class="block text-lg font-medium text-gray-700 mb-1">Replace Image (optional)</label>
            <input type="file" name="image" id="image"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white">
            @if ($journal->image)
                <img src="{{ asset('storage/' . $journal->image) }}" alt="Current image" width="200" class="mt-2 rounded-lg shadow-md">
            @endif
        </div>

        <div class="text-right">
            <a href="{{ route('journals.index') }}"
                class="inline-block mr-4 text-gray-600 hover:text-blue-600 transition duration-200">Cancel</a>

            <button type="submit"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-200">
                💾 Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
