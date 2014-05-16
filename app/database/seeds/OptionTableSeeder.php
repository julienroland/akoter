<?php

use Carbon\Carbon;

class OptionsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('notices')->truncate();
		// 8 options on building description
		$options = array(
		);
		for($i = 1; $i <=8; $i++){
			array_push($options,array('id'=>$i));
		}
		

		// Uncomment the below to run the seeder
		DB::table('options')->insert($options);
	}

}
