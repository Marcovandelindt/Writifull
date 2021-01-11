@extends('layouts.app')

@section('content')
<h1 class="display-4">{{ $title }}</h4>

@if (!Auth::user()->friends()->count())
    <i>You have no friends... Yet!</i>
@else
    @foreach (Auth::user()->friends() as $user)
        {{ $user->name }}
    @endforeach
@endif
@endsection