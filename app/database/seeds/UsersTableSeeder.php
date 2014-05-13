<?php

use Carbon\Carbon;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		//DB::table('users')->truncate();

		$name = array('Roland','Dane','Bruce','Doe','Vandierk','kalifa','Zonli','Ledieu','Rosmant');
		$first_name = array('Julien','Jeremy','Wil','John','Toon','Esmeralda','Zaze','Thierry','Annie');
		$email = array();
		$users_group = array('1','3','3','3','3','3','2','5','2');
		$role = array('3','1','1','1','1','1','2','1','1');
		$date = new Datetime();
		for($i=0;$i<count($name);$i++){

			array_push($email,$name[$i].'-'.$first_name[$i].'@email.com');

		}

		$password = array();
		for($i=0;$i<count($name);$i++){

			array_push($password,Hash::make('mdp'));

		}
		$street = array(
			'Rue des gens',
			'Rue du pain',
			'Rue de Dieu',
			'Rue de la Montagne',
			'Rue parfaite',
			'Rue Jean-Michel',
			'Rue des assasins',
			'Rue holiday',
			'Rue des lacs'
			);

		$subscriptions =array();
		for($i=0;$i<count($name);$i++){
			array_push($subscriptions,rand(1,1));
		}

		$regions = array();
		for($i=0;$i<count($name);$i++){
			array_push($regions,rand(1,13));
		}


		$localities = array();
		for($i=0;$i<count($name);$i++){
			array_push($localities,rand(1,2850));
		}

		$users = array(
			);

		for($i=0;$i<count($name);$i++){

			array_push($users,array(
				'name'=>$name[$i],
				'slug'=>Helpers::toSlug($first_name[$i]).'-'.Helpers::toSlug($name[$i]),
				'first_name'=>$first_name[$i],
				'email'=>$email[$i],
				'password'=>$password[$i],
				'civility'=>rand(0,1),
				'subscription_id'=>$subscriptions[$i],
				'street'=>$street[$i],
				'region_id'=>$regions[$i],
				'locality_id'=>$localities[$i],
				'validate'=>1,
				'created_at'=>Carbon::create(2014, rand(1,12), rand(1,28), 12),
				'role_id'=>$users_group[$i],
				'language_id'=>rand(1,3),
				));

		}

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
