<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table) {
			$table->increments('id');
			$table->float('price');
			$table->float('size');
			$table->tinyInteger('nb_room');
			$table->tinyInteger('remaining_room');
			$table->boolean('available');
			$table->date('start_date');
			$table->date('end_date')->nullable();
			$table->float('charge_price');
			$table->boolean('validate');
			$table->boolean('comments_status');
			$table->integer('nb_views');
			$table->float('rating');
			$table->integer('nb_rate');
			$table->float('caution');	
			$table->boolean('charge_type');
			$table->integer('type_location_id')->unsigned();
			$table->foreign('type_location_id')->references('id')->on('types_locations');
			$table->integer('building_id')->unsigned();
			$table->foreign('building_id')->references('id')->on('buildings');



			
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
		Schema::drop('locations');
	}

}
