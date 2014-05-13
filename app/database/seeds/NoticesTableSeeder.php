<?php

use Carbon\Carbon;

class NoticesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('notices')->truncate();

		$notices = array(

		);
		for($i=0; $i < 50; $i++)
		{
			 array_push($notices,array(
			 	'user_id'=> rand(1,9),
			 	'validate'=> rand(0,1),
			 	'created_at'=> Carbon::create(2014, rand(1,12), rand(1,28), 12),
			 	));
			
		}

		// Uncomment the below to run the seeder
		DB::table('notices')->insert($notices);
	}

}
