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

@endsection