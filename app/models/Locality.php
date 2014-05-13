<?php

class Locality extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	public function building()
	{
		return $this->hasMany('Building');
	}

	public function user()
	{
		return $this->hasMany('User');
	}

	public function school()
	{
		return $this->hasMany('School');
	}

	public function agence(){

		return $this->hasMany('Agence');
	}

	public static function getList(){

		$dataDump = Locality::orderBy('name','asc')->remember(Config::get('var.remember'), 'locality')->get();

		$datas = array(
			'data'=>array(
				''=>'',
				),
			);

		foreach( $dataDump as $data){

			$datas['data'][$data->id] = $data->name;
		}
		

		return (object)$datas;
	}

	public static function getLocationsList( $where , $nb_obj = 12, $orderBy = 'created_at'  , $orderWay = 'asc' , $lang_id = null ){
		
		if(Helpers::isNotOk( $lang_id )){

			$lang_id = Helpers::getLangId(Session::get('langId'));
		}

		if(Helpers::isOk( $where )){

			$ex = explode( '=', $where );

			$whereKey = $ex[0];

			$whereValue = $ex[1];

		}else{

			$whereKey = null;

			$whereValue = null;
		}	

		$localityDump = Locality::with(array(
			'building.user',
			'building.location' => function($query){
				$query
				->where( Config::get( 'var.l_validateCol' ) , 1 )
				->where( Config::get( 'var.l_availableCol' ) , 1 )
				->where( Config::get( 'var.l_placesCol' ) ,'>', 0 );
			},
			'building.location.particularity.translation' => function( $query ) use ( $lang_id ){
				$query->where(Config::get('var.t_langCol'), $lang_id);
			},
			'building.location.typeLocation.translation',
			'building.location.photo',
			'building.region.translation' => function( $query ) use ( $lang_id ){
				$query->where(Config::get('var.t_langCol'), $lang_id);
			},
			'building.location.translation'=> function($query) use($lang_id){
				$query
				->where(Config::get('var.t_langCol'), $lang_id);
			},

			))
		->where( $whereKey , 'Evere' )
		->orderBy( $orderBy , $orderWay )
		->take( $nb_obj )
		->get();


		/*

		id, title, short_description, size, price, type_location, nb_room, nb_remaining, region, available, start date, charge_type, charge price, end date

		*/
		$dataLocations = array(
			'data' => array(),
			);
		$data = array();
		if(Helpers::isOk($localityDump)) //no errors or errors
		{


			foreach($localityDump as $locality)
			{
				/*dd($locality);	*/
				if(Helpers::isOk($locality->building[0]->location[0]->translation) && Helpers::isOk($locality->building)){


					foreach($locality->building[0]->location[0]->translation as $translation){

						$data[Config::get('var.p_location').$translation->key] = $translation->value;

					}
					$data[Config::get('var.p_particularity').'id'] = array();
					$data[Config::get('var.p_particularity').'value'] = array();

					foreach($locality->building[0]->location[0]->particularity as $particularity){

						array_push($data[Config::get('var.p_particularity').'value'] , $particularity->translation[0]->value);
						array_push($data[Config::get('var.p_particularity').'id'] , $particularity->translation[0]->content_id);
					}

					$data['id'] = $locality->building[0]->location[0]->id;
					$data['photo'] = $locality->building[0]->location[0]->photo; //$locality->photo->data
					$data['price'] = $locality->building[0]->location[0]->price;
					$data['street'] = $locality->building[0]->street;
					$data['nb_room'] = $locality->building[0]->location[0]->nb_room;
					$data['remaining_room'] = $locality->building[0]->location[0]->remaining_room;
					$data['available'] = $locality->building[0]->location[0]->available;
					$data['start_date'] = $locality->building[0]->location[0]->start_date;
					$data['charge_type'] = $locality->building[0]->location[0]->charge_type;
					$data['charge_price'] = $locality->building[0]->location[0]->charge_price;
					$data['validate'] = $locality->building[0]->location[0]->validate;
					$data['rating'] = $locality->building[0]->location[0]->rating;
					$data['MaxRating'] = '10';
					$data['nb_rate'] = $locality->building[0]->location[0]->nb_rate;
					$data['type_location_id'] = $locality->building[0]->location[0]->type_location_id;
					$data['building_id'] = $locality->building[0]->location[0]->building_id;
					$data['created_at'] = $locality->building[0]->location[0]->created_at->toDateString();
					$data['latLng'] = $locality->building[0]->latlng;
					$data['region'] = $locality->building[0]->region->translation[0]->value;
					$data['region_id'] = $locality->building[0]->region->id;
					$data['locality_id'] = $locality->building[0]->locality->id;
					$data['locality_name'] = $locality->building[0]->locality->name;
					$data['locality_postal'] = $locality->building[0]->locality->postal;
					$data['user_id'] = $locality->building[0]->user->id;
					$data['user_email'] = $locality->building[0]->user->email;
					$data['typeLocation_id'] = $locality->building[0]->location[0]->typeLocation->id;
					$data['typeLocation'] = $locality->building[0]->location[0]->typeLocation->translation[0]->value;

					array_push($dataLocations['data'], (object)$data);
				}
			}

			$dataLocations['count'] =  count($locality) ;
			return (object)$dataLocations;

		}else{

			return (object)array(
				'errors'=> Lang::get('errors.l_noLocation'),
				'date'=> Carbon::now()->toDateTimeString(),
				);
		}
	}
	public static function getLocationAutocomplete(  ){

		$autocompleteDump = Locality::with(array('building'=> function($query){
			$query->whereStatusType('1');
		},
		'building.location' => function( $query ){
			$query
			->whereAvailable('1')
			->whereValidate('1');
		}))
		->get();

		$dataAutocomplete = array(
			'data'=>array(), 
			'toJson'=>new StdClass,
			);

		if(Helpers::isOk( $autocompleteDump )){
			
			foreach($autocompleteDump as $autocomplete){

				$dataAutocomplete['data'][$autocomplete->id] = array('locality'=>$autocomplete->name, 'count'=>0);

				foreach($autocomplete->building as $building){

					$dataAutocomplete['data'][$autocomplete->id]['count'] = count($building->location);	
				}
				
			}
		}
		
		$dataAutocomplete['toJson'] = json_encode($dataAutocomplete['data']);
		
		return (object)$dataAutocomplete;

	}
}
