@extends('layouts.app')

@section('content')
<h1 class="display-4">{{ $title }}</h4>

@if (!Auth::user()->friends()->count())
    <i>You have no friends... Yet!</i>
@else
    @foreach (Auth::user()->friends() as $user)
       <div class="media">
            <img class="mr-3" src="{{ $user->getProfilePicture() }}" height="80">
            <div class="media-body align-self-center">
                <a href="{{ route('users', ['id' => $user->id]) }}">
                    <h5 class="is-bold"><strong>{{ $user->name }}</strong></h5>
                </a>
            </div>
       </div>
    @endforeach
@endif
@endsection