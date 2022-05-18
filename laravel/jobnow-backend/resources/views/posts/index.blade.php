@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<head>
    <link href="{{ asset('css/posts.css') }}" rel="stylesheet">
</head>

<body>
    <div id="posts" data-userId={{$authUserId}}></div>
</body>
</html>
@endsection