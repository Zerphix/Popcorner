@extends('layout')

@section('content')

  <div id="popular_movie">

    <h1 class="title">Most Popular</h1>

    @foreach($popular as $movie)
    <div id="movie">

      <a href="movie/{{ strtolower(str_replace(' ', '-', $movie->name)) }}">

        <img class="poster" src="../poster/{{ $movie->poster }}" title="{{ $movie->name }}">
      </a>

      <a class="movie_name" href="movie/{{ strtolower(str_replace(' ', '-', $movie->name)) }}">{{ $movie->name }}</a>
    </div>
    @endforeach
  </div>

  <div id="coming_movie">

    <h1 class="title">Coming Soon!</h1>

    @foreach($coming as $movie)
    <div id="movie">

      <a href="movie/{{ $movie->name }}">

        <img class="poster" src="poster/{{ $movie->poster }}" title="{{ $movie->name }}">
      </a>

      <a class="movie_name" href="movie/{{ $movie->name }}">{{ $movie->name }}</a>
    </div>
    @endforeach
  </div>

  <div id="latest_movie">

    <h1 class="title">&nbsp;Latest Movies</h1>

    @foreach($ultimos as $movie)
    <div id="movie_latest">

      <a href="movie/{{ $movie->name }}">

        <img class="poster" src="poster/{{ $movie->poster }}" title="{{ $movie->name }}">
      </a>

      <a class="movie_name" href="movie/{{ $movie->name }}">{{ $movie->name }}</a>
    </div>
    @endforeach
  </div>
@stop
