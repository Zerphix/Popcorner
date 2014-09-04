@extends('layout')

{{-- Definimos la etiqueta <title> en el HML5 --}}
@section ('title')

  Popcorner - New User
@stop

{{-- Agregamos un css propio para organizar las opciones del video --}}
@section ('css')

  {{ HTML::style('css/movies.css') }}
  {{ HTML::style('css/users.css') }}
@stop

{{-- Cuerpo de la sección "movie" --}}
@section('content')

  <div id="movie_list">

    {{-- Si el formulario contiene errores --}}
    @if(Session::has('errors'))

      <h1 id="error_message">{{ Session::get('errors') }}</h1>
    @endif

    {{ Form::open(array('url' => 'create-user', 'files' => true)) }}
    <div id="option-form">

      <label id="createput">First Name:*</label>
      <input class="name" name="firstname" type="text" placeholder="Eduardo" maxlength="30">
    </div>

    <div id="option-form">

      <label id="createput">Last Name:*</label>
      <input class="name" name="lastname" type="text" placeholder="Toro Molinares" maxlength="30">
    </div>

    <div id="option-form">

      <label id="createput">Email:*</label>
      <input class="email" name="email" type="text" placeholder="edtorm@outlook.com" maxlength="40">
    </div>

    <div id="option-form">

      <label id="createput">Username:*</label>
      <input class="username" name="username" type="text" placeholder="edtorm" maxlength="10">
    </div>

    <div id="option-form">

      <label id="createput">Password:*</label>
      <input class="password" name="password" type="password" maxlength="20">
    </div>

    <div id="option-form">

      <label id="createput">Country:*</label>
      <input class="country" name="country" type="text" placeholder="Colombia" maxlength="50">
    </div>

    <div id="option-form">

      <label id="createput">City:*</label>
      <input class="city" name="city" type="text" placeholder="Barranquilla" maxlength="20">
    </div>

    <div id="option-form">

      <label id="createput">Telephone:*</label>
      <input class="telephone" name="telephone" type="text" placeholder="3017819030" maxlength="20">
    </div>

    <div id="option-form">

      <label id="createput">Role:*</label>
      <select class="genre" name="role">
        <option value="popcorner">Popcorner</option>
        <option value="developer">Developer</option>
        <option value="administrator">Administrator</option>
      </select>
    </div>

    <div id="option-form">

      <label id="createput">User Photo:*</label>
      <input type="file" class="userpicture" name="userpicture" accept="image/jpeg, image/png">
    </div>

    <div id="submit">

      {{ Form::submit('Create Client') }}
    </div>
  </div>
@stop
