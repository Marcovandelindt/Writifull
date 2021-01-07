@extends('layouts.app')

@section('content')
<h1 class="display-4">{{ $title }}</h1>
<hr />
<form method="POST" action="{{ route('profile') }}">
    @csrf
    <div class="form-group profile-form-group">
        <label for="name" class="is-bold">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}" />
    </div>
    <div class="form-group profile-form-group">
        <label for="username" class="is-bold">Username:</label>
        <input type="text" name="username" id="username" class="form-control" value="{{ Auth::user()->username }}" />
    </div>
    <div class="form-group profile-form-group">
        <label for="birth_date" class="is-bold">Date of Birth:</label>
        <input type="text" name="birth_date" id="birth_date" class="form-control" value="{{ Auth::user()->birth_date }}" placeholder="yyyy/mm/dd" />
    </div>
    <div class="form-group profile-form-group">
        <button type="submit" class="btn btn-success">Edit profile</button>
    </div>
</form>
@endsection