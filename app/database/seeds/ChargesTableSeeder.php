<?php

class ChargesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('charges')->truncate();

		$charges = array(
		);
		for($i=1;$i<3;$i++){
			array_push($charges,array('id'=>$i));
		}

		// Uncomment the below to run the seeder
		DB::table('charges')->insert($charges);
	}

}
