<?php

class UsersGroupsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users_groups')->truncate();
		$group = array('superadmin','admin','member','prenium','beta');
		$description = array('superadmin','admin','member','prenium','beta');
		$users_groups = array();
		//superadmin, admin, membre, prenium, beta , tester, vip
		for($i=0; $i < 5; $i++){
			array_push($users_groups, 
				array(
				'name'=>$group[$i],
				));
		}

		// Uncomment the below to run the seeder
		DB::table('roles')->insert($users_groups);
	}

}
