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

// Rutas con acceso restingido
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
	Route::get('create-movie', function() { return View::make('create-movie'); });

	// Recibe por POST los datos del form para agregarlos a la BD
	Route::post('create-movie', array('uses' => 'MoviesController@create'));

	// Vista para editar las películas
	Route::get('edit-movie/{movie_id}', array('uses' => 'MoviesController@edit'));

	// Mensajes de resultado de los registros
	Route::get('result', function() { return View::make('result'); });

	// Vista de todos los clientes registrados en el sistema
	Route::get('clients', array('uses' => 'ClientsController@allClients'));

	// Ruta para la creación de nuev@s clientes, va por GET y muestra el form
	Route::get('create-client', function() { return View::make('create-client'); });

	// Recibe por POST los datos del form para agregarlos a la BD
	Route::post('create-client', array('uses' => 'ClientsController@create'));

	// Delete Clients
	Route::get('delete-client/{email}', array('uses' => 'ClientsController@delete'));

	// Delete Clients
	Route::get('edit-client/{email}', array('uses' => 'ClientsController@edit'));

	// Recibe por POST los datos para editar
	Route::post('edit-client', array('uses' => 'ClientsController@update'));
});
