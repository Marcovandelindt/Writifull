@extends('layouts.app')

@section('content')
<h1 class="display-4 ">{{ $title }}</h1>

<form method="POST" action="{{ route('journal.entry', ['id' => $journal->id]) }}">
    @csrf
    <div class="form-group profile-form-group">
        <label for="locked" class="is-bold">Locked: *</label><br />
        <input type="radio" name="locked" id="locked0" value="0"><label for="locked_0">&nbsp;No</label> 
        <input type="radio" name="locked" id="locked1" value="1"><label for="locked_0">&nbsp;Yes</label>
    </div>
    <div class="form-group profile-form-group">
        <label for="title" class="is-bold">Title: *</label><br />
        <input type="text" name="title" id="title" class="form-control mb-4" id="title" />
    </div>
    <div class="form-group">
        <label for="name" class="is-bold">Body: *</label>
        <textarea class="ckeditor" id="body" name="body"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Create</button>
    </div>
</form> 
@endsection