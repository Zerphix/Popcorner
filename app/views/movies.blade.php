@extends('layout')

{{-- Definimos la etiqueta <title> en el HML5 --}}
@section ('title')

	Popcorner - Movie Catalog
@stop

{{-- Agregamos un css propio para organizar las opciones del video --}}
@section ('css')

	{{ HTML::style('css/movies.css') }}
@stop

{{-- Cuerpo de la sección "movie" --}}
@section('content')

	<div id="movie_list">

		@foreach($movies as $movie)
		<div id="movie_fromlist">

			<a href="../movie/{{ strtolower(str_replace(' ', '-', $movie->name)) }}">

				<img class="poster" src="../poster/{{ $movie->poster }}" title="{{ $movie->name }}">
			</a>

			<a class="movie_name" href="../movie/{{ strtolower(str_replace(' ', '-', $movie->name)) }}">{{ $movie->name }}</a>
		</div>
		@endforeach
	</div>
@stop
