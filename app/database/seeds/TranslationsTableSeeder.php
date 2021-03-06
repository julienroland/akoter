<?php

class TranslationsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('translations')->truncate();
		$lang = array('fr','en','nl');
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
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue des Chaufoures',
			'Rue Grand rue',
			'Rue de fer',
			'Rue de l\'ange',
			'Rue de ferrer',
			'Rue de Basse Montagne',
			'Chaussée de Dinant',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue du pargé',
			'Rue de Tongres',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
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
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue des Chaufoures',
			'Rue Grand rue',
			'Rue de fer',
			'Rue de l\'ange',
			'Rue de ferrer',
			'Rue de Basse Montagne',
			'Chaussée de Dinant',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue du pargé',
			'Rue de Tongres',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
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
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue des Mésange',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue des Chaufoures',
			'Rue Grand rue',
			'Rue de fer',
			'Rue de l\'ange',
			'Rue de ferrer',
			'Rue de Basse Montagne',
			'Chaussée de Dinant',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue du pargé',
			'Rue de Tongres',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
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
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
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
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue de Virton',
			'Rue des Chaufoures',
			'Rue Grand rue',
			'Rue de fer',
			'Rue de l\'ange',
			'Rue de ferrer',
			'Rue de Basse Montagne',
			'Chaussée de Dinant',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue de l\'Eglise',
			'Rue du pargé',
			'Rue de Tongres',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Launoy',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Rue Entrée Jacques',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			'Allée des Roses',
			);

$postTitleHome = array(
	'content'=>array(
		'fr'=>array(
			'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam porro error sed et rem ut optio eaque recusandae ipsum. Nemo, dolore enim obcaecati iure aspernatur ipsam tempore sunt suscipit quod.</p>',
			'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam porro error sed et rem ut optio eaque recusandae ipsum. Nemo, dolore enim obcaecati iure aspernatur ipsam tempore sunt suscipit quod.</p>',
			'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam porro error sed et rem ut optio eaque recusandae ipsum. Nemo, dolore enim obcaecati iure aspernatur ipsam tempore sunt suscipit quod.</p>',
			),
		'en'=>array(
			'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam porro error sed et rem ut optio eaque recusandae ipsum. Nemo, dolore enim obcaecati iure aspernatur ipsam tempore sunt suscipit quod.</p>',
			'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam porro error sed et rem ut optio eaque recusandae ipsum. Nemo, dolore enim obcaecati iure aspernatur ipsam tempore sunt suscipit quod.</p>',
			'<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam porro error sed et rem ut optio eaque recusandae ipsum. Nemo, dolore enim obcaecati iure aspernatur ipsam tempore sunt suscipit quod.</p>',
			),
		'nl'=>array(
			'<p>Bijdragen aan de vooruitgang</p>',
			'<p>Waarom Akoter</p>',
			'<p>Akoter figuur in wat er gebeurt</p>',
			),
		),
'title'=>array(
	'fr'=>array(
		'Contribuez à l\'avancement',
		'Pourquoi choisir Akoter',
		'Akoter en chiffre ça donne quoi',
		),
	'en'=>array(
		'Contribute to the advancement',
		'Why Akoter ',
		'Akoter figure in what happens',
		),
	'nl'=>array(
		'Bijdragen aan de vooruitgang',
		'Waarom Akoter',
		'Akoter figuur in wat er gebeurt',
		),
	),
'slug'=>array(
	'fr'=>array(
		'contribuez-a-l-avancement',
		'pourquoi-choisir-akoter',
		'akoter-en-chiffre-ca-donne-quoi',
		),
	'en'=>array(
		'contribute-to-the-advancement',
		'why-Akoter',
		'akoter-figure-in-what-happens',
		),
	'nl'=>array(
		'bijdragen-aan-de-vooruitgang',
		'waarom-Akoter',
		'akoter-figuur-in-wat-er-gebeurt',
		),
	),

); 

$role = array(
	'fr'=> array(
		'superadmin',
		'administrateur',
		'membre',
		),
	'en'=> array(
		'superadmin',
		'administrator',
		'member',
		),
	'nl'=> array(
		'superadmin',
		'beheerder',
		'lid',
		)
	);


$types_locations = array(
	'fr'=>array(
		'1'=>'Kot',
		'2'=>'Studio',
		'3'=>'Duplex',
		'4'=>'Appartement',
		'5'=>'Maison',
		'6'=>'Internat',
		),
	'en'=>array(
		'1'=>'Kot',
		'2'=>'Studio',
		'3'=>'Duplex',
		'4'=>'Appartment',
		'5'=>'House',
		'6'=>'Internship',
		),
	'nl'=>array(
		'1'=>'Kot',
		'2'=>'Studio',
		'3'=>'Tweezijdig',
		'4'=>'Appartement',
		'5'=>'Thuis',
		'6'=>'Stage',
		),
	);

$particularity = array(
	'fr'=>array(
		'Wifi',
		'Salle de bain privée',
		'Lavabo privé',
		'Cuisine privée',
		),
	'en'=>array(
		'Wifi',
		'Bathroom private',
		'washbasin private',
		'Kitchen private',
		),
	'nl'=>array(
		'Wifi',
		'Badkamer prive',
		'fonteintje prive',
		'keuken prive',
		),
	);

$regions = array(
	'fr'=> array(
		'Bruxelles-Capitale',
		'Brabant wallon',
		'Brabant Flamand',
		'Anvers',
		'Brabant Flamand',
		'Limbourg',
		'Liège',
		'Namur',
		'Hainaut',
		'Luxembourg',
		'Hainaut',
		'Flandre-Occidentale',
		'Flandre-Orientale',
		),
	'en'=> array(
		'Brussels', 
		'Brabant', 
		'Flemish Brabant',
		'Antwerp',
		'Flemish Brabant', 
		'Limburg',
		'Liege', 
		'Namur', 
		'Hainaut', 
		'Luxembourg', 
		'Hainaut', 
		'West Flanders', 
		'East Flanders',
		),
	'nl'=> array(
		'Brussel', 
		'Brabant', 
		'Vlaams-Brabant', 
		'Antwerpen', 
		'Vlaams-Brabant', 
		'Limburg', 
		'Luik', 
		'Namen', 
		'Hainaut', 
		'Luxemburg', 
		'Hainaut', 
		'West-Vlaanderen',
		'Oost-Vlaanderen',
		),
	);

$options = array(
	'fr'=>array(
		'Salle de bain',
		'Cuisine',
		'Salon',
		'Jardin',
		'Terrasse',
		'Balcon',
		'Parking privé',
		'Parking public à proximité',
		'Parking payant à proximité',
		'Animaux accepté',
		'Animaux réfusé',
		'Petit animaux accepté',
		'Internet inclus',
		'TV',
		'Prise TV',
		'Meublé',
		'Machine à laver',
		'Sèche linge',
		'Four',
		'Four micro-onde',
		'Lave vaisselle',
		'Bouloir',
		'Ustensil de cuisine disponible',
		'Frigo',
		'Congélateur',
		'Caution',
		

		),
	'en'=>array(
		'Bathroom',
		'Kitchen',
		'Salon',
		'Jardin',
		'Terrasse',
		'Balcon',
		'Parking privé',
		'Parking public à proximité',
		'Parking payant à proximité',
		'Animaux accepté',
		'Animaux réfusé',
		'Petit animaux accepté',
		'Internet inclus',
		'TV',
		'Prise TV',
		'Meublé',
		'Machine à laver',
		'Sèche linge',
		'Four',
		'Four micro-onde',
		'Lave vaisselle',
		'Bouloir',
		'Ustensil de cuisine disponible',
		'Frigo',
		'Congélateur',
		'Caution',
		


		),
	'nl'=>array(
		'Salle de bain',
		'Cuisine',
		'Salon',
		'Jardin',
		'Terrasse',
		'Balcon',
		'Parking privé',
		'Parking public à proximité',
		'Parking payant à proximité',
		'Animaux accepté',
		'Animaux réfusé',
		'Petit animaux accepté',
		'Internet inclus',
		'TV',
		'Prise TV',
		'Meublé',
		'Machine à laver',
		'Sèche linge',
		'Four',
		'Four micro-onde',
		'Lave vaisselle',
		'Bouloir',
		'Ustensil de cuisine disponible',
		'Frigo',
		'Congélateur',
		'Caution',
		
		),
	);

$translations = array();


foreach($postTitleHome as $key => $post){
	for($m=1;$m <= count($lang); $m++){
		for($l=1 ;$l <= 3; $l++){
			array_push($translations,
				array(
					"content_type"=>"Post",
					"content_id"=>$l,
					"key"=>$key,
					"value"=>$post[$lang[$m-1]][$l-1],
					"language_id"=>$m,
					)
				);	
			
		}
	}
}
for($m=1;$m <= count($lang); $m++){
	for($i=1; $i<=count($options['fr']); $i++){

		array_push($translations,
			array(
				"content_type"=>"Option",
				"content_id"=>$i,
				"key"=>"name",
				"value"=>$options[$lang[$m-1]][$i-1],
				"language_id"=>$m,
				)
			);

	}
	for($i=1 ; $i < 7 ; $i++){
		array_push($translations,
			array(
				"content_type"=>"TypeLocation",
				"content_id"=>$i,
				"key"=>"name",
				"value"=>$types_locations[$lang[$m-1]][$i],
				"language_id"=>$m,
				)
			);
	}
	for($l=1 ;$l <= 3; $l++){
		array_push($translations,
			array(
				"content_type"=>"Role",
				"content_id"=>$l,
				"key"=>"name",
				"value"=>$role[$lang[$m-1]][$l-1],
				"language_id"=>$m,
				)
			);	
	}
	for($l=1 ;$l <= 50; $l++){
		array_push($translations,
			array(
				"content_type"=>"Notice",
				"content_id"=>$l,
				"key"=>"text",
				"value"=>$lang[$m-1]."Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, incidunt, animi, quasi amet sapiente quo iste placeat dicta blanditiis vel corrupti voluptas dolor sunt. Nobis, vel fugit quisquam reiciendis distinctio.",
				"language_id"=>$m,
				)
			);	
	}

	for($l=1 ;$l <= 13; $l++){
		array_push($translations,
			array(
				"content_type"=>"Region",
				"content_id"=>$l,
				"key"=>"name",
				"value"=>$regions[$lang[$m-1]][$l-1],
				"language_id"=>$m,
				)
			);	
	}

	for($k=1 ;$k <= 4; $k++){
		array_push($translations,
			array(
				"content_type"=>"Particularity",
				"content_id"=>$k,
				"key"=>"name",
				"value"=>$particularity[$lang[$m-1]][$k-1],
				"language_id"=>$m,
				)
			);	
	}


	for($i=1 ;$i < count($street)*2; $i++){


		array_push($translations,
			array(
				"content_type"=>"Location",
				"content_id"=>$i,
				"key"=>"description",
				"value"=>$lang[$m-1]."Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam, incidunt, animi, quasi amet sapiente quo iste placeat dicta blanditiis vel corrupti voluptas dolor sunt. Nobis, vel fugit quisquam reiciendis distinctio.",
				"language_id"=>$m,
				)
			);	

	/*	array_push($translations,
			array(
				"content_type"=>"Location",
				"content_id"=>$i,
				"key"=>"short_description",
				"value"=>$lang[$m-1]."Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
				"language_id"=>$m,
				)
);*/

array_push($translations,
	array(
		"content_type"=>"Location",
		"content_id"=>$i,
		"key"=>"title",
		"value"=>$lang[$m-1]."title long ou court",
		"language_id"=>$m,
		)
	);

array_push($translations,
	array(
		"content_type"=>"Location",
		"content_id"=>$i,
		"key"=>"slug",
		"value"=>Helpers::toSlug($lang[$m-1].sha1(rand(1, 1000))."title long ou court"),
		"language_id"=>$m,
		)
	);

}
}
		// Uncomment the below to run the seeder
DB::table('translations')->insert($translations);
}

}
