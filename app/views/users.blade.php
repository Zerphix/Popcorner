@extends('layout')

{{-- Definimos la etiqueta <title> en el HML5 --}}
@section ('title')

  Popcorner - User List
@stop

{{-- Agregamos un css propio para organizar las opciones del video --}}
@section ('css')

  {{ HTML::style('css/users.css') }}
@stop

@section('content')

  <div id="client_list">

    @foreach($users as $user)
    <div id="client">

      <div id="client_box_left">

          <img src="../profiles/{{ $user->picture }}" alt="" id="userpicture" />
      </div>

      <div id="client_box_right">

        <div id="username">
          <a id="username">{{ $user->first_name . ' ' . $user->last_name }}</a>
        </div>

        <div id="useremail">
          <a id="useremail">{{ $user->email }}</a>
        </div>

        <div id="usertelephone">
          <a id="usertelephone">{{ $user->telephone }}</a>
        </div>

        <div id="usercity">
          <a id="usercity">{{ $user->country . ' - ' . $user->city }}</a>
        </div>

        <div id="useraddress">
          <a id="usercity">{{ $user->role }}</a>
        </div>

        <div id="usertasks">
          <a id="usertask" href="../edit-user/{{ $user->email }}">Edit</a>
          <a id="usertask" href="../delete-user/{{ $user->email }}">Delete</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@stop
