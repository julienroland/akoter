<?php


class ImagesTypesTableSeeder extends Seeder {

	public function run()
	{
// Uncomment the below to wipe the table clean before populating
		// DB::table('langages')->truncate();
		$image_type = array(
			array(
				'name'=>'small',
				'width'=>'69',
				'height'=>'53',
				'extension'=>'jpg',
				),
			array(
				'name'=>'medium',
				'width'=>'185',
				'height'=>null,
				'extension'=>'jpg',
				),
			array(
				'name'=>'gallery',
				'width'=>'468',
				'height'=>null,
				'extension'=>'jpg',
				),
			array(
				'name'=>'lightbox',
				'width'=>'960',
				'height'=>'480',
				'extension'=>'jpg',
				),
			);

		// Uncomment the below to run the seeder
		DB::table('images_types')->insert($image_type);
	}

}