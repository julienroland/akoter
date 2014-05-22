<?php

use Carbon\Carbon;

class OptionTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('notices')->truncate();
		// 8 options on building description

		$options = array(

			array(
				'key'=>'common_room',
				'default'=>'bathroom',
				'type_option_id'=>1
				),
			array(
				'key'=>'common_room',
				'default'=>'kitchen',
				'type_option_id'=>1
				),
			array(
				'key'=>'common_room',
				'default'=>'salon',
				'type_option_id'=>1
				),
			array(
				'key'=>'outdoor',
				'default'=>'garden',
				'type_option_id'=>1
				),
			array(
				'key'=>'outdoor',
				'default'=>'terrace',
				'type_option_id'=>1
				),
			array(
				'key'=>'outdoor',
				'default'=>'balcony',
				'type_option_id'=>1
				),
			array(
				'key'=>'parking',
				'default'=>'private',
				'type_option_id'=>1
				),
			array(
				'key'=>'parking',
				'default'=>'near-public',
				'type_option_id'=>1
				),
			array(
				'key'=>'parking',
				'default'=>'paying',
				'type_option_id'=>1
				),
			array(
				'key'=>'animals',
				'default'=>'accepted',
				'type_option_id'=>1
				),
			array(
				'key'=>'animals',
				'default'=>'refused',
				'type_option_id'=>1
				),
			array(
				'key'=>'animals',
				'default'=>'little',
				'type_option_id'=>1
				),
			array(
				'key'=>'internet',
				'default'=>'included',
				'type_option_id'=>3
				),
			array(
				'key'=>'tv',
				'default'=>'tv',
				'type_option_id'=>3
				),
			array(
				'key'=>'tv',
				'default'=>'tv-socket',
				'type_option_id'=>3
				),
			
			array(
				'key'=>'furnished',
				'default'=>'furnished',
				'type_option_id'=>3
				),
			array(
				'key'=>'appliances',
				'default'=>'washing-machine',
				'type_option_id'=>1
				),
			array(
				'key'=>'appliances',
				'default'=>'dryer',
				'type_option_id'=>1
				),
			array(
				'key'=>'appliances',
				'default'=>'oven',
				'type_option_id'=>1
				),
			array(
				'key'=>'appliances',
				'default'=>'microwave',
				'type_option_id'=>1
				),
			array(
				'key'=>'appliances',
				'default'=>'dishwasher',
				'type_option_id'=>1
				),
			array(
				'key'=>'appliances',
				'default'=>'bouloir',
				'type_option_id'=>1
				),
			array(
				'key'=>'appliances',
				'default'=>'kitchen-utensil',
				'type_option_id'=>1
				),
			array(
				'key'=>'appliances',
				'default'=>'fridge',
				'type_option_id'=>1
				),
			array(
				'key'=>'appliances',
				'default'=>'freezer',
				'type_option_id'=>1
				),
			array(
				'key'=>'caution',
				'default'=>'garantee',
				'type_option_id'=>2
				),

			);

		

		// Uncomment the below to run the seeder
		DB::table('options')->insert($options);
	}

}
