<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>jobnow</title>
	<link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href={{ asset('/css/forms.css') }}>
	<link rel="stylesheet" href={{ asset('/css/translator.css') }}>
	<link rel="icon" href="{{ asset('images/favicon.ico') }}">
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script defer type="text/javascript"> 
		function loadGoogleTranslate() {
			new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
	</script>
</head>

<body>

  <main>
		<div class="container-fluid">
		<div class="row">
			<div class="col-sm-5 form-section-wrapper">
			<div class="ml-5 d-flex flex-row brand-wrapper ">
				<a href="{{ route('login') }}"><img src={{ asset('/images/black_logo.png') }} alt="logo" class="logo"></a>
			</div>
			<div class="ml-5" id="google_translate_element"></div>
			@include('flash')
			
			<div class="ml-5 w-75 form-wrapper my-auto">
			<h1 class="form-title">Reset Password</h1>

			<form  method="POST" action="{{ route('password.update') }}">
				@csrf

				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>

				</div>

				<div class="form-group mb-4">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
				</div>

				<div class="form-group mb-4">
					<label for="password-confirm">Confirm Password</label>
					<input type="password" name="password_confirmation" id="password-confirm" class="form-control @error('password-confirm') is-invalid @enderror" required>
				</div>
                <input type="hidden" name="token" value="{{ $token }}">

				<button name="login" id="login" class="btn btn-block form-btn" type="submit" value="Login">Reset password</button>
			</form>
		</div>
	</div>

	<div class="col-sm-7 px-0 d-none d-sm-block">
		<img src={{ asset('/images/reset.png') }} alt="login image" class="form-img">
	</div>
	  </div>
	</div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
</body>
</html>

