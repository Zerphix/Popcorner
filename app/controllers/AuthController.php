<?php // app/controllers/AuthController.php
      // Default Login Controller

class AuthController extends BaseController
{
  // Metodo encargado de validar los usuarios del sistema
  public function userLogin()
  {
    // Obtenemos los datos enviados del login a través del metodo POST
    $username = Input::get('username');
    $password = Input::get('password');

    // Primera capa de seguridad, validamos que el user y passwd esten correctos
    if (Auth::attempt(['username' => $username, 'password' => $password]))
    {
      // Determinamos a que grupo pertenece el usuario para cargarle su UI
      $role = DB::table('users')->where('username', $username)->pluck('role');

      // 1er grupo - Usuarios Administradores
      if ($role == 'developer' || $role == 'administrator')
      {
        return Redirect::to('home');
      }

      // 2do grupo - Usuarios sin privilegios
      elseif ($role == 'seller')
      {
        return Redirect::to('secure');
      }
    }

    // Si no concuerdan los datos, devolvemos a los usuarios al login
    else
    {
      return Redirect::to('/');
		}
	}

  // Metodo encargado de cerrar la sesión a los usuarios
  public function userLogout()
  {
    Auth::logout();
    return Redirect::to('/');
  }
}

?>
