<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Ruta principal, aquí comienza la aplicación con la vista del login
Route::get('/', function() { return View::make('popcorner'); });

// El login a su vez llama al metodo AuthController para validar los usuarios
Route::post('/', array('uses'=> 'AuthController@userLogin'));

// Vista para cerrar sessión
Route::get('logout', array('uses' => 'AuthController@userLogout'));

// Rutas con acceso restringido
Route::group(array('before' => 'auth'), function()
{
	// Vista de prueba
	Route::get('secure', function() { return View::make('secure'); });

	// Vista home una vez el usuario esta logueado
	Route::get('home', array('uses' => 'MoviesController@homeMovies'));

	// Vista para obtener el catalogo completo de películas en el sistema
	Route::get('movies', array('uses' => 'MoviesController@allMovies'));

	// Obtenemos el catalogo completo de películas más populares
	Route::get('movies/popular', array('uses' => 'MoviesController@popularMovies'));

	// Obtenemos el catalogo completo de películas que vienen a estrenarse
	Route::get('movies/coming', array('uses' => 'MoviesController@comingMovies'));

	// Ruta para las busquedas rapidas de peliculas en la barra superior
	Route::post('movies', array('uses' => 'MoviesController@searchMovies'));

	// Obtenemos el catalogo completo de películas más recientes
	Route::get('movies/lastest', array('uses' => 'MoviesController@latestMovies'));

	// Vista para mostrar toda la información de la película con el metodo infoMovies.
	// Pasamos la variable movie_name por get y con ella obtenemos el resto de información
	Route::get('movie/{movie_name}', array('uses' => 'MoviesController@infoMovie'));

	// Ruta para la creación de nuevas películas, va por GET y muestra el form
	Route::get('create-movie', function() { return View::make('create-forms/create-movie'); });

	// Recibe por POST los datos del form para agregarlos a la BD
	Route::post('create-movie', array('uses' => 'MoviesController@create'));

	// Vista para editar las películas
	Route::get('edit-movie/{movie_id}', array('uses' => 'MoviesController@edit'));

	// Ruta para  guardar la edición de la película
	Route::post('edit-movie/{movie_id}', array('uses' => 'MoviesController@saveEdit'));

	// Ruta para eliminar películas
	Route::get('delete-movie/{movie_id}', array('uses' => 'MoviesController@delete'));

	// Mensajes de resultado de los registros
	Route::get('result', function() { return View::make('result'); });

	/***************
	 * User Routes *
	 ***************/

	// Vista de todos los usuarios registrados en el sistema
	Route::get('users', array('uses' => 'UsersController@showUsers'));

	// Ruta para la creación de nuevos usuarios, petición por GET
	Route::get('create-user', function() { return View::make('create-forms/create-user'); });

	// Ruta para enviar los datos por POST al controlador encargado de crear al usuario
	Route::post('create-user', array('uses' => 'UsersController@createUser'));

	// Edit Users
	Route::get('edit-user/{email}', array('uses' => 'UsersController@editUser'));

	// Delete User
	Route::get('delete-user/{email}', array('uses' => 'UsersController@deleteUser'));
});
