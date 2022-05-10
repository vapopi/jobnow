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
                    <a href="{{ route('login') }}"><img  src={{ asset('/images/black_logo.png') }} alt="logo" class="logo"></a>
                </div>
                <div class="ml-5" id="google_translate_element"></div>
                @include('flash')
                
                <div class="ml-5 w-75 form-wrapper my-auto">
                    <br>
                    <h1 class="form-title">Sign Up</h1>
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                            <label for="surnames">Surnames</label>
                            <input id="surnames" type="text" class="form-control @error('surnames') is-invalid @enderror" name="surnames" value="{{ old('surnames') }}" required autocomplete="surnames" required>
                            @error('surnames')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" required>
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="email">Phone</label>
                            <input id="phone" type="phone" class="form-control @error('email') is-invalid @enderror" name="phone" value="{{ old('email') }}" required autocomplete="phone" required>
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="birth">Date of birth</label>
                            <input id="birth" type="date" class="form-control @error('birth') is-invalid @enderror" name="birth_date" value="{{ old('birth') }}" required autocomplete="birth" required>
                            @error('birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                            <label for="password-confirm">Repeat your password</label>
                            <input type="password" name="password_confirmation" id="password-confirm" class="form-control" required>
                            @error('password-confirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <br>

                            <label for="password-confirm">Profile Picture</label>
                            <input name="avatar_id" id="file" type="file" required/>
                        </div>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" required {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                Terms and conditions
                            </label>
                        </div>
                        <br>
                        <button name="register" id="register" class="btn btn-block form-btn" type="submit" value="Sign Up">Sign Up</button>

                        </label>
                    </form>
                </div>
            </div>
            <div class="col-sm-7 px-0 d-none d-sm-block">
                <img src={{ asset('/images/register.jpg') }} alt="login image" class="form-img">
            </div>
        </div>
    </main>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
</body>
</html>
