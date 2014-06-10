<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('first_name');
			$table->string('email')->unique();
			$table->string('email_bc');
			$table->string('password');
			$table->string('remember_token');
			$table->boolean('civility');
			$table->string('street');
			$table->string('photo');
			$table->string('slug');
			$table->string('key');
			$table->string('address');
			$table->boolean('validate');
			$table->boolean('email_comfirm');
			$table->boolean('active');
			$table->boolean('isOwner');
			$table->boolean('isTenant');
			$table->boolean('delete');
			$table->boolean('suspend');
			$table->boolean('pro');
			$table->date('born');
			$table->string('postal');
			$table->string('phone');
			$table->string('web');
			$table->timestamp('connected_at');
			$table->integer('language_id')->unsigned();
			$table->foreign('language_id')->references('id')->on('languages');
			$table->integer('subscription_id')->unsigned();
			$table->foreign('subscription_id')->references('id')->on('subscriptions');
			$table->integer('region_id')->unsigned()->nullable();
			$table->foreign('region_id')->references('id')->on('regions');
			$table->integer('locality_id')->unsigned()->nullable();
			$table->foreign('locality_id')->references('id')->on('localities');
			$table->integer('role_id')->unsigned();
			$table->foreign('role_id')->references('id')->on('roles');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
