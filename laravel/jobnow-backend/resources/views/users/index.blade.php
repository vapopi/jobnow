@extends('layouts.app')

@section('content')

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
                                <td><a href="{{ route('users.edit', $user->id) }}" class="w-100 btn btn-secondary" role="button">Edit user</a></td>
                                <td><a href="{{ route('users.destroy', $user->id) }}" class="w-100 btn btn-secondary" role="button">Delete user</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<a class="btn btn-primary" href="{{ route('users.create') }}" role="button">+ Afegir nou usuari</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection