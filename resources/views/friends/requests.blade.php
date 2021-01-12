@extends('layouts.app')

@section('content')
<h1 class="display-5">
    Incoming Friend Requests
</h1>
@if ($requests->count())
    @foreach ($requests as $user) 
        <div class="media">
            <img class="mr-3" src="{{ $user->getProfilePicture() }}" alt="{{ $user->name }}" height="64">
            <div class="media-body align-self-center">
                <a href="{{ route('users', ['id' => $user->id]) }}">
                    <h5 class="mt-0 is-bold">{{ $user->name }}</h5>
                </a>
            </div>
        </div>
    @endforeach
    <br />
@else
    <p><i>You have no incoming friend requests</i></p>
@endif

<h1 class="display-5">
    Pending Friend Requests
</h1>
@if ($pending->count())
    @foreach ($pending as $user) 
        <div class="media">
            <img class="mr-3" src="{{ $user->getProfilePicture() }}" alt="{{ $user->name }}" height="64">
            <div class="media-body align-self-center">
                <a href="{{ route('users', ['id' => $user->id]) }}">
                    <h5 class="mt-0 is-bold">{{ $user->name }}</h5>
                </a>
            </div>
        </div>
    @endforeach
    <br />
@else
    <p><i>You have no pending friend requests</i></p>
@endif
@endsection