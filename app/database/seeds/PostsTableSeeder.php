<?php

class PostsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('posts')->truncate();
		$img =  array(
			'contribute.jpg',
			'whyAkoter.jpg',
			'akoterValue.jpg',
			);
	
		$posts = array(
			);
		
		for($i=0; $i < 3; $i++ ){
			array_push($posts, array(
				'content_type'=>'home',
				'content_position'=>'mod5',
				'img'=>$img[$i],
				'width'=>300,
				'height'=>200,
				'post_type_id'=>1,
				'publish'=>1,
				'user_id'=>1,
				));
		}

		// Uncomment the below to run the seeder
		DB::table('posts')->insert($posts);
	}

}
