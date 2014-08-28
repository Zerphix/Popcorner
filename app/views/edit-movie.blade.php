@extends('layout')

{{-- Definimos la etiqueta <title> en el HML5 --}}
@section ('title')

  Popcorner - Edit Movie
@stop

{{-- Agregamos un css propio para organizar las opciones del video --}}
@section ('css')

  {{ HTML::style('css/movies.css') }}
@stop

{{-- Cuerpo de la sección "movie" --}}
@section('content')

  <div id="movie_list">

    {{-- Si el formulario contiene errores --}}
    @if(Session::has('errors'))

      <h1 id="error_message">{{ Session::get('errors') }}</h1>
    @endif

    {{ Form::open(array('url' => 'create-movie', 'files' => true)) }}
    @foreach($movies as $movie)
    <div id="option-form">

      <label id="createput">Movie Name:*</label>
      <input value = "{{ $movie->name }}" class="name" name="name" type="text" placeholder="Movie Name" maxlength="50">
    </div>

    <div id="option-form">

      <label id="createput">Movie Trailer:*</label>
      <input value = "{{ $movie->trailer }}" class="trailer" name="trailer" type="text" placeholder="Movie Trailer" maxlength="50">
    </div>

    <div id="option-form">

      <label id="createput">Genre:*</label>
      <select class="genre" name="genre">
        <option value="{{ $movie->genre }}">{{ $movie->genre }}</option>
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="Animation">Animation</option>
        <option value="Comedy">Comedy</option>
        <option value="Drama">Drama</option>
        <option value="Horror">Horror</option>
        <option value="Romance">Romance</option>
      </select>
    </div>

    <div id="option-form">

      <label id="createput">Classification:*</label>
      <select class="classification" name="classification">
        <option value="{{ $movie->name }}">{{ $movie->classification }}</option>
        <option value="G">G</option>
        <option value="PG">PG</option>
        <option value="PG-13">PG-13</option>
        <option value="R">R</option>
        <option value="NC-17">NC-17</option>
      </select>
    </div>

    <div id="option-form">

      <textarea class="textarea" name="synopsis" placeholder="Synopsis...">
        {{ $movie->synopsis }}
      </textarea>
    </div>
    @endforeach

    <div id="submit">

      {{ Form::submit('Update Movie') }}
    </div>
  </div>
@stop
