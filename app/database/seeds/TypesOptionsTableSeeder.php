<?php

use Carbon\Carbon;

class TypesOptionsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('notices')->truncate();
		// 8 options on building description
		$types_options = array(
		);
		for($i = 1; $i <=8; $i++){
			array_push($types_options,array(
				'name'=>'building',
				));
		}
		

		// Uncomment the below to run the seeder
		DB::table('types_options')->insert($types_options);
	}

}
