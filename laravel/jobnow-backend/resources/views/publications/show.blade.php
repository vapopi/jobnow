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

    <div class="card-footer">
        <button id="destroy" type="button" class="btn btn-danger bsColor w-100" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $post->id }}">Delete</button>
    </div>

	<div class="modal fade" id="confirmModal{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Are you sure you want to delete the post number <strong>{{ $post->id }}</strong> ? <br>
					<span class="text-danger">This action cannot be undone.</span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary bsColor" data-bs-dismiss="modal">Close</button>
					<form id="form" method="POST" action="{{ route('publications.destroy', $post->id) }}">
						@csrf
						@method("DELETE")
						<button id="confirm" type="submit" class="btn btn-primary bColor">Confirm</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection