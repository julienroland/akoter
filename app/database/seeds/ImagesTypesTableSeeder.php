<?php


class ImagesTypesTableSeeder extends Seeder {

	public function run()
	{
// Uncomment the below to wipe the table clean before populating
		// DB::table('langages')->truncate();
		$image_type = array(
			array(
				'name'=>'small',
				'width'=>63,
				'height'=>32,
				'extension'=>'jpg',
				),
			array(
				'name'=>'medium',
				'width'=>185,
				'height'=>null,
				'extension'=>'jpg',
				),
			array(
				'name'=>'mapslider',
				'width'=>250,
				'height'=>150,
				'extension'=>'jpg',
				),
			array(
				'name'=>'gallery',
				'width'=>300,
				'height'=>null,
				'extension'=>'jpg',
				),
			array(
				'name'=>'lightbox',
				'width'=>649,
				'height'=>325,
				'extension'=>'jpg',
				),
			);

		// Uncomment the below to run the seeder
		DB::table('images_types')->insert($image_type);
	}

}