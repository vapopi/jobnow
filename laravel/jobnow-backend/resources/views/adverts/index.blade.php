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
                    {{__('Offers') }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Title</td>
                                <td class="w-25" scope="col">Description</td>
                                <td class="w-25" scope="col">Company</td>
                                <td class="w-25" scope="col">Professional Area</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adverts as $advert)
                            <tr>
                                <td>{{ $advert->id }}</td>
                                <td>{{ $advert->title }}</td>
                                <td>{{ $advert->description }}</td>

                                @foreach ($companies as $company)
                                    @if($company->id == $advert->company_id)
                                        <td>{{ $company->name }}</td>
                                    @endif
                                @endforeach


                                @foreach ($areas as $area)
                                    @if($area->id == $advert->professional_area_id)
                                        <td>{{ $area->name }}</td>
                                    @endif
                                @endforeach

                                <td>
                                    <button class="w-100 bsColor color btn btn-secondary" id="destroy" type="submit" role="button" data-bs-toggle="modal" data-bs-target="#confirmModal{{$advert->id}}">Delete</button>
                                    <div class="modal fade" id="confirmModal{{$advert->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete offer</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the offer with ID <strong>{{ $advert->id }}</strong> ? <br>
                                                    <span class="text-danger">This action cannot be undone.</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="color bsColor btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <form id="form" method="POST" action="{{route('adverts.destroy', $advert->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button id="confirm" type="submit" class="color bColor btn btn-primary">Confirm</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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