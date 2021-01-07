@extends('layouts.app')

@section('content')
<h1 class="display-4">{{ $journal->name }} - Entries</h1>

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
        </tr>
    </thead>
    <tbody>
        @if (!empty($entries))
            @foreach ($entries as $entry)
                <tr>
                    <td>{{ $entry->title }}</td>
                    <td><i class="fas fa-{{ $entry->locked ? 'lock' : 'lock-open' }}"></i></td>
                    <td>{{ $journal->name}}</td>
                    <td>{{ $entry->created_at }}</td>
                    <td>{{ $entry->updated_at }}</td>
                </tr>
            @endforeach
        @else

        @endif
    </tbody>
</table>
@endsection