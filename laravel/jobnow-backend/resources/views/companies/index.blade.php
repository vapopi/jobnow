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
					{{ __('Companies') }}
					<a href="{{ route('dashboard') }}" class="float-end link-secondary" role="button"> 🡰 Go back</a>
				</div>
				<div class="card-body overflow-auto">
					<table class="table">
						<thead>
							<tr>
								<td scope="col">ID</td>
								<td scope="col">Name</td>
								<td scope="col">Email</td>
								<td scope="col">Creation date</td>
								<td scope="col">Author</td>
								<td scope="col">Options</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($companies as $company)
							<tr>
								<td>{{ $company->id }}</td>
								<td>{{ $company->name }}</td>
								<td>{{ $company->email }}</td>
								<td>{{ $company->creation_date }}</td>

								@foreach ($users as $user)
									@if($user->id == $company->author_id)
										<td>{{ $user->name }}</td>
									@endif
								@endforeach

                                <td><a href="{{ route('companies.edit', $company->id) }}" class="b2Color w-100 btn btn-secondary" role="button">Edit</a></td>
								<td>
									<button id="destroy" type="button" class="btn btn-danger bsColor" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $company->id }}">Delete</button>

									<div class="modal fade" id="confirmModal{{ $company->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Delete Company</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													Are you sure you want to delete the company <strong>{{ $company->name }}</strong> ? <br>
													<span class="text-danger">This action cannot be undone.</span>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary bsColor" data-bs-dismiss="modal">Close</button>
													<form id="form" method="POST" action="{{ route('companies.destroy', $company->id) }}">
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
				</div>
			</div>
		</div>
	</div>
</div>

@endsection