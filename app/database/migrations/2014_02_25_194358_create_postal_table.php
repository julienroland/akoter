<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostalTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postal', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('start');
			$table->integer('end');
			$table->integer('region_id')->unsigned();
			$table->foreign('region_id')->references('id')->on('regions');
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
		Schema::drop('postal');
	}

}
