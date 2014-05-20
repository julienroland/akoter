<?php

use Carbon\Carbon;

class TypesOptionsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('notices')->truncate();
		// 8 options on building description
		$types_options = array(
			array(
				'name'=>'building',
				),
			array(
				'name'=>'infos',
				),
			array(
				'name'=>'advert',
				)
			);
		

		// Uncomment the below to run the seeder
		DB::table('types_options')->insert($types_options);
	}

}
