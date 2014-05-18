<?php

use Carbon\carbon;

class SchoolsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('charges')->truncate();
		$alpha = range('a', 'z');
		$schools = array();
		$street = array(
			'Rue des gens',
			'Rue des gens',
			'Rue des gens',
			'Rue des gens',
			'Rue des gens',
			'Rue du chat',
			'Rue de Dieu',
			'Rue de Dieu',
			'Rue de Dieu',
			'Rue de Dieu',
			'Rue de Dieu',
			'Rue de Dieu',
			'Rue de la Montagne',
			'Rue de la Montagne',
			'Rue de la Montagne',
			'Rue de la Montagne',
			'Rue de la Montagne',
			'Rue de la Montagne',
			'Rue parfaite',
			'Rue parfaite',
			'Rue parfaite',
			'Rue parfaite',
			'Rue parfaite',
			'Rue parfaite',
			'Rue parfaite',
			'Rue parfaite',
			'Rue Jean-Michel',
			'Rue Jean-Michel',
			'Rue Jean-Michel',
			'Rue Jean-Michel',
			'Rue Jean-Michel',
			'Rue des lacs',
			'Rue des lacs',
			'Rue des lacs',
			'Rue des lacs',
			'Rue des lacs',
			'Rue Mars',
			'Rue des pommes',
			'Rue des gens',
			'Rue des gens',
			'Rue des gens',
			'Rue des gens',
			'Rue des gens',
			'Rue noble',
			'Rue noble',
			'Rue noble',
			'Rue noble',
			'Rue noble',
			'Rue noble',
			'Rue du jou',
			'Rue du jou',
			'Rue du jou',
			'Rue du jou',
			'Rue du jou',
			'Rue du jou',
			'Rue du jou',
			'Rue frie',
			'Rue du Belge',
			'Rue du terne',
			'Rue Frank',
			'Rue Frank',
			'Rue Frank',
			'Rue Frank',
			'Rue Frank',
			'Rue Frank',
			'Rue Frank',
			'Rue John',
			'Rue John',
			'Rue John',
			'Rue John',
			'Rue John',
			'Rue John',
			'Rue des anonymes',
			'Rue des Champignon',
			'Rue des Champignon',
			'Rue des Champignon',
			'Rue des Champignon',
			'Rue des Champignon',
			'Rue des Champignon',
			'Rue des Champignon',
			'Rue des Champignon',
			'Rue de la santée',
			'Rue mang',
			'Rue mang',
			'Rue mang',
			'Rue mang',
			'Rue mang',
			'Rue mang',
			'Rue mang',
			'Rue homme',
			'Rue homme',
			'Rue homme',
			'Rue homme',
			'Rue homme',
			'Rue homme',
			'Rue homme',
			'Rue Jeanne',
			'Rue Jeanne',
			'Rue Jeanne',
			'Rue Jeanne',
			'Rue Jeanne',
			'Rue Jeanne',
			'Rue Jeanne',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue de Virton',
			);

for($i=1;$i<50;$i++){

	$name = '';
	$short = '';

	for($o=1;$o<rand(5,13);$o++){
		$name = $name . $alpha[rand(1, 25)];
	}

	for($o=1;$o<rand(2,5);$o++){
		$short = $short . $alpha[rand(1, 25)];
	}
	array_push($schools,
		array(
			'street'=>$street[rand(1,30)],
			'latlng'=>(rand(50000,51000)/1000).','.(rand(3800,5500)/1000),
			'region_id'=>rand(1,13),
			'locality_id'=>rand(1,2000),
			'status_type'=>1,
			'postal_id'=>rand(1,13),
			'name'=>$name,
			'short'=>$short,
			"created_at"=>Carbon::create(rand(2013,2014), rand(8,10), rand(1,30), 12),/*$date->format('Y-m-d H:i:s'),*/
			)
		);
}

		// Uncomment the below to run the seeder
DB::table('schools')->insert($schools);
}

}
