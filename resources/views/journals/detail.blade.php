@extends('layouts.app')

@section('content')
<h1 class="display-4">{{ $journal->name }} - Entries</h1>

@if (session('status'))
    <div class="alert alert-info" role="alert">
        {{ session('status') }}
    </div>
@endif

<table class="table table-striped text-center">
    <thead>
        <tr>
            <th scope="col">
                Title
            </th>
            <th scope="col">
                Locked
            </th>
            <th scope="col">
                Journal
            </th>
            <th scope="col">
                Created
            </th>
            <th scope="col">
                Last update
            </th>
            <th scope="col">
                &nbsp;
            </th>
            <th scope="col">
                &nbsp;
            </th>
        </tr>
    </thead>
    <tbody>
        @if (count($entries) > 0)
            @foreach ($entries as $entry)
                <tr>
                    <td>{{ $entry->getTitle() }}</td>
                    <td><i class="fas fa-{{ $entry->locked ? 'lock' : 'lock-open' }}"></i></td>
                    <td>{{ $journal->name }}</td>
                    <td>{{ $entry->created_at }}</td>
                    <td>{{ $entry->updated_at }}</td>
                    <td><a class="btn btn-warning" href="{{ route('journal.entry.edit', ['journal_id' => $journal->id, 'entry_id' => $entry->id]) }}">Edit</a></td>
                    <td><a class="btn btn-danger" href="{{ route('journal.entry.delete', ['entry_id' => $entry->id]) }}">Delete</a></td>
                </tr>
            @endforeach
        @else
            <tr>
            <td colspan="7"><i>Unfortunately we couldn't find any entries for this journal...</i></td>
            </tr>
        @endif
    </tbody>
</table>

<a class="btn btn-success" href="{{ route('journal.entry', ['id' => $journal->id]) }}">Create new entry</a>
@endsection