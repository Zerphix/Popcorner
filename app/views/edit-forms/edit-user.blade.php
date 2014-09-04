@extends('layout')

{{-- Definimos la etiqueta <title> en el HML5 --}}
@section ('title')

  Popcorner -
@stop

{{-- Agregamos un css propio para organizar las opciones del video --}}
@section ('css')

  {{ HTML::style('css/movies.css') }}
  {{ HTML::style('css/clients.css') }}
@stop

{{-- Cuerpo de la sección "movie" --}}
@section('content')

  <div id="movie_list">

    {{-- Si el formulario contiene errores --}}
    @if(Session::has('errors'))

      <h1 id="error_message">{{ Session::get('errors') }}</h1>
    @endif

    {{ Form::open(array('url' => 'edit-user')) }}
    @foreach($users as $user)
    <div id="option-form">

      <label id="createput">First Name:*</label>
      <input value = "{{ $user->first_name }}" class="name" name="firstname" type="text" placeholder="Eduardo" maxlength="30">
    </div>

    <div id="option-form">

      <label id="createput">Last Name:*</label>
      <input value = "{{ $user->last_name }}" class="name" name="lastname" type="text" placeholder="Toro Molinares" maxlength="30">
    </div>

    <div id="option-form">

      <label id="createput">Email:*</label>
      <input value = "{{ $user->email }}" class="email" name="email" type="text" placeholder="edtorm@outlook.com" maxlength="45">
    </div>

    <div id="option-form">

      <label id="createput">Country:*</label>
      <input value = "{{ $user->country }}" class="city" name="country" type="text" placeholder="Barranquilla" maxlength="12">
    </div>

    <div id="option-form">

      <label id="createput">City:*</label>
      <input value = "{{ $user->city }}" class="cityzone" name="city" type="text" placeholder="Down Town" maxlength="12">
    </div>

    <div id="option-form">

      <label id="createput">Telephone:*</label>
      <input value = "{{ $user->telephone }}" class="telephone" name="telephone" type="text" placeholder="3017819030" maxlength="10">
    </div>

    <div id="option-form">

      <label id="createput">Role:*</label>
      <input value = "{{ $user->role }}" class="address" name="address" type="text" placeholder="Carrera 66B No 49 – 83" maxlength="45">
    </div>
    @endforeach

    <div id="submit">

      {{ Form::submit('Update Client') }}
    </div>
  </div>
@stop
