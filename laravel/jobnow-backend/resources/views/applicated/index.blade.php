@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<head>
    <link href="{{ asset('css/offers.css') }}" rel="stylesheet">
</head>

<body>
    <div id="react-applyOffer" data-userId={{$authUserId}}></div>
</body>
</html>

@endsection