<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSearchsSavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('searchs_saves', function(Blueprint $table) {
			$table->increments('id');
			$table->text('data_json');
			$table->string('name');
			$table->tinyInteger('order');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('search_type_id')->unsigned();
			$table->foreign('search_type_id')->references('id')->on('searchs_types');
			
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
		Schema::drop('searchs_saves');
	}

}
