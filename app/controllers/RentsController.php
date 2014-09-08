<?php

class RentsController extends \BaseController
{
  public function rentMovie ($user_id, $movie_id)
  {
    // Numero de la factura
    $date_time  = date("dmyhis");

    $uid   = substr($user_id, 0, 1);
    $mid   = substr($movie_id, 0, 1);

    $invoice = $date_time . '-' . $uid . $mid;

    // Guardamos los datos de la renta de la película
    DB::table('rents')->insert(array(
              'invoice_num' 		=> $invoice,
              'movies_movie_id' => $movie_id,
              'users_id' 				=> $user_id ));

    return Redirect::to('result')->with('mensaje','Thank you for rent this film');
  }
}
