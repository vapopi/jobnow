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
					{{ __('Users') }}
				</div>
				<div class="card-body overflow-auto">
					<table class="table">
						<thead>
							<tr>
								<td scope="col">ID</td>
								<td scope="col">Email</td>
								<td scope="col">Name</td>
								<td scope="col">Surnames</td>
								<td scope="col">Phone</td>
								<td scope="col">Birth date</td>
								<td scope="col">Verified</td>
								<td scope="col">Terms</td>
								<td scope="col">Premium</td>
								<td scope="col">Role</td>
								<td scope="col">Options</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->surnames }}</td>
								<td>{{ $user->phone }}</td>
								<td>{{ $user->birth_date }}</td>
								<td>{{ $user->email_verified_at }}</td>

                                @if($user->terms == 0)
								    <td>Not Accepted</td>
                                @else
								    <td>Accepted</td>
                                @endif

                                @if($user->premium == 0)
								    <td>Not obtained</td>
                                @else
								    <td>Obtained</td>
                                @endif

								@foreach ($roles as $role)
									@if($role->id == $user->role_id)
										<td>{{ $role->name }}</td>
									@endif
								@endforeach

                                <td><a href="{{ route('users.show', $user->id) }}" class="b2Color w-100 btn btn-secondary" role="button">Edit</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<a class="bColor btn btn-primary" href="{{ route('users.create') }}" role="button">+ Afegir nou usuari</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection