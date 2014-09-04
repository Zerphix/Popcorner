<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

			// Creamos los campos"created_at" y "updated_at"
			$table->timestamps();

			$table->string('first_name', 30);
			$table->string('last_name', 30);
			$table->string('username', 10);
      $table->string('password', 64);
			$table->string('country', 50);
			$table->string('city', 20);
			$table->string('telephone', 20);
			$table->string('email', 100);
			$table->string('picture', 18);
      $table->string('role', 15);

			// required for Laravel 4.1.26
      $table->string('remember_token', 100)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
