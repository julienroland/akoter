<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSchoolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schools', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('short',10);
			$table->string('street');
			$table->string('web');
			$table->string('latlng');
			$table->integer('status_type');
			$table->integer('postal_id')->unsigned();
			$table->foreign('postal_id')->references('id')->on('postal');
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('region_id')->unsigned();
			$table->foreign('region_id')->references('id')->on('regions');
			$table->integer('locality_id')->unsigned();
			$table->foreign('locality_id')->references('id')->on('localities');
			
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
		Schema::drop('schools');
	}

}
