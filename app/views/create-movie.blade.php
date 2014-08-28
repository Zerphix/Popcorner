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

      <label id="createput">Release Date:*</label>
      <select class="date" name="day">
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select>

      <select class="date" name="month">
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">Decembe</option>
      </select>

      <select class="date" name="year">
        <option value="2014">2014</option>
        <option value="2013">2013</option>
        <option value="2012">2012</option>
        <option value="2011">2011</option>
        <option value="2011">2011</option>
        <option value="2010">2010</option>
        <option value="2009">2009</option>
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
