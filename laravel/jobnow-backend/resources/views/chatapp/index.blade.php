@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<head>
    <link href="{{ asset('css/chatapp.css') }}" rel="stylesheet">
</head>

<body>
    <div id="chatapp" data-userId={{$authUserId}}></div>
</body>
</html>

@endsection