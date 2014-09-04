<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
		<title>Popcorner - Your Movie, Our Job!</title>
		<meta name="Copyright" content="edtorm@outlook.com">
	</head>

	<body>
		<H1>Esta es una zona restringida</H1>
		<h3>{{ Auth::user()->email; }}</h3>
		<h3>{{ Auth::user()->role; }}</h3>

		<!-- LOGOUT BUTTON -->
		<a href="{{ URL::to('logout') }}">Logout</a>
	</body>
	
</html>
