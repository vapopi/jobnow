@extends('layouts.app')

@section('content')
<style>

    .color{  
        color: #ffffff;
    }

    .bColor{  
        background-color: #2d0793 !important;
        border-color: #2d0793 !important;
    }

    .b2Color{  
        background-color: #6356e5 !important;
        border-color: #6356e5 !important;
    }

    .bsColor{  
        background-color: #323232 !important;
    }

</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{__('Notifications') }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">Title</td>
                                <td scope="col">Description</td>
                                <td class="w-25" scope="col">Options</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ $notification->title }}</td>
                                <td>{{ $notification->description }}</td>
                                <td>
                                    <form id="form" method="POST" action="{{route('notifications.destroy', $notification->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button id="confirm" type="submit" class="color bsColor btn btn-secondary">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection