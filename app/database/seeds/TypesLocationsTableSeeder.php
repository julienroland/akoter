<?php

class TypesLocationsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('types_locations')->truncate();

		$types_locations = array(
			array(
				'icon'=>'type_location/kot.png',
				
				),
			array(
				'icon'=>'type_location/studio.png',
				

				),
			array(
				'icon'=>'type_location/duplex.png',
				

				),
			array(
				'icon'=>'type_location/apartment.png',


				),
			array(
				'icon'=>'type_location/house.png',
				

				),
			array(
				'icon'=>'type_location/internat.png',


				),
			);

		// Uncomment the below to run the seeder
		DB::table('types_locations')->insert($types_locations);
	}

}
