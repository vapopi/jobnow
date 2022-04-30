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
								<td scope="col">Verified</td>
								<td scope="col">Terms and conditions</td>
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

								<td>{{ $user->role_id }}</td>

                                <td><a href="{{ route('users.edit', $user->id) }}" class="b2Color w-100 btn btn-secondary" role="button">Edit</a></td>
								<td>

									<form id="form" method="POST" action="{{ route('users.destroy', $user) }}">
										@csrf
										@method("DELETE")
										<button id="destroy" type="button" class="btn btn-danger bsColor" data-bs-toggle="modal" data-bs-target="#confirmModal">Delete</button>
									</form>

									<!-- Modal -->
									<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													This action cannot be undone
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary bsColor" data-bs-dismiss="modal">Close</button>
													<button id="confirm" type="button" class="btn btn-primary bColor">Confirm</button>
												</div>
											</div>
										</div>
									</div>

									<!-- Submit confirm -->
									<script type="text/javascript">                
										const submit = document.getElementById('destroy')
										const  confirm = document.getElementById('confirm')

										// Disable form submit button
										submit.addEventListener("click", function( event ) {
											event.preventDefault()
											return false
										})

										// Enable submit via modal confirmation
										confirm.addEventListener("click", function( event ) {
											document.getElementById("form").submit(); 
										})
									</script>
									
								</td>
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