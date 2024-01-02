@extends('layouts.app')  
@section('post')

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
   
    <a href="/">Go Back</a>

