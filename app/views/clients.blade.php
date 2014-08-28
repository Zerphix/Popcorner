@extends('layout')

{{-- Definimos la etiqueta <title> en el HML5 --}}
@section ('title')

  Popcorner - Client List
@stop

{{-- Agregamos un css propio para organizar las opciones del video --}}
@section ('css')

  {{ HTML::style('css/clients.css') }}
@stop

@section('content')

  <div id="client_list">

    @foreach($clients as $client)
    <div id="client">

      <div id="client_box_left">

          <img src="../profiles/{{ $client->picture }}" alt="" id="userpicture" />
      </div>

      <div id="client_box_right">

        <div id="username">
          <a id="username">{{ $client->first_name . ' ' . $client->last_name }}</a>
        </div>

        <div id="useremail">
          <a id="useremail">{{ $client->email }}</a>
        </div>

        <div id="usertelephone">
          <a id="usertelephone">{{ $client->telephone }}</a>
        </div>

        <div id="usercity">
          <a id="usercity">{{ $client->city . ' - ' . $client->city_zone}}</a>
        </div>

        <div id="useraddress">
          <a id="usercity">{{ $client->address }}</a>
        </div>

        <div id="usertasks">
          <a id="usertask" href="#">Edit</a>
          <a id="usertask" href="#">Delete</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@stop
