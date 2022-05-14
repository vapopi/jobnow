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
        {{ __('User Profile') }}
    </div>

    
    <div class="card-body">

        <div class="w-50 float-start">
            <p class="card-text"><strong>Name</strong> {{$account->name}}</p>
            <p class="card-text"><strong>Surnames:</strong> {{$account->surnames}}</p>
            <p class="card-text"><strong>Email:</strong> {{$account->email}}</p>
            <p class="card-text"><strong>Phone:</strong> {{$account->phone}}</p>
            <p class="card-text"><strong>Birth date:</strong> {{$account->birth_date}}</p>
            <p class="card-text"><strong>Followers:</strong> {{$follows}}</p>


            <div>
                @if($account->premium == 0)
                    <p class="color">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                    </svg>
                    This user is not premium yet!</p>
                @else
                    <p class="color">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                        </svg>
                        This user is premium!
                    </p>
                @endif
            </div>
        </div>

        <div class="w-50 float-end">
            <img class="float-end w-75" src="{{ asset("storage/{$file->filename}") }}" title="Profile picture"/>
        </div>

    </div>
  </div>
      <br>
    <h5 class="text-center">Posts of the user</h5>
    @foreach($posts as $post)

        <div class="card w-50 mx-auto" style="width: 18rem;">
            <div class="card-body overflow-auto">
                
                <div class="w-50">
                    @foreach($files as $file)
                        @if($file->id == $post->image_id)
                            <div class="w-50 float-end">
                                <img class="float-end w-75" src="{{ asset("storage/{$file->filename}") }}" title="Profile picture"/>
                            </div>
                        @endif
                    @endforeach

                    <p>Title: {{ $post->title }}</p>
                    <p>Description: {{ $post->description }}</p>
                </div>
            </div>
        </div>
        <br>
    @endforeach
</div>

@endsection