<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildingsPhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('buildings_photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('url');
			$table->string('alt');
			$table->string('legend');
			$table->string('type');
			$table->integer('building_id')->unsigned();
			$table->foreign('building_id')->references('id')->on('buildings');
			$table->integer('order');
			$table->integer('view');
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
		Schema::drop('buildings_photos');
	}

}
