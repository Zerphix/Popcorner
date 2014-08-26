<?php

class MoviesController extends \BaseController
{
	// Metodo para obtener las secciones de video de la vista home
	public function homeMovies()
	{
		// Query para obtener las películas más populares en Popcorner
		$populars = DB::table('movies')->take(3)->orderBy('rents', 'desc')->get();

		// Query para obtener las películas que se van a estrenar proxímamente
	  $comings = DB::select('SELECT * FROM movies WHERE released_at > CURDATE() ORDER BY released_at ASC LIMIT 2');

		// Query para obtener las ultimas películas que se han estrenado en Popcorner
		$ultimos = DB::select('SELECT * FROM movies WHERE released_at <= CURDATE() ORDER BY released_at DESC LIMIT 6');

	  // Creamos un Array con las 3 consultas para posteriormente mostrarlos al usuario
		$array = array('popular' => $populars, 'coming' => $comings, 'ultimos' => $ultimos);

		// Una vez tengamos los datos necesarios volvemos a la vista Home
		return View::make('home', $array);
	}

	// Metodo para obtener la información completa de las películas
	public function infoMovie($movie_name)
	{
		// Recibe el parametro $movie_name, reemplaza los - y convierte todo en min
		$movie_name = ucwords(str_replace('-', ' ', $movie_name));
		$movie 			= DB::select('SELECT * FROM movies WHERE name = "' . $movie_name . '"');

		// obtenemos la información de la película, lo guardamos en un array (info)
	  return View::make('movie', array('info' => $movie));
	}

	// Metodo para obtener todo el catalogo de películas en el sistema
	public function allMovies()
	{
		// Los ordenamos por orden alfabético
		$movie = Movie::orderBy('name', 'ASC')->get();

		// Enviamos un array "movies" con los datos
		return View::make('movies', array('movies' => $movie));
	}

	// Obtenemos las películas más populares
	public function popularMovies()
	{
		$movie = Movie::orderBy('rents', 'DESC')->get();

		return View::make('movies', array('movies' => $movie));
	}

	// Obtenemos las ultimas películas estrenadas
	public function latestMovies()
	{
		$movie = DB::select('SELECT * FROM movies WHERE released_at <= CURDATE() ORDER BY released_at DESC');

		return View::make('movies', array('movies' => $movie));
	}

	// Obtenemos las proxímas películas por estrenar
	public function comingMovies()
	{
		$movie = DB::select('SELECT * FROM movies WHERE released_at > CURDATE() ORDER BY released_at DESC');

		return View::make('movies', array('movies' => $movie));
	}

	// Buscamos películas de acuerdo a los criterios de búsqueda. Utilizamos metodo POST
	public function searchMovies()
	{
		$movie_name = Input::get('search');
		$movie_name = strip_tags($movie_name); // Quitamos los caracteres HTML
		$movie_name = strtolower($movie_name); // Convertimos todo a min

		// Query a la base de datos con la palabra clave
		$movie = DB::select('SELECT * FROM movies WHERE name LIKE "%' . $movie_name . '%"');

	  return View::make('movies', array('movies' => $movie));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('movies');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
