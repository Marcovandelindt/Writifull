@extends('layouts.app')

@section('content')
<h1 class="display-4">Search Results:</h1>

@if (count($users) > 0)
    @foreach ($users as $user)
        <div class="media">
            <img class="mr-3" src="{{ $user->image ? asset('images/profile-pictures/' . $user->image) : '' }}" alt="{{ $user->name }}" height="64">
            <div class="media-body align-self-center">
                <a href="{{ route('users', ['id' => $user->id]) }}">
                    <h5 class="mt-0 is-bold">{{ $user->name }}</h5>
                </a>
            </div>
        </div>
    @endforeach
@else
<p><i>Unfortunately, we couldn't find results based on the following criteria: "{{ Request::get('q') }}"</i>...</p>
@endif

@endsection