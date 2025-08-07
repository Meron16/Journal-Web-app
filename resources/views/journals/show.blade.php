@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $journal->title }}</h1>
    <p><strong>By:</strong> {{ $journal->user->name }}</p>
    <p>{{ $journal->body }}</p>

    @if ($journal->image)
        <div class="mt-3">
            <img src="{{ asset('storage/' . $journal->image) }}" alt="Journal Image" width="400">
        </div>
    @endif

    @if (auth()->id() === $journal->user_id)
        <a href="{{ route('journals.edit', $journal->id) }}" class="btn btn-warning mt-3">Edit</a>

        <form action="{{ route('journals.destroy', $journal->id) }}" method="POST" class="d-inline-block mt-3">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this journal?')">Delete</button>
        </form>
    @endif
</div>
@endsection
