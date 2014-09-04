<?php

class UserTableSeeder extends Seeder
{
	public function run()
	{
		$users =
		[
			['first_name' => 'Eduardo',
			 'last_name' 	=> 'Toro',
			 'username' 	=> 'edtorm',
			 'password' 	=> Hash::make('edtorm1'),
			 'country' 		=> 'Colombia',
			 'city' 			=> 'Barranquilla',
			 'telephone' 	=> '7777777',
			 'email' 			=> 'edtorm@outlook.com',
			 'picture' 		=> 'eduardo.jpg',
			 'role' 			=> 'administrator'],

			['first_name' => 'Jordan',
			'last_name' 	=> 'Belfort',
			'username' 		=> 'jordan',
			'password' 		=> Hash::make('wolfy'),
			'country' 		=> 'United States',
			'city' 				=> 'New York',
			'telephone' 	=> '3012876323',
			'email' 			=> 'j.belfort@so.com',
			'picture' 		=> 'jordan.jpg',
			'role' 			  => 'popcorner'],

			['first_name' => 'Marissa',
			'last_name' 	=> 'Mayer',
			'username' 		=> 'marissa',
			'password' 		=> Hash::make('marissa'),
			'country' 		=> 'United States',
			'city' 				=> 'Santa Clara',
			'telephone' 	=> '3012274923',
			'email' 			=> 'm.mayer@yahoo.com',
			'picture' 		=> 'marissa.jpg',
			'role' 			  => 'popcorner'],

			['first_name' => 'Mark',
			'last_name' 	=> 'Zuckerberg',
			'username' 		=> 'mark',
			'password' 		=> Hash::make('mark'),
			'country' 		=> 'United States',
			'city' 				=> 'Cambridge',
			'telephone' 	=> '3012977923',
			'email' 			=> 'markz@facebook.com',
			'picture' 		=> 'mark.jpg',
			'role' 			  => 'popcorner'],

			['first_name' => 'Tony',
			'last_name' 	=> 'Stark',
			'username' 		=> 'tony',
			'password' 		=> Hash::make('tony'),
			'country' 		=> 'United States',
			'city' 				=> 'New York',
			'telephone' 	=> '3012997229',
			'email' 			=> 't.stark@si.com',
			'picture' 		=> 'tony.jpg',
			'role' 			  => 'popcorner']
    ];

    DB::table('users')->insert($users);
	}
}

?>
