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
							@foreach ($corporations as $corporation)
							<tr>
								<td>{{ $corporation->id }}</td>
								<td>{{ $corporation->name }}</td>
								<td>{{ $corporation->email }}</td>
								<td>{{ $corporation->creation_date }}</td>
								@foreach ($users as $user)
									@if ($corporation->author_id == $user->id)
										<td>{{ $user->name }}</td>
									@endif
								@endforeach	
								</td>
                                <td><a href="{{ route('corporations.show', $corporation->id) }}" class="b2Color w-100 btn btn-primary" role="button">View Company</a></td>
                                <td><a href="{{ route('corporations.edit', $corporation->id) }}" class="b2Color w-100 btn btn-primary" role="button">Edit Company</a></td>
                                <td>
									<button id="destroy" type="button" class="w-100 btn btn-danger bsColor" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $corporation->id }}">Delete Company</button>

									<div class="modal fade" id="confirmModal{{ $corporation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Delete Company</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													Are you sure you want to delete the company <strong>{{ $corporation->name }}</strong> ? <br>
													<span class="text-danger">This action cannot be undone.</span>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary bsColor" data-bs-dismiss="modal">Close</button>
													<form id="form" method="POST" action="{{ route('corporations.destroy', $corporation->id) }}">
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