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
			 'password' 	=> Hash::make('Edtorm1'),
			 'email' 			=> 'edtorm@outlook.com',
			 'picture' 		=> 'eduardo.jpg',
			 'role' 			=> 'developer'],

			['first_name' => 'Branko',
			'last_name' 	=> 'F.',
			'username' 		=> 'branko',
			'password' 		=> Hash::make('branko'),
			'email' 			=> 'branko@bilateral.com',
			'picture' 		=> 'user.jpg',
			'role' 				=> 'administrator'],

			['first_name' => 'Jordan',
			'last_name' 	=> 'Belfort',
			'username' 		=> 'jordan',
			'password' 		=> Hash::make('wolfy'),
			'email' 			=> 'j.belfort@st.com',
			'picture' 		=> 'jordan.jpg',
			'role' 				=> 'seller']
    ];

    DB::table('users')->insert($users);
	}
}

?>
