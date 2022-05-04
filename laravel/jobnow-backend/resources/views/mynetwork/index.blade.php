@extends('layouts.app')
@section('content')
<style>
    .color{  
        color: #6356e5;
        font-weight: bold;
    }

    .bColor{  
        background-color: #6356e5 !important;
        border-color: #6356e5 !important;
    }

	.b2Color{  
        background-color: #2d0793 !important;
        border-color: #6356e5 !important;
    }

    .bsColor{  
        background-color: #323232 !important;
        border-color: #323232 !important;
    }
</style>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-13">
			<div class="card">
				<div class="card-header">
					{{ __('My Network') }}
					<a href="{{ route('dashboard') }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>
				</div>
                <div class="card-body overflow-auto">

                    <div class="card-header">
					    {{ __('Users in the App') }}
				    </div>

                    <div class="card-body overflow-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">Name</td>
                                    <td scope="col">Surnames</td>
                                    <td scope="col">Email</td>
                                    <td scope="col">Phone</td>
                                    <td scope="col">Birth Date</td>
                                    <td scope="col">Options</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->surnames}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->phone}}</td>
                                    <td>{{ $user->birth_date}}</td>
                                    <td><a href="{{ route('users.show', $user->id) }}" class="b2Color w-100 btn btn-secondary" role="button">Show User</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-header">
					    {{ __('Companies in the App') }}
				    </div>

                    <div class="card-body overflow-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">Name</td>
                                    <td scope="col">Email</td>
                                    <td scope="col">Creation Date</td>
                                    <td scope="col">Author</td>
                                    <td scope="col">Options</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->creation_date }}</td>

                                    @foreach ($users as $user)
                                        @if($user->id == $company->author_id)
                                            <td>{{ $user->name }}
                                        @endif
                                    @endforeach

                                    <td><a href="{{ route('companies.show', $company->id) }}" class="b2Color w-100 btn btn-primary" role="button">View Company</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

@endsection