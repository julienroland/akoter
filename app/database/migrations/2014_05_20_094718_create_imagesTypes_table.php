<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('width')->nullable();
			$table->integer('height')->nullable();
			$table->string('extension',50);
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
		Schema::drop('imagesTypes');
	}

}
