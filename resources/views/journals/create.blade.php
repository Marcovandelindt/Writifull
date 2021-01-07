@extends('layouts.app')

@section('content')
<h1 class="display-4">Create new Journal</h4>
<form method="POST" action="{{ route('journals.create') }}">
    @csrf
    <div class="form-group profile-form-group">
        <label for="locked" class="is-bold">Locked: *</label><br />
        <input type="radio" name="locked" id="locked0" value="0"><label for="locked_0">&nbsp;No</label> 
        <input type="radio" name="locked" id="locked1" value="1"><label for="locked_0">&nbsp;Yes</label>
    </div>
    <div class="form-group">
        <label for="name" class="is-bold">Name: *</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Create</button>
    </div>
</form> 
@endsection