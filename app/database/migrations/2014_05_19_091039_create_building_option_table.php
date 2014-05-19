<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuildingOptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('building_option', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('building_id')->unsigned();
			$table->foreign('building_id')->references('id')->on('buildings');
			$table->integer('option_id')->unsigned();
			$table->foreign('option_id')->references('id')->on('options');
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
		Schema::drop('building_option');
	}

}
