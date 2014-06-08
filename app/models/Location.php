<?php

use Carbon\Carbon;

class Location extends Eloquent{

	protected $guarded = array();
	
	public static $rules = array(
		'price'=>' numeric',
		'size'=>' numeric',
		'floor'=>' numeric',
		'room'=>' numeric',
		'chargePrice'=>'required_with:charge | numeric',
		'start_date'=>'required_with:available | date ',
		'end_date'=>'required_with:available,start_date | date',
		'advert.en'=>'min:20 |max:2048',
		'advert.fr'=>'min:20 |max:2048',
		'advert.nl'=>'min:20 |max:2048',
		);

	public static $comment_rules = array(
		'title'=>'required|min:10',
		'note'=>'required|numeric',
		'text'=>'required|min:10',
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

	return $this->belongsToMany('User','user_location')
	->withPivot('status','begin','end')
	->withTimestamps(); 
}

public function tenants(){

	return $this->belongsToMany('User','user_location')
	->withPivot('status','begin','end')
	->whereStatus(1)
	->whereRequest(0)
	->withTimestamps(); 
}

public function request(){

	return $this->belongsToMany('User','user_location')
	->withPivot('status','begin','end','nb_locations','seat','text','id')
	->whereStatus(0)
	->whereRequest(1)
	->withTimestamps(); 
}
public function oldTenants(){

	return $this->belongsToMany('User','user_location')
	->withPivot('status','begin','end')
	->whereStatus(0)
	->whereRequest(0)
	->withTimestamps(); 
}
public function allTenants(){

	return $this->belongsToMany('User','user_location')
	->withPivot('status','begin','end')
	->whereRequest(0)
	->withTimestamps(); 
}
public function option(){

	return $this->belongsToMany('Option'); 
}

public function currentUser(){

	return $this->belongsToMany('User','user_location')
	->where('status', 1)->withPivot('status','end','begin'); 
}

public function scopeValid($query){
	$query->where('available', 1)->where('validate', 1);
}
public function scopeInvalid($query){
	$query->where('validate', 1);
}
public function typeLocation(){

	return $this->belongsTo('TypeLocation'); 
}

public function building(){

	return $this->belongsTo('Building'); 
}

public function favoris(){

	return $this->hasMany('Favoris');
}

public function agence(){
	
	return $this->belongsTo('Agence');
}

/*public function agence()
{
	return $this->belongsToMany('Agence');
}*/

public function photo(){

	return $this->hasMany('PhotoLocation'); 
}


public function comment(){

	return $this->hasMany('LocationComment'); 
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

public static function getOptions($location){

	$dump = $location->option()->with('translation')->get();

	$data = array();

	foreach($dump as $option){

		$data[$option->id]  = $option->translation[0]->value;

	}

	return Collection::make($data);
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
	->where( Config::get( 'var.l_availableCol' ) , 1 )
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
	->where( Config::get( 'var.l_availableCol' ) , 1 )
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
	$locations = Location::with('translation');

	$locations = $locations
	->join('buildings','locations.building_id','=','buildings.id')
	->join('users','buildings.user_id','=','users.id')
	->where('users.validate','=',1)
	->where('users.email_comfirm','=',1)
	->where('buildings.status_type','=',1)
	->select('buildings.id as bu','users.id as uu','locations.*');

	$locations = $locations->with(
		array(
			'translation',
			'accroche',
			'building.region.translation',
			'building.user',
			'building.locality',
			'typeLocation.translation',
			'particularity.translation',
			))
	->where( 'locations.'.Config::get( 'var.l_validateCol' ) , 1 )
	->where( 'locations.'.Config::get( 'var.l_availableCol' ) , 1 )
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
		$locations = Location::with('translation');

		if(isset($input['city']) && Helpers::isOk( $input['city'] ) && (!isset($input['list']) || Helpers::isNotOk($input['list']) || $input['list'] == '[]')){

			$region_id = Translation::whereKey('name')->whereContentType('Region')->where('value','like','%'.$input['city'].'%')->pluck('content_id');
			
			$region = ucfirst(Helpers::cleanString($input['city']));
			$locations = $locations
			->join('buildings as region_B','locations.building_id','=','region_B.id')
			->where('region_B.region_id',$region_id);
		}
		/*if(isset($input['city']) && Helpers::isOk( $input['city'] ) && (!isset($input['list']) || Helpers::isNotOk($input['list']))){
			$locality = ucfirst(Helpers::cleanString($input['city']));
			$locations = $locations
			->join('buildings','locations.building_id','=','buildings.id')
			->join('localities','buildings.locality_id','=','localities.id')
			->where('localities.name','like','%'.$locality.'%')
			->select('localities.id as city_id','locations.*');
		}*/

		if(isset($input['search']) && Helpers::isOk($input['search'])){

			/*$terms = explode(' ',$input['search']);*/

			$locations = $locations
			->join('translations as j2', 'locations.id','=',DB::raw('j2.content_id AND j2.content_type = "Location" AND j2.language_id = '.Session::get('langId')))
			->join('translations as j3', 'locations.type_location_id','=',DB::raw('j3.content_id AND j3.content_type = "TypeLocation" AND j3.language_id = '.Session::get('langId')))
			->where('j2.key','=','title')
			->where('j2.value', 'like', '%'.$input['search'].'%')
			->orWhere('j3.value', 'like', '%'.$input['search'].'%')
			->with('translations')
			->distinct();
			// ->select(array('j3.id as j3_id','j2.id as j2_id','locations.*'));
			
				/*$locations = $locations->with(array('typeLocation.translation'=>function($query) use($term){
					$query->where('key','name')->orWhere('value','like','%'.$term.'%');
				}));*/


}

if(isset($input['particularity']) && Helpers::isOk( $input['particularity'] )){

	$locations = $locations->join('location_particularity','locations.id','=','location_particularity.location_id')
	->join('particularities','location_particularity.particularity_id','=','particularities.id')
	->whereIn('location_particularity.particularity_id', $input['particularity'])
	->with('particularity');

}
$locations = $locations
->join('buildings','locations.building_id','=','buildings.id')
->join('users','buildings.user_id','=','users.id')
->where('users.validate','=',1)
->where('users.email_comfirm','=',1)
->where('buildings.status_type','=',1)
->select('buildings.id as bu','users.id as uu','locations.*');

$locations = $locations->with(

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
->where( 'locations.'.Config::get( 'var.l_validateCol' ) , 1 )
->where( 'locations.'.Config::get( 'var.l_availableCol' ) , 1 )
->where( Config::get( 'var.l_placesCol' ) ,'>', 0 );

if(isset($list) && Helpers::isOk($list)){

	$locations->whereIn('buildings.id', $list);

}

		/*if(isset($input['search']) && Helpers::isOk($input['search'])){

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
		}*/

		if(isset($input['typeLocation']) && Helpers::isOk( $input['typeLocation'] )){

			$locations = $locations->whereTypeLocationId( (int)$input['typeLocation']  );

		}	

		/*if(isset($input['particularity']) && Helpers::isOk( $input['particularity'] )){

			$locations = $locations->whereHas('particularity', function($query) use($input){

				$query->whereIn('particularity_id', $input['particularity']);

			});

}*/
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

		if(isset($input['classify']) && Helpers::isOk($input['classify'])){

			$locations->orderBy(Helpers::getFilterBy($input['classify']), Helpers::getFilterWay($input['classify']));

		}


		/*$locations = $locations->take(30)->get();

		dd($locations);*/
		$locations = $locations->paginate( $paginate );
		return $locations;
	}
}
