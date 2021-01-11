@extends('layouts.app')

@section('content')
<h1 class="display-4">Welcome back, Marco!</h1>
<a class="btn btn-success" href="#">Create new entry!</a>
<hr />

<div class="journal-entries-feed">
    @if (count($journalEntries) > 0)
        @foreach ($journalEntries as $entry)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $entry->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Posted by: {{ $entry->user->name }} on {{ $entry->created_at }}</h6>
                    <br />
                    {!! $entry->body !!}
                </div>
            </div>
        @endforeach
    @else
        <i>You currently have no posts to view. To fill up your feed, create the posts yourself or add some friends!</i>
    @endif
</div>
@endsection