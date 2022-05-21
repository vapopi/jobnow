@extends('layouts.app')
@section('content')

@if($user->id == Auth::user()->id)
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<div class="card">
					<div class="card-header">
						Applicated users for the offer with ID: {{ $offer->id }} 
					</div>
					<div class="card-body overflow-auto">
						<table class="table">
							<thead>
								<tr>
									<td scope="col">User</td>
									<td scope="col">Curriculum</td>
								</tr>
							</thead>
							<tbody>
								@foreach ($applicatedUsers as $aUser)
									@foreach($users as $user)
										@if($aUser->user_id == $user->id)
											<tr>
												<td>{{$user->email}}</td>
												<td>
													@foreach($files as $file)
														@if($aUser->curriculum == $file->id)
															@if(str_ends_with($file->filename, ".pdf"))
																<a role="button" style="background-color: #6356e5 !important;" class="w-100 btn btn-primary" download="{{'CV ' . $user->name.' '.$user->surnames}}" href="{{ asset("storage/{$file->filename}") }}">
																	<i class="bi bi-download"></i> Download CV
																</a>
															@endif
														@endif
													@endforeach												
												</td>
											</tr>
										@endif								
									@endforeach
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@else
	<p>You cannot acess here</p>
@endif

@endsection