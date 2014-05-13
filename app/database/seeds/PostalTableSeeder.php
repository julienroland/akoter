<?php

class PostalTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('postal')->truncate();

		$postal = array(
			array(
				'start'=>1000,
				'end'=>1299,
				'region_id'=>1
				),
			array(
				'start'=>1300,
				'end'=>1499,
				'region_id'=>2
				),
			array(
				'start'=>1500,
				'end'=>1999,
				'region_id'=>3
				),
			array(
				'start'=>2000,
				'end'=>2999,
				'region_id'=>4
				),
			array(
				'start'=>3000,
				'end'=>3499,
				'region_id'=>5
				),
			array(
				'start'=>3500,
				'end'=>3999,
				'region_id'=>6
				),
			array(
				'start'=>4000,
				'end'=>4999,
				'region_id'=>7
				),
			array(
				'start'=>5000,
				'end'=>5999,
				'region_id'=>8
				),
			array(
				'start'=>6000,
				'end'=>6599,
				'region_id'=>9
				),
			array(
				'start'=>6600,
				'end'=>6999,
				'region_id'=>10
				),
			array(
				'start'=>7000,
				'end'=>7999,
				'region_id'=>11
				),
			array(
				'start'=>8000,
				'end'=>8999,
				'region_id'=>12
				),
			array(
				'start'=>9000,
				'end'=>9999,
				'region_id'=>13
				),

			);

		// Uncomment the below to run the seeder
		 DB::table('postal')->insert($postal);
	}

}
