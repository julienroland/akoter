<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJournalsCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('journals_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('journal_id')->unsigned();
			$table->foreign('journal_id')->references('id')->on('journals');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->timestamp('date');
			$table->integer('agree');
			$table->integer('disagree');
			$table->text('text');
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
		Schema::drop('journals_comments');
	}

}
