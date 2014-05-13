<?php

class RegionsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('regions')->truncate();
		
		$regions = array();

		for($i=1;$i<=13;$i++){

			array_push($regions,array('id'=>$i));

		}
		

		// Uncomment the below to run the seeder
		DB::table('regions')->insert($regions);
	}

}
