<?php

class SubscriptionsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('subscriptions')->truncate();

		$subscriptions = array(
			array(
				'type'=>'fr',
				'price'=>'0',
				'bonus'=>'Aucun',
				),
			array(
				'type'=>'bronze-prenium',
				'price'=>'10',
				'bonus'=>'Annonce mise en avant',
				),
			array(
				'type'=>'akoter-prenium',
				'price'=>'20',
				'bonus'=>'Annonce en avant, accès nouvelle création',
				),

		);

		// Uncomment the below to run the seeder
		DB::table('subscriptions')->insert($subscriptions);
	}

}
