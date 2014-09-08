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

	// Muestra el formulario para creat una nueva película
	public function create()
	{
		// Obtenemos los campos y los limpiamos para guadarlos
		$movie_name 		= ucwords(strtolower(e(Input::get('name'))));
		$movie_trailer 	= e(Input::get('trailer'));

		// Tomamos el trailer y extraemos el codigo
		$patterm 			 = explode('/',$movie_trailer);
		$movie_trailer = end($patterm);

		$movie_genre		= e(Input::get('genre'));
		$classification	= e(Input::get('classification'));

		// Arreglo especial para la fecha de estreno
		$day	 = e(Input::get('day'));
		$month = e(Input::get('month'));
		$year	 = e(Input::get('year'));

		$release_date = $year . '-' . $month . '-' . $day;

		// Sinopsis de la película
		$synopsis	= e(Input::get('synopsis'));

		// Armamos un nuevo nombre para el archivo y lo guardamos como jpg
		$new_name	  			 = strtolower(str_replace(' ', '', $movie_name));
		$final_name_poster = $new_name . '.jpg';

		// Creamos unas reglas basicas que deben cumplir
		$rules = array(
            'name'    			 	=> 'required|min:2|max:50|unique:movies',
            'trailer' 				=> 'required|min:5|max:50',
						'genre' 					=> 'required',
						'classification'	=> 'required',
						'day'							=> 'required',
						'month'						=> 'required',
						'year'						=> 'required',
						'synopsis'				=> 'required|min:10',
						'poster'  				=> 'required'
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
			return Redirect::to('create-movie')->with('errors', 'You have errors in your form, please fill again.');
		}

		else
		{
			// Toma los datos en array y los guarda en la BD
			$query = DB::table('movies')->insert(array(
				'released_at' 		=> $release_date,
				'name' 						=> $movie_name,
				'poster' 					=> $final_name_poster,
				'price'   				=> '10',
				'genre'   				=> $movie_genre,
				'synopsis' 				=> $synopsis,
				'classification' 	=> $classification,
				'trailer' 				=> $movie_trailer
			));

			// Movemos el archivo original a la carpeta de los posters de las películas
			Input::file('poster')->move(public_path().'/poster', $final_name_poster);

			// Devolvemos con un mensaje de confirmación
			return Redirect::to('result')->with('mensaje','The film ' . $movie_name . ' was successfully added to the system.');
		}
	}

	// Obtenemos los datos de la Película para enviarlos al formulario de edición
	public function edit($id)
	{
		$movie = DB::select('SELECT * FROM movies WHERE movie_id = "' . $id . '"');

		// Devolvemos un array con los datos de la película
		return View::make('edit-forms/edit-movie', array('movies' => $movie));
	}

	// Guardamos los datos nuevos de la película
	public function saveEdit($id)
	{
		// Obtenemos los campos del form
		$movie_name 		= ucwords(strtolower(e(Input::get('name'))));
		$movie_trailer 	= e(Input::get('trailer'));
		$movie_genre 		= e(Input::get('genre'));
		$classification	= e(Input::get('classification'));
		$synopsis				= e(Input::get('synopsis'));

		// Creamos unas reglas basicas que deben cumplir
		$rules = array(
						'name'    			 	=> 'required|min:2|max:50',
						'trailer' 				=> 'required|min:5|max:50',
						'genre' 					=> 'required',
						'classification'	=> 'required',
						'synopsis'				=> 'required|min:10'
		);

		// Definimos los mensajes de errores
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
			return Redirect::to('edit-movie/' . $id)->with('errors', 'You have errors in your form, please fill again.');
		}

		else
		{
			// Actualizamos los campos
			DB::table('movies')
            ->where('movie_id', $id)
            ->update(array('name' 					=> $movie_name,
													 'trailer' 				=> $movie_trailer,
													 'genre'   				=> $movie_genre,
													 'classification' => $classification,
													 'synopsis' 			=> $synopsis));

			// Devolvemos con un mensaje de confirmación
			return Redirect::to('result')->with('mensaje','The film ' . $movie_name . ' was successfully edited in the system.');
		}
	}

	public function delete($movie_id)
	{
		// Buscamos el nombre del poster de la película
		$poster = DB::table('movies')->where('movie_id', $movie_id)->pluck('poster');

		// Buscamos el nombre de la película para mostrarlo en el mensaje de confirmación
		$name = DB::table('movies')->where('movie_id', $movie_id)->pluck('name');

		// Comprobamos si el archivo existe (deberia) y de ser asi lo borra
		if (File::exists(public_path() . '/poster/' . $poster))
		{
				File::delete(public_path() . '/poster/' . $poster);
		}

		// Lo borramos de la base de datos
		DB::select('DELETE FROM movies WHERE movie_id = "' . $movie_id . '"');

		// Devolvemos un mensaje de confirmación
		return Redirect::to('result')->with('mensaje','The movie ' . $name . ' has been successfully deleted from the system.');
	}
}
