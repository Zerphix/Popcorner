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

  public function create()
  {
    // Obtenemos los campos y los limpiamos para guadarlos
    $first_name 		= ucwords(strtolower(e(Input::get('firstname'))));
    $last_name 	  	= ucwords(strtolower(e(Input::get('lastname'))));
    $email 		      = strtolower(e(Input::get('email')));
    $city 		      = ucwords(strtolower(e(Input::get('city'))));
    $city_zone 		  = ucwords(strtolower(e(Input::get('cityzone'))));
    $address 		    = strtolower(e(Input::get('address')));
    $telephone 		  = ucwords(strtolower(e(Input::get('telephone'))));
    $userpicture    = Input::file('userpicture');

    if($userpicture != '')
    {
      // Armamos un nuevo nombre para el archivo y lo guardamos como jpg
      $combination       = $first_name . $last_name . $telephone;
      $new_name	  			 = strtolower(str_replace(' ', '', $combination));
      $userpicture       = $new_name . '.jpg';
    }

    else
    {
      $userpicture = 'user.jpg';
    }

    // Creamos unas reglas basicas que deben cumplir
    $rules = array(
            'firstname'    		=> 'required|min:2|max:30',
            'lastname'    		=> 'required|min:2|max:30',
            'email'    		    => 'required|min:2|max:50|unique:clients',
            'city' 					  => 'required|min:2',
            'cityzone' 			  => 'required|min:2',
            'address' 				=> 'required|min:2',
            'telephone' 			=> 'required|min:2'
    );

    // Mensajes de errores
    $messages = array(
      'required' 	=> 'El campo :attribute es obligatorio.',
      'unique' 		=> 'El email ingresado ya existe en la base de datos',
      'min' 			=> 'El campo :attribute no puede tener menos de :min carácteres.',
      'max' 			=> 'El campo :attribute no puede tener más de :min carácteres.',
    );

    // Validamos que todo este bien
    $validation = Validator::make(Input::all(), $rules, $messages);

    // Si falla la validación
    if ($validation->fails())
    {
      // Devolvemos los mensajes de error
      return Redirect::to('create-client')->with('errors', 'You have errors in your form, please fill again.');
    }
    else
    {
      // Toma los datos en array y los guarda en la BD
      $query = DB::table('clients')->insert(array(
        'first_name' 		  => $first_name,
        'last_name' 			=> $last_name,
        'picture' 				=> $userpicture,
        'email'   				=> $email,
        'city'   				  => $city,
        'city_zone' 			=> $city_zone,
        'address' 	      => $address,
        'telephone' 			=> $telephone
      ));

      if($userpicture != 'user.jpg')
      {
        // Movemos el archivo original a la carpeta de los posters de las películas
        Input::file('userpicture')->move(public_path().'/profiles', $userpicture);
      }

      // Devolvemos con un mensaje de confirmación
      return Redirect::to('result')->with('mensaje','The client ' . $first_name . ' ' . $last_name . ' was successfully added to the system.');
    }
  }

  public function delete($user_email)
  {
    DB::select('DELETE FROM clients WHERE email = "' . $user_email . '"');

    // Devolvemos un mensaje de confirmación
    return Redirect::to('result')->with('mensaje','The client with the email ' . $user_email . ' has been successfully deleted from the system.');
  }

  public function edit($user_email)
  {
    $client = DB::select('SELECT * FROM clients WHERE email = "' . $user_email . '"');

    // Devolvemos un array con los datos de este cliente
    return View::make('edit-client', array('clients' => $client));
  }

  public function update()
  {
    // Obtenemos los campos y los limpiamos para guadarlos
    $first_name 		= ucwords(strtolower(e(Input::get('firstname'))));
    $last_name 	  	= ucwords(strtolower(e(Input::get('lastname'))));
    $email 		      = strtolower(e(Input::get('email')));
    $city 		      = ucwords(strtolower(e(Input::get('city'))));
    $city_zone 		  = ucwords(strtolower(e(Input::get('cityzone'))));
    $address 		    = strtolower(e(Input::get('address')));
    $telephone 		  = ucwords(strtolower(e(Input::get('telephone'))));

    // Creamos unas reglas basicas que deben cumplir
    $rules = array(
            'firstname'    		=> 'required|min:2|max:30',
            'lastname'    		=> 'required|min:2|max:30',
            'email'    		    => 'required|min:2|max:50',
            'city' 					  => 'required|min:2',
            'cityzone' 			  => 'required|min:2',
            'address' 				=> 'required|min:2',
            'telephone' 			=> 'required|min:2'
    );

    // Mensajes de errores
    $messages = array(
      'required' 	=> 'El campo :attribute es obligatorio.',
      'unique' 		=> 'El email ingresado ya existe en la base de datos',
      'min' 			=> 'El campo :attribute no puede tener menos de :min carácteres.',
      'max' 			=> 'El campo :attribute no puede tener más de :min carácteres.',
    );

    // Validamos que todo este bien
    $validation = Validator::make(Input::all(), $rules, $messages);

    // Si falla la validación
    if ($validation->fails())
    {
      // Devolvemos los mensajes de error
      return Redirect::to('edit-client')->with('errors', 'You have errors in your form, please fill again.');
    }

    else
    {
      DB::select('UPDATE clients SET
         first_name = "' . $first_name . '",
         last_name  = "' . $last_name . '",
         city       = "' . $city . '",
         city_zone  = "' . $city_zone . '",
         address    = "' . $address . '",
         telephone  = "' . $telephone . '"');

      // Devolvemos con un mensaje de confirmación
      return Redirect::to('result')->with('mensaje','The client ' . $first_name . ' ' . $last_name . ' was successfully updated into the system.');
    }
  }
}

?>
