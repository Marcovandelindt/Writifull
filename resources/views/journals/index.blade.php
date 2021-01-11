@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-info" role="alert">
        {{ session('status') }}
    </div>
@endif

<div>
    <h1 class="display-4 float-left">{{ $title }}</h1>
    <a class="float-right btn btn-success create-journal-button" href="{{ route('journals.create') }}"><i class="fas fa-plus"></i> Create Journal</a>
</div>
<br />

<table class="table table-striped text-center">
    <thead>
        <tr>
            <th scope="col">
                Name
            </th>
            <th scope="col">
                Locked
            </th>
            <th scope="col">
                Entries
            </th>
            <th scope="col">
                Created
            </th>
            <th scope="col">
                Last update
            </th>
        </tr>
    </thead>
    <tbody>
        @if (count($journals) > 0)
            @foreach ($journals as $journal)
            <tr>
                <td><a href="{{ route('journals.detail', ['id' => $journal->id]) }}">{{ $journal->name }}</a></td>
                <td><i class="fas fa-{{ $journal->locked ? 'lock' : 'lock-open' }}"></i></td>
                <td>{{ $journal->entries->count() }}</td>
                <td>{{ $journal->created_at }}</td>
                <td>{{ !empty($journal->updated_at) ? $journal->updated_at : '' }}</td>
            </tr>
            @endforeach
        @else
        <tr>
            <td colspan="5"><i>No journals found...</i></td>
        </tr>
        @endif
    </tbody>
</table>
@endsection