<?php

class AdvertsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('adverts')->truncate();
		$date = new DateTime();
		$adverts = array(	
			);
		for($i=1;$i < 23; $i++){
			array_push($adverts, array(
				"validate"=>rand(0,1),
				"comments_status"=>rand(0,1),
				"nb_views"=>rand(0,10000),
				"rating"=>rand(0,10),
				"caution"=>rand(0,1000),
				"created_at"=>$date->getTimestamp(),
				));
		}

		// Uncomment the below to run the seeder
		DB::table('adverts')->insert($adverts);
	}

}
