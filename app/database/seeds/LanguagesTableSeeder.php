<?php

class LanguagesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('languages')->truncate();

		$languages = array(
			array(
				'name'=>'Français',
				'short'=>'fr'
				),
			array(
				'name'=>'English',
				'short'=>'en'
				),
			array(
				'name'=>'Néederlands',
				'short'=>'nl'
				),
			);

		// Uncomment the below to run the seeder
		 DB::table('languages')->insert($languages);
	}

}
