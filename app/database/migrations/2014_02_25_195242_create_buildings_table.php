<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('buildings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('address');
			$table->tinyInteger('number');
			$table->string('latlng');
			$table->integer('postal');
			$table->boolean('status_type');
			$table->integer('register_step');
			$table->integer('locality_id')->unsigned();
			$table->foreign('locality_id')->references('id')->on('localities');
			$table->integer('region_id')->unsigned();
			$table->foreign('region_id')->references('id')->on('regions');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('postal_id')->unsigned();
			$table->foreign('postal_id')->references('id')->on('postal');
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
		Schema::drop('buildings');
	}

}
