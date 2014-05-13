<?php

class LocalitiesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('localities')->truncate();
		$data = file_get_contents("./app/database/seeds/data/cities/cities.json");
		$oData = json_decode($data);
		$localities = array();
		foreach($oData as $data){
			array_push($localities,get_object_vars($data));
		}
		
		
		// Uncomment the below to run the seeder
		DB::table('localities')->insert($localities);
	}

}
