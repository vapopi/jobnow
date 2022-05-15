@extends('layouts.app')
@section('content')

<style>
    .color{  
        color: #2d0793;
    }

    .bColor{  
        background-color: #6356e5 !important;
        border-color: #6356e5 !important;
    }

    .bsColor{  
        background-color: #323232 !important;
        border-color: #323232 !important;
    }
</style>

<div class="card w-50 mx-auto" style="width: 18rem;">

    <div class="card-header">
        {{ __('Posts') }}
    </div>

    <div class="card-body">

        <div class="w-50 float-start">
            @foreach ($users as $user)
                @if ($user->id == $post->author_id)
                    <p class="card-text"><strong>Post created by: </strong>{{$user->name}}</p>
                @endif
            @endforeach
            <p class="card-text"><strong>Title: </strong>{{$post->title}}</p>
            <p class="card-text"><strong>Description:</strong> {{$post->description}}</p>
            <p class="card-text"><strong>Creation Date: </strong> {{$post->created_at}}</p>
        </div>

        <div class="w-50 float-end">
            <img class="float-end w-75" src="{{ asset("storage/{$file->filename}") }}" title="post-image"/>
        </div>
    </div>
</div>
@endsection