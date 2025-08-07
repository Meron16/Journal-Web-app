@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Journal</h1>

    <form action="{{ route('journals.update', $journal->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $journal->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="body">Body</label>
            <textarea name="body" rows="5" class="form-control" required>{{ old('body', $journal->body) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image">Replace Image (Optional)</label>
            <input type="file" name="image" class="form-control">
            @if ($journal->image)
                <img src="{{ asset('storage/' . $journal->image) }}" alt="Current image" width="200" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update Journal</button>
    </form>
</div>
@endsection
