@extends('layouts.app') 
@section('user_post_edit')

<form method="POST" action="{{ url('/blogs/update', $blog->id) }}">
    @csrf
    @method('PUT') {{-- Use the PUT method for updating --}}
    <div class="form-group">
        <label for="title">Title</label>
        <input id="title" type="text" class="form-control" name="title" value="{{ $blog->title }}" required>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input id="slug" type="text" class="form-control" name="slug" value="{{ $blog->slug }}" required>
    </div>
    <div class="form-group">
        <label for="excerpt">Excerpt</label>
        <input id="excerpt" type="text" class="form-control" name="excerpt" value="{{ $blog->excerpt }}" required>
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea id="body" class="form-control" name="body" required>{{ $blog->body }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update Blog</button>
</form>




