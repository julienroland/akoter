<?php

return array(
//dir
	'path'=>'/',
	'img_dir'=>'/img/',
	'img_locations_dir'=>'/img/locations/',
	'img_users_dir'=>'/img/locations/',
	'img_posts_dir'=>'/img/posts/',
	'images_dir'=>'images/',
	'users_dir'=>'users/',
	'agences_dir'=>'agences/',
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
//user photo 
	'user_photo_width'=>104,
	'user_photo_height'=>104,
	'lang'=>array(
		'1'=>'fr',
		'2'=>'en',
		'3'=>'nl',
		),
	'langId'=>array(
		'fr'=>'1',
		'en'=>'2',
		'nl'=>'3',
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







	);