<?php

class TypesPostsTableSeeder extends Seeder {

	public function run()
	{
		$types_posts = array(
			array(
				'name'=>'article',
				),
			array(
				'name'=>'administrative',
				),
			array(
				'name'=>'owner',
				),
			array(
				'name'=>'tenant',
				)
			);
		

		// Uncomment the below to run the seeder
		DB::table('posts_types')->insert($types_posts);
	}

}