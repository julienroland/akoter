<?php

return array(
//dir
	'path'=>'/',
	'url'=>'http://akoter.julien-roland.be',
	'img_dir'=>'/img/',
	'img_locations_dir'=>'/img/locations/',
	'img_locations_replace'=>'/images/users/:user_id/locations/:location_id/',
	'img_users_dir'=>'/img/locations/',
	'img_posts_dir'=>'img/posts/',
	'images_dir'=>'images/',
	'users_dir'=>'users/',
	'agences_dir'=>'agences/',
	'buildings_dir'=>'buildings/',
	'locations_dir'=>'locations/',
	'commons_dir'=>'commons_rooms/',
	'moreBuildingPhotos'=>'more',
	'logoAgence_dir'=>'logo/',
	'profile_dir'=>'profile/',
//translations
	't_langCol'=>'language_id',

//locations
	'l_descriptionCol'=>'description',
	'l_shortDescriptionCol'=>'short_description',
	'l_titleCol'=>'title',
	'l_validateCol'=>'validate',
	'l_availableCol'=>'available',
	'l_placesCol'=>'remaining_room',
	'take_default'=>24,
	'orderBy_default'=>'created_at',
	'orderWay_default'=>'asc',

//buildings
	'b_validateCol'=>'status_type',
	'buildingMaxImage'=>25,

//empty item
	'no_photoLocation'=>'noPhotoLocation.jpg',
	'no_photoUserM'=>'noPhotoUserM.svg',
	'no_photoUserF'=>'noPhotoUserF.svg',
	'no_logoAgence'=>'no_logoAgence.jpg',

	/** PREFIX TABLE **/
	'p_location'=>'location_',
	'p_particularity'=>'particularity_',
//others
	'logo'=>'/img/logo/logo.png',
	'remember'=>60 * 24,
	//img
	'img_small'=>'small',
	'img_medium'=>'medium',
	'img_gallery'=>'gallery',
	'img_lightbox'=>'lightbox',
//user photo 
	'user_photo_width'=>64,
	'user_photo_height'=>64,
	'lang'=>array(
		'1'=>'fr',
		'3'=>'nl',
		'2'=>'en',
		),
	'langId'=>array(
		'fr'=>'1',
		'nl'=>'3',
		'en'=>'2',
		
		),
	//agence logo
	'agence_logo_width'=>200,
	'agence_logo_height'=>130,
//charges
	'charges'=>array(
		''=>trans('form.all'),
		'0'=>trans('locations.included'),
		'1'=>trans('locations.not_included'),
		),
	'filter'=>array(
		''=>trans('form.position'),
		trans('form.pricing')=>array(
			'price:desc'=>trans('form.high_cost'),
			'price:asc'=>trans('form.low_cost'),
			),
		trans('form.room')=>array(
			'remaining_room:desc'=>trans('form.most_room'),
			'remaining_room:asc'=>trans('form.less_room'),
			),
		trans('form.stats')=>array(
			'rating:desc'=>trans('form.rate'),
			'nb_rate:desc'=>trans('form.nb_like'),
			'nb_views:desc'=>trans('form.nb_view'),
			),
		trans('form.date') => array(
			'available:desc'=>trans('form.available'),
			'created_at:asc'=>trans('form.created_date'),
			),
		),
	'articles_photo'=>array(
		'width'=>300,
		'height'=>200,
		),
	'steps'=>8,
	'steps_names'=>array(
		1=>trans('inscription.steps.1'),
		2=>trans('inscription.steps.2'),
		3=>trans('inscription.steps.3'),
		4=>trans('inscription.steps.4'),
		5=>trans('inscription.steps.5'),
		6=>trans('inscription.steps.6'),
		7=>trans('inscription.steps.7'),
		8=>trans('inscription.steps.8'),
		),
	'steps_routes'=>array(
		1=>'index_localisation_building',
		2=>'index_types_locations',
		3=>'index_inscription_building',
		4=>'index_inscription_general',
		5=>'index_photo_building',
		6=>'index_inscription_adverts',
		7=>'index_photo_advert',
		8=>'index_inscription_contact',

		),
	'img_quality'=>90,
	'keywords'=>trans('seo.keywords'),
	'lat'=>'50,28',
	'lng'=>'4.52',
	'street'=>'Rue Basse Montagne',
	'city'=>'Namur',
	'postal'=>'5100',
	'country'=>'Belgique',
	'email'=>'akoter@julien-roland.be',
	'phone'=>'+32 (0)495 94 51 93',






	);