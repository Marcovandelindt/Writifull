@extends('layouts.app')

@section('content')
<h1 class="display-4">{{ $title }}</h1>

@if (session('status'))
<div class="alert alert-info">
    {{ session('status') }}
</div>
@endif

@if (Auth::user()->hasFriendRequestPending($user))
    <p>Waiting for {{ $user->name }} to accept your request
@elseif (Auth::user()->hasFriendRequestReceived($user))
    <a class="btn btn-primary" href="#">Accept Friend Request</a>
@elseif (Auth::user()->isFriendsWith($user)) 
    <p>You and {{ $user->name }} are already friends!</p>
@else
    <a href="{{ route('friends.add', ['id' => $user->id]) }}" class="btn btn-primary">Add Friend</a>
@endif

@endsection