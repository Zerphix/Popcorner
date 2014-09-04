<?php

class UsersController extends \BaseController
{
  // Metodo para mostrar todos los clientes
  public function showUsers()
  {
    // Los ordenamos por orden alfabético
    $user = User::orderBy('first_name', 'ASC')->get();

    // Enviamos un array "movies" con los datos
    return View::make('users', array('users' => $user));
  }

  public function createUser()
  {
    // Obtenemos los campos y los limpiamos para guadarlos
    $first_name 		= ucwords(strtolower(e(Input::get('firstname'))));
    $last_name 	  	= ucwords(strtolower(e(Input::get('lastname'))));
    $email 		      = strtolower(e(Input::get('email')));
    $username 		  = e(Input::get('username'));
    $password 		  = Hash::make(Input::get('password'));
    $country        = ucwords(strtolower(e(Input::get('country'))));
    $city           = ucwords(strtolower(e(Input::get('city'))));
    $telephone 		  = str_ireplace(' ', '', Input::get('telephone'));
    $role      		  = e(Input::get('role'));
    $userpicture    = Input::file('userpicture');

    // Verificamos si el usuario agrego una foto
    if($userpicture != '')
    {
      // Armamos un nuevo nombre para el archivo y lo guardamos como jpg
      $combination       = $first_name[0] . $last_name[0] . $telephone[0] . '-' . date("Y-m-d",time());
      $new_name	  			 = strtolower($combination);
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
            'email'    		    => 'required|min:2|max:50|unique:users',
            'username'    		=> 'required|min:2|max:30|unique:users',
            'password'    		=> 'required',
            'country'      		=> 'required|min:4|max:50',
            'city' 					  => 'required|min:2|max:20',
            'telephone' 			=> 'required|min:2|max:20'
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
      return Redirect::to('create-user')->with('errors', 'You have errors in your form, please fill again.');
    }
    else
    {
      // Toma los datos en array y los guarda en la BD
      $query = DB::table('users')->insert(array(
        'first_name' 		  => $first_name,
        'last_name' 			=> $last_name,
        'email'   				=> $email,
        'username'   			=> $username,
        'password'   			=> $password,
        'country'   			=> $country,
        'city'   				  => $city,
        'telephone' 			=> $telephone,
        'role' 		       	=> $role,
        'picture' 				=> $userpicture

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


  public function deleteUser($user_email)
  {
    // Buscamos el la imagen del usuario para eliminarla primero
    $user_picture = DB::table('users')->where('email', $user_email)->pluck('picture');

    // Comprobamos que el archivo si existe (deberia) y de ser asi lo borra
    if (File::exists(public_path() . '/profiles/' . $user_picture))
    {
        File::delete(public_path() . '/profiles/' . $user_picture);
    }

    // Lo borramos de la base de datos
    DB::select('DELETE FROM users WHERE email = "' . $user_email . '"');

    // Devolvemos un mensaje de confirmación
    return Redirect::to('result')->with('mensaje','The user with the email ' . $user_email . ' has been successfully deleted from the system.');
  }

  public function editUser($id)
  {
    // Query (MODIFICARLO POR LA FORMA DE LARAVEL)
    $user = DB::select('SELECT * FROM users WHERE id = "' . $id . '"');

    // Devolvemos un array con los datos de este cliente
    return View::make('edit-forms/edit-user', array('users' => $user));
  }

  public function update()
  {
    // Obtenemos los campos y los limpiamos para guadarlos
    $first_name 		= ucwords(strtolower(e(Input::get('firstname'))));
    $last_name 	  	= ucwords(strtolower(e(Input::get('lastname'))));
    $email 		      = strtolower(e(Input::get('email')));
    $country 		    = ucwords(strtolower(e(Input::get('country'))));
    $city 		      = ucwords(strtolower(e(Input::get('city'))));
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
