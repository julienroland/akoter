<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
			$table->increments('id');
			$table->string('subject');
			$table->text('content');
			$table->integer('receiver_id')->unsigned();
			$table->foreign('receiver_id')->references('id')->on('users');
			$table->integer('sender_id')->unsigned()->nullable();
			$table->foreign('sender_id')->references('id')->on('users');
			$table->integer('response_message_id')->unsigned()->nullable();
			$table->foreign('response_message_id')->references('id')->on('messages');
			
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
		Schema::drop('messages');
	}

}
