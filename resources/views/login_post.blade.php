@extends('layouts.app')  
@section('content_login_post')

    <article>
        <h1> {{ $post -> title }} </h1>
        <a href="/user/{{$post->user->id}}"><?= $post->user->name;?></a> in <a href="/category/{{$post->category->id}}"><?= $post->category->name;?></a>
        <div>
            <p>
                {{-- using this is more secure --}}
                {{ $post -> body }}
            </p>
            
        </div>
    </article>
    

    <a href="/login">Go Back</a>
    <br>
    <br>
    <a href="/blogs/edit/<?= $post->id;?>">Edit</a>
    <br>
    <br>
    <form method="POST" action="{{ url('/blogs/delete', $post->id) }}" onsubmit="return confirm('Are you sure you want to delete this blog entry?')">
        @csrf
        @method('DELETE') {{-- Use the DELETE method for deletion --}}
        <button type="submit" class="btn btn-primary">Delete Blog</button>
    </form>
