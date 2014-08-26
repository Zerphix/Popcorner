<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
		{{ HTML::style('css/base.css') }}
		@yield('css')

		<title>@yield('title', 'Popcorner - Your Movie, Our Job!')</title>
		<meta name="Copyright" content="edtorm@outlook.com">
	</head>

	<body>

		<H1>Login:</H1>

			{{ Form::open(array('url' => '/')) }}
			Usuario: {{ Form::text('username') }}
			<BR />
			Contraseña: {{ Form::password('password') }}
			<BR />
			{{ Form::submit('Login') }}
	</body>
</html>
