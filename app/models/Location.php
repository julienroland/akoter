<?php

use Carbon\Carbon;

class Location extends Eloquent{

	protected $guarded = array();
	
	public static $rules = array(
		'price'=>'required | numeric',
		'title.en'=>'required_without_all:title.fr,title.nl',
		'size'=>'required | numeric',
		'floor'=>'required | numeric',
		'room'=>'required | numeric',
		'chargePrice'=>'required_with:charge | numeric',
		'start_date'=>'required_with:available | date',
		'end_date'=>'required_with:available,start_date | date',
		'advert.en'=>'required_without_all:title.fr,title.nl',
		);

	public function getTitleAttribute(){

		if(Helpers::isOk($this)){
			foreach(Config::get('var.langId') as $lang => $langId){
				$title = $this->translation()->whereLanguageId($langId)->whereKey('title')->pluck('value');
				$price = round($this->price.' euros');
				$typeLocation = $this->typeLocation->translation()->whereLanguageId($langId)->pluck('value');
				$region = $this->building->region->translation()->whereLanguageId($langId)->pluck('value');
				$locality = $this->building->locality->pluck('name');

				return $typeLocation.' '.$region.' '.$locality.' '.$price.' '.$title.' '.$this->id;
			}
		}
	}
	
	public static function getLocationByType( $building ){

		$kots = $building->location()->whereTypeLocationId(1)->get();

		$studios = $building->location()->whereTypeLocationId(2)->get();

		$duplex = $building->location()->whereTypeLocationId(3)->get();

		$appartement = $building->location()->whereTypeLocationId(4)->get();

		$house = $building->location()->whereTypeLocationId(5)->get();
		
		$internat = $building->location()->whereTypeLocationId(6)->get();

		return array(
			'1'=>array(
				'id'=>1,
				'number'=>$kots->count() == 0 || $kots->count() > 1 ? $kots->count(): $kots[0]->nb_locations,
				'advert'=>isset($kots[0]) ? $kots[0]->advert_specific:''),
			'2'=>array(
				'id'=>2,
				'number'=>$studios->count() == 0 || $studios->count() > 1 ? $studios->count(): $studios[0]->nb_locations,
				'advert'=>isset($studios[0]) ? $studios[0]->advert_specific :''),
			'3'=>array(
				'id'=>3,
				'number'=>$duplex->count() == 0 || $duplex->count() > 1 ? $duplex->count(): $duplex[0]->nb_locations,
				'advert'=>isset($duplex[0]) ? $duplex[0]->advert_specific:''),
			'4'=>array(
				'id'=>4,
				'number'=>$appartement->count() == 0 || $appartement->count() > 1 ? $appartement->count(): $appartement[0]->nb_locations,
				'advert'=>isset($appartement[0]) ? $appartement[0]->advert_specific:''),
			'5'=>array(
				'id'=>5,
				'number'=>$house->count() == 0 || $house->count() > 1 ? $house->count(): $house[0]->nb_locations,
				'advert'=>isset($advert_specific[0]) ? $house[0]->advert_specific:''),
			'6'=>array(
				'id'=>6,
				'number'=>$internat->count() == 0 || $internat->count() > 1 ? $internat->count(): $internat[0]->nb_locations,
				'advert'=>isset($internat[0]) ? $internat[0]->advert_specific:''),
			);
}
public function user(){

	return $this->belongsToMany('User','user_location'); 
}

public function option(){

	return $this->belongsToMany('Option'); 
}

public function currentUser(){

	return $this->belongsToMany('User','user_location')
	->where('status', 1)->withPivot('status','end','begin'); 
}

public function typeLocation(){

	return $this->belongsTo('TypeLocation'); 
}

public function building(){

	return $this->belongsTo('Building'); 
}


public function photo(){

	return $this->hasMany('PhotoLocation'); 
}

public function accroche(){

	return $this->hasMany('PhotoLocation')
	->whereOrder(1); 
}

public function translation(){

	return $this->morphMany('Translation','content')
	->where(Config::get('var.t_langCol'), Session::get('langId')); 
}
public function translations(){

	return $this->morphMany('Translation','content');
}

public function particularity(){

	return $this->belongsToMany('Particularity'); 
}


public static function getLocationsPaginateList( $nb_obj = null, $paginate = null, $orderBy = 'created_at'  , $orderWay = 'asc' , $lang_id = null ){

	if(Helpers::isNotOk($nb_obj)){

		$nb_obj = Config::get('var.take_default');
	}

	if(Helpers::isNotOk($paginate)){

		$paginate = Config::get('var.take_default');
	}

	if($orderBy === 'date' || $orderBy === 'create' || $orderBy === 'created' || $orderBy === 'created_at')
	{

		$orderBy = 'created_at';

	}

	if(Helpers::isNotOk( $lang_id )){

		$lang_id = Session::get('langId');
	}

		//[img, title, type_location, city, short-description, rating, room_remaining, owner, charge[price,type]]

	$locations = Location::with(

		array(
			'translation' => function( $query) use ( $lang_id ){ 
				$query
				->where(Config::get('var.t_langCol'), $lang_id);
			},
			'photo',
			'building.region.translation' => function( $query ) use ( $lang_id ){
				$query->where(Config::get('var.t_langCol'), $lang_id);
			},
			'building.user',
			'building.locality',
			'typeLocation.translation',
			'particularity.translation' => function( $query ) use ( $lang_id ){
				$query->where(Config::get('var.t_langCol'), $lang_id);
			},
			))
	->where( Config::get( 'var.l_validateCol' ) , 1 )
	->where( Config::get( 'var.l_placesCol' ) ,'>', 0 )
	->orderBy( $orderBy , $orderWay )
	->distinct('building')
	->take( $nb_obj )
	->paginate( $paginate );


	return $locations;
}

public static function getLocationsMapList( $ids , $paginate,  $orderBy = 'created_at'  , $orderWay = 'asc' , $lang_id = null ){


	if(Helpers::isNotOk($paginate)){

		$paginate = Config::get('var.take_default');
	}

	if($orderBy === 'date' || $orderBy === 'create' || $orderBy === 'created' || $orderBy === 'created_at')
	{

		$orderBy = 'created_at';

	}

	if(Helpers::isNotOk( $lang_id )){

		$lang_id = Session::get('langId');
	}

		//[img, title, type_location, city, short-description, rating, room_remaining, owner, charge[price,type]]

	$locations = Location::with(

		array(
			'translation' => function( $query) use ( $lang_id ){ 
				$query
				->where(Config::get('var.t_langCol'), $lang_id);
			},
			'photo',
			'building.region.translation' => function( $query ) use ( $lang_id ){
				$query->where(Config::get('var.t_langCol'), $lang_id);
			},
			'building.user',
			'building.locality',
			'typeLocation.translation',
			'particularity.translation' => function( $query ) use ( $lang_id ){
				$query->where(Config::get('var.t_langCol'), $lang_id);
			},
			))
	->where( Config::get( 'var.l_validateCol' ) , 1 )
	->where( Config::get( 'var.l_placesCol' ) ,'>', 0 )
	->orderBy( $orderBy , $orderWay )
	->take( $nb_obj )
	->paginate( $paginate );


	return $locations;
}

public static function getLocationsList( $nb_obj = null, $paginate = null, $orderBy = 'created_at'  , $orderWay = 'asc' , $lang_id = null ){

	if(Helpers::isNotOk($nb_obj)){

		$nb_obj = Config::get('var.take_default');
	}

	if(Helpers::isNotOk($paginate)){

		$paginate = Config::get('var.take_default');
	}

	if($orderBy === 'date' || $orderBy === 'create' || $orderBy === 'created' || $orderBy === 'created_at')
	{

		$orderBy = 'created_at';

	}

	if(Helpers::isNotOk( $lang_id )){

		$lang_id = Session::get('langId');
	}


		//[img, title, type_location, city, short-description, rating, room_remaining, owner, charge[price,type]]

	$locations = Location::with(

		array(
			'translation',
			'accroche',
			'building.region.translation',
			'building.user',
			'building.locality',
			'typeLocation.translation',
			'particularity.translation',
			))
	->where( Config::get( 'var.l_validateCol' ) , 1 )
	->where( Config::get( 'var.l_placesCol' ) ,'>', 0 )
	->distinct('building')
	->orderBy( $orderBy , $orderWay )
	->take( $nb_obj )
	->get( );

	return $locations;
}

public static function getLocationsFilter( $input = null, $nb_obj = null, $paginate = null, $orderBy = 'created_at', $orderWay = 'asc', $lang_id = null ){

		/**
		*
		* Get only not empty values
		*
		**/

		if(Helpers::isNotOk($input)){

			$input = Input::all();

		}

		if(Helpers::isNotOk($nb_obj)){

			$nb_obj = Config::get('var.take_default');
		}

		if(Helpers::isNotOk($paginate)){

			$paginate = Config::get('var.take_default');
		}

		if(Helpers::isNotOk( $lang_id )){

			$lang_id = Session::get('langId');
		}

		if(isset($input['list'])){

			$list = json_decode($input['list']);
		}

		//[img, title, type_location, city, short-description, rating, room_remaining, owner, charge[price,type]]

		$locations = Location::with(

			array(
				'translation',
				'photo'=>function($query){

					$query->whereOrder(1);
				},
				'building.region.translation',
				'building.user',
				'typeLocation.translation',
				'building.locality',
				'particularity.translation',
				))
		->where( Config::get( 'var.l_validateCol' ) , 1 )
		->where( Config::get( 'var.l_placesCol' ) ,'>', 0 );
		
		if(isset($list) && Helpers::isOk($list)){

			$locations->whereIn('id', $list);

		}

		if(isset($input['search']) && Helpers::isOk($input['search'])){

			$terms = explode(' ',$input['search']);

			foreach( $terms as $term){

				$locations = $locations->whereHas('translation',function($query) use($term){
					$query
					->title()->where('value','like', '%'.$term.'%')
					->where('key','slug')->orWhere('value','like', '%'.$term.'%');
				});

				$locations = $locations->with(array('typeLocation.translation'=>function($query) use($term){
					$query->where('key','name')->orWhere('value','like','%'.$term.'%');
				}));
			}
		}

		if(isset($input['typeLocation']) && Helpers::isOk( $input['typeLocation'] )){

			$locations = $locations->whereTypeLocationId( (int)$input['typeLocation']  );

		}	

		if(isset($input['particularity']) && Helpers::isOk( $input['particularity'] )){

			$locations = $locations->whereHas('particularity', function($query) use($input){

				$query->whereIn('particularity_id', $input['particularity']);

			});

		}
		/*if(isset($input['particularity']) && Helpers::isOk( $input['particularity'] )){

			$locations = $locations->whereHas('particularity',function($query) use($input){

				$query
				->where('particularity_id', $input['particularity'][1])

				;

			});

}*/
		/*if(isset($input['particularity']) && Helpers::isOk( $input['particularity'] )){

			$locations = $locations
			->join('location_particularity','locations.id','=','location_particularity.location_id')
			->join('particularities','location_particularity.particularity_id','=','particularities.id')
			->whereIn('location_particularity.particularity_id', $input['particularity']);

		}
		*/
		if(isset($input['min_price']) && Helpers::isOk( $input['min_price'] )){

			$locations = $locations->where('price', '>', (int)$input['min_price']  )->orderBy('price','asc');

		}

		if(isset($input['max_price']) && Helpers::isOk( $input['max_price'] )){

			$locations = $locations->where('price', '<', (int)$input['max_price']  )->orderBy('price','asc');

		}

		if(isset($input['start_date']) && Helpers::isOk( $input['start_date'] )){

			$date_start = Helpers::createCarbonDate(Helpers::toPhpDate($input['start_date']))->subWeeks(2)->toDateTimeString();

			$locations = $locations->whereBetween('start_date', array( $date_start, Helpers::toPhpDate($input['start_date']))  );

		}

		if(isset($input['end_date']) && Helpers::isOk( $input['end_date'] )){

			$date_end = Helpers::createCarbonDate(Helpers::toPhpDate($input['end_date']))->addWeeks(2)->toDateTimeString();

			$locations = $locations->whereBetween('end_date', array( $date_end, Helpers::toPhpDate($input['end_date']))  );

		}

		if(isset($input['size']) && Helpers::isOk( $input['size'] )){

			$size = Helpers::toPercent( (int)$input['size'], 10);

			$size_min = (int)$input['size'] - $size;

			$size_max = (int)$input['size'] + $size;

			$locations = $locations->whereSize( (int)$input['size'] )->orWhereBetween( 'size', array( $size_min, $size_max ) );

		}

		if(isset($input['charge']) && Helpers::isOk($input['charge'])){

			if($input['charge'] == 1){

				if(isset($input['price_charge']) && Helpers::isOk( $input['price_charge'] )){

					$locations = $locations->whereChargeType( $input['charge'] );

					$locations = $locations->where('charge_price', '<=',  (int)$input['price_charge'] );
				}
				

			}elseif($input['charge'] == 0){

				$locations = $locations->whereChargeType( (int)$input['charge'] );

			}

		}
		/*if(isset($input['city']) && Helpers::isOk( $input['city'] )){

			$region = ucfirst(Helpers::cleanString( $input['city'] ));

			$locations = $locations
			->join('buildings','locations.building_id','=','buildings.id')
			->join('regions','buildings.region_id','=','regions.id')
			->join('translations','regions.id','=','translations.content_id')
			->where('value','like','%'.$region.'%');


			

		}*/

		if(isset($input['city']) && Helpers::isOk( $input['city'] ) && (!isset($input['list']) || Helpers::isNotOk($input['list']))){

			$region = ucfirst(Helpers::cleanString( $input['city'] ));

			$locations = $locations
			->whereHas('building',function($query) use($region){

				$query->whereHas('region', function($query) use($region){

					$query->whereHas('translation', function($query) use($region){

						$query->where('value','like','%'.$region.'%');

					});

				});

			});
			/**
			
				TODO:
				- Test where has on translation
				- the test has on region
			
				**/




			}

			if(isset($input['classify']) && Helpers::isOk($input['classify'])){

				$locations->orderBy(Helpers::getFilterBy($input['classify']), Helpers::getFilterWay($input['classify']));

			}




	/*	$locations = $locations->take(30)->get();

	dd($locations);*/
	$locations = $locations->paginate( $paginate );
	return $locations;
}
}
