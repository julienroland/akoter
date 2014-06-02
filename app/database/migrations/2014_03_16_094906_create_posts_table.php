<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('content_type');
			$table->string('content_position');
			$table->string('img')->nullable();
			$table->integer('width')->nullable();
			$table->integer('height')->nullable();
			$table->boolean('publish');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->integer('post_type_id')->unsigned();
			$table->foreign('post_type_id')->references('id')->on('posts_types');
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
		Schema::drop('posts');
	}

}
