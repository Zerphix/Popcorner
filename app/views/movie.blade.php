@extends('layout')

{{-- Definimos la etiqueta <title> en el HML5 --}}
@section ('title')

	@foreach($info as $movie)

		Popcorner - {{ $movie->name }}
	@endforeach
@stop

{{-- Agregamos un css propio para organizar las opciones del video --}}
@section ('css')

	{{ HTML::style('css/movie.css') }}
@stop

{{-- Cuerpo de la sección "movie" --}}
@section('content')

	@foreach($info as $movie)

		{{-- Iniciamos con la sección del trailer --}}
		<div id="left_movie_info">

			<div id="movie_trailer">

				<iframe width="560" height="315" src="//www.youtube-nocookie.com/embed/{{ $movie->trailer }}" frameborder="0" rel="0" allowfullscreen></iframe>
			</div>

			<div id="synopsis">

				<p id="synopsis">{{ $movie->synopsis }}</p>
			</div>
		</div>

		<div id="right_movie_info">

			<div id="general_info">

				<h3 id="movie_title">{{ $movie->name }}</h3>

				<div id="left">

					<img id="trailer" class="poster" src="../poster/{{ $movie->poster }}" title="{{ $movie->name }}">
				</div>

				<div id="right">

					<p id="info_text"><strong>Release:</strong> {{ $movie->released_at }}</p>

					<p id="info_text"><strong>Genre:</strong> {{ $movie->genre }}</p>

					<p id="info_text"><strong>Classification:</strong> {{ $movie->classification }}</p>

					<p id="rents"><strong id="rents">{{ $movie->rents }} RENTS</strong></p>
				</div>
			</div>

			<div id="movie_tasks">

				<a id="task_link" href="#">Rent this movie</a>
			</div>

			<div id="movie_tasks">

				<a id="task_link" href="../edit-movie/{{ $movie->movie_id }}">Edit this movie</a>
			</div>

			<!-- Comentada ya que aun esta un poco buggy la interfaz
			<div id="movie_tasks">

				<center><a id="task_link" href="#">Delete</a></center>
			</div>-->
		</div>
	@endforeach
@stop
