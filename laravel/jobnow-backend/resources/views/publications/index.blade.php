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
					{{ __('Posts') }}
				</div>
				<div class="card-body overflow-auto">
					<table class="table">
						<thead>
							<tr>
								<td scope="col">ID</td>
								<td scope="col">Title</td>
								<td scope="col">Description</td>
								<td scope="col">Likes</td>
								<td scope="col">Author</td>
								<td scope="col">Created</td>
								<td scope="col">Options</td>
							</tr>
						</thead>
						<tbody>
							@foreach ($posts as $post)
							<tr>
								<td>{{ $post->id }}</td>
								<td>{{ $post->title }}</td>
								<td>{{ $post->description }}</td>
								<td>{{ $post->likes }}</td>

                                @foreach ($users as $user)

                                    @if($user->id == $post->author_id)

								        <td>{{ $user->name }}</td>

                                    @endif

                                @endforeach

								<td>{{ $post->created_at }}</td>

                                <td><a href="{{ route('publications.show', $post->id) }}" class="b2Color w-100 btn btn-secondary" role="button">Show</a></td>
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