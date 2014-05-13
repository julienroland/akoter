<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAgenceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('agences', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('logo');
			$table->string('slug');
			$table->boolean('validate');
			$table->boolean('visible');
			$table->date('created');
			$table->integer('nb_employes');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('address');
			$table->integer('region_id')->unsigned();
			$table->foreign('region_id')->references('id')->on('regions');
			$table->integer('locality_id')->unsigned();
			$table->foreign('locality_id')->references('id')->on('localities');
			$table->integer('postal');
			$table->string('login');
			$table->string('password');
			$table->integer('language_id')->unsigned();
			$table->foreign('language_id')->references('id')->on('languages');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('agences');
	}

}
