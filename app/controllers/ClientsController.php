<?php

class ClientsController extends \BaseController
{
  // Metodo para mostrar todos los clientes
  public function allClients()
  {
    // Los ordenamos por orden alfabético
    $client = Client::orderBy('first_name', 'ASC')->get();

    // Enviamos un array "movies" con los datos
    return View::make('clients', array('clients' => $client));
  }
}

?>
