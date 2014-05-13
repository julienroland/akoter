<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_groups_permissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->boolean('journal');
			$table->boolean('journal_commentaire');
			$table->boolean('friends');
			$table->boolean('agree');
			$table->boolean('disagree');
			$table->boolean('personnal_data');
			$table->boolean('location');
			$table->boolean('location_history');
			$table->boolean('properties');
			$table->boolean('share');
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
		Schema::drop('user_group');
	}

}
