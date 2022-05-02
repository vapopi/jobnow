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
					<a href="{{ route('security.index') }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>
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

                                <td><a href="{{ route('accounts.show', $user->id) }}" class="b2Color w-100 btn btn-secondary" role="button">Show</a></td>
                                <td><a href="{{ route('accounts.edit', $user->id) }}" class="b2Color w-100 btn btn-secondary" role="button">Edit</a></td>
								<td>
									<button id="destroy" type="button" class="btn btn-danger bsColor" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $user->id }}">Delete</button>

									<div class="modal fade" id="confirmModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													Are you sure you want to delete the user <strong>{{ $user->name }}</strong> ? <br>
													<span class="text-danger">This action cannot be undone.</span>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary bsColor" data-bs-dismiss="modal">Close</button>
													<form id="form" method="POST" action="{{ route('accounts.destroy', $user->id) }}">
														@csrf
														@method("DELETE")
														<button id="confirm" type="submit" class="btn btn-primary bColor">Confirm</button>
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
					<a class="bColor btn btn-primary" href="{{ route('accounts.create') }}" role="button">+ Add user</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection