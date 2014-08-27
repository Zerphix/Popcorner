<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
		{{ HTML::style('css/login.css') }}
		@yield('css')

		<title>@yield('title', 'Popcorner - Your Movie, Our Job!')</title>
		<meta name="Copyright" content="edtorm@outlook.com">
	</head>

	<body>

		{{-- contenedor del form --}}
		<div id="topbar">

			<div id="center" class="center">

				{{-- Contenedor izquierdo --}}
				<div id="left_top_box">
					
					<div id="base_icon">
						<a href="/"><img src="{{ asset('img/top_logo.png') }}"></a>
					</div>
				</div>

				{{-- Contenedor derecho --}}
				<div id="right_top_box">

					{{ Form::open(array('url' => '/')) }}
					<div id="username">

						<label id="logput">Username: </label>
						<input class="logput" name="username" type="text" placeholder="Username">
					</div>

					<div id="password">

						<label id="logput">Password: </label>
						<input class="logput" name="password" type="password" placeholder="Password">
					</div>

					<div id="submit">

						{{ Form::submit('Login') }}
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
