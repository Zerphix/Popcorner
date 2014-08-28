@extends('layout')

{{-- Definimos la etiqueta <title> en el HML5 --}}
@section ('title')

  Popcorner - New Movie
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
    <div id="option-form">

      <label id="createput">Movie Name:*</label>
      <input class="name" name="name" type="text" placeholder="Movie Name" maxlength="50">
    </div>

    <div id="option-form">

      <label id="createput">Movie Trailer:*</label>
      <input class="trailer" name="trailer" type="text" placeholder="Movie Trailer" maxlength="50">
    </div>

    <div id="option-form">

      <label id="createput">Genre:*</label>
      <select class="genre" name="genre">
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
        <option value="G">G</option>
        <option value="PG">PG</option>
        <option value="PG-13">PG-13</option>
        <option value="R">R</option>
        <option value="NC-17">NC-17</option>
      </select>
    </div>

    <div id="option-form">

      <textarea class="textarea" name="synopsis" placeholder="Synopsis..."></textarea>
    </div>

    <div id="option-form">

      <label id="createput">Poster:*</label>
      <input type="file" class="poster" name="poster" id="poster" accept="image/jpeg, image/png">
    </div>

    <div id="submit">

      {{ Form::submit('Create Movie') }}
    </div>
  </div>
@stop
