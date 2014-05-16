<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		DB::statement('SET foreign_key_checks = 0');
		DB::statement('SET UNIQUE_CHECKS=0');

		$this->call('RegionsTableSeeder');
		$this->call('PostalTableSeeder');
		$this->call('LocalitiesTableSeeder');
		$this->call('SubscriptionsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('BuildingTableSeeder');
		$this->call('TypesLocationsTableSeeder');
		$this->call('LanguagesTableSeeder');
		$this->call('LocationsTableSeeder'); 
		$this->call('TranslationsTableSeeder');
		$this->call('ParticularitiesTableSeeder');
		$this->call('ParticularityLocationTableSeeder');
		$this->call('NoticesTableSeeder');
		$this->call('PostsTableSeeder');
		$this->call('UsersGroupsTableSeeder');
		$this->call('OptionTableSeeder');

		DB::statement('SET foreign_key_checks = 1');
		DB::statement('SET UNIQUE_CHECKS= 1');
		
		
		
		

	}

}