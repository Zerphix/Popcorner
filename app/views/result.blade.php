@extends('layout')

{{-- Definimos la etiqueta <title> en el HML5 --}}
@section ('title')

  Popcorner - Creation Complete
@stop

{{-- Agregamos un css propio para organizar las opciones del video --}}
@section ('css')

  {{ HTML::style('css/movies.css') }}
@stop

{{-- Cuerpo de la sección "movie" --}}
@section('content')

  <div id="movie_list">

    {{-- Si el registro se lleva a cabo, mostramos el mensaje --}}
    @if(Session::has('mensaje'))

      <h1 id="result_message">{{ Session::get('mensaje') }}</h1>
    @endif
  </div>
@stop
