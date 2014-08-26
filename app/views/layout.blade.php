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
		@include('sidebar')
		
		@include('topbar')

		<div class="center" id="app_container">

			@yield('content')
		</div>
	</body>
</html>