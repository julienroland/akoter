<?php

class ParticularitiesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('particularity')->truncate();
		$particularities = array(
			array(
			'icon'=>'icon-wifi42',
			),
			array(
			'icon'=>'icon-bath1',
			),

			array(
			'icon'=>'icon-tap1',
			),

			array(
			'icon'=>'icon-eating',
			),
			);

		

		// Uncomment the below to run the seeder
		 DB::table('particularities')->insert($particularities);
	}

}
