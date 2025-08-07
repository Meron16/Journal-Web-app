@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Journal</h1>

    <form action="{{ route('journals.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="body">Body</label>
            <textarea name="body" rows="5" class="form-control" required>{{ old('body') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image">Optional Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Journal</button>
    </form>
</div>
@endsection
