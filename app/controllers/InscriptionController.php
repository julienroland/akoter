<?php

use Carbon\Carbon;

class InscriptionController extends BaseController {

	public function __construct(ImageController $image)   
	{
		$this->ImageController = $image;
	}

	public function index(){

		return View::make('inscription.index', array('page'=>'inscription','widget'=>array('select','validator','geoRegionLocality')));

	}
	public function save(){

		$input = Input::all();

		$validator = Validator::make($input, User::$inscription_rules);

		Session::put('inscription', $input);

		if($validator->passes()){

			$locality_id = (int)Locality::where('name', $input['locality'])->remember(Config::get('var.remember'), 'locality'.$input['locality'])->pluck('id');
			$region_id = (int)Translation::whereKey('name')->where('content_type','Region')->where('value','like','%'. $input['region'] .'%')->remember(Config::get('var.remember'), 'region_translation'.$input['region'])->pluck('content_id');

			$user = new user;

			$user->first_name = ucfirst($input['first_name']);
			$user->name = ucfirst($input['name']);
			$user->civility = $input['civility'];
			if(isset($input['locality']) && Helpers::isOk($input['locality']) && $input['locality'] != 0){
				$user->locality_id = $locality_id;
			}
			if(isset($input['address']) && Helpers::isOk($input['address'])){
				$user->address = $input['address'];
			}
			if(isset($input['region']) && Helpers::isOk($input['region']) && $input['region'] != 0){
				$user->region_id = $region_id;
			}
			if(isset($input['postal']) && Helpers::isOk($input['postal'])){
				$user->postal = $input['postal'];
			}
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->active = 1;
			$user->role_id = 1;
			$user->subscription_id = 1;
			$user->key = Helpers::createEmailKey($input['email']);
			$user->language_id = Config::get('var.langId')[App::getLocale()];
			$user->born = $input['year'].'-'.$input['month'].'-'.$input['day'];

			$user->save();

			if($user){

				Auth::login($user);

				$user->timestamps = false;

				$user->connected_at = Carbon::now();

				$user->save();

				return Redirect::route('account_home', Auth::user()->slug);
			}

		}else{

			return Redirect::route('inscription_index')
			->withInput()
			->withErrors($validator);

		}
		
	}
	public function indexConnection(){

		return View::make('inscription.index', array('page'=>'inscription'));

	}

	/*=========================================
	=            INSCRIPTION OWNER            =
	=========================================*/

	/**
	*
	* Localisation
	*
	**/
	
	public function indexLocalisation( $user_slug, $building = null){

		$regions = Region::getList();

		$localities = Locality::getList();

		if(Helpers::isOk($building)){

			return View::make('inscription.owner.localisation', array('page'=>'inscription_localisation','widget'=>array('validator','select','city_autocomplete')))
			->with(compact('regions','localities','building'));
		}

		return View::make('inscription.owner.localisation', array('page'=>'inscription_localisation','widget'=>array('validator','select','city_autocomplete')))
		->with(compact('regions','localities'));
	}

	public function saveLocalisation($user_slug, $building = null){

		$input = Input::all();

		$validator = Validator::make($input, Building::$inscription_rules);

		Session::put('inscription.localisation_input', $input );

		if( $validator->passes() ){

			$postal_id = Postal::where('start','like', $input['postal'][0].'%')->where('end','>',$input['postal'])->pluck('id');

			$building = new Building;

			$building->latlng = $input['latlng'];
			$building->region_id = $input['region'];
			$building->locality_id = $input['locality'];
			$building->address = $input['address'];
			$building->postal = $input['postal'];
			$building->postal_id = $postal_id;
			$building->number = $input['number'];
			$building->user_id = Auth::user()->id;
			$building->register_step = 1;

			$building->save();

			Session::put('inscription.building_id', $building->id);

			Session::put('inscription.current', 1);

			return Redirect::route('index_types_locations', array(Auth::user()->slug, $building->id))
			->withSuccess(trans('validation.custom.inscription_localisation'));

		}else{

			$fields = $validator->failed();

			return Redirect::route('index_localisation')
			->withInput()
			->withErrors($validator)
			->withFields($fields);

		}
	}
	public function updateLocalisation($user_slug, $building = null){

		$input = Input::all();

		$validator = Validator::make($input, Building::$inscription_rules);

		Session::put('inscription.localisation_input', $input );

		if( $validator->passes() ){

			$postal_id = Postal::where('start','like', $input['postal'][0].'%')->where('end','>',$input['postal'])->pluck('id');

			if(Session::has(Session::get('inscription_building_id'))){

				if(Helpers::isNotOk($building)){

					$building = Building::find(Session::get('inscription.building_id'));

				}

				$building->latlng = $input['latlng'];
				$building->region_id = $input['region'];
				$building->locality_id = $input['locality'];
				$building->address = $input['address'];
				$building->postal = $input['postal'];
				$building->postal_id = $postal_id;
				$building->number = $input['number'];
				$building->register_step = 1;

				$building->save();

				Session::put('inscription.current', 1);

			}

			return Redirect::route('index_types_locations', array(Auth::user()->slug, $building->id))
			->withSuccess(trans('validation.custom.inscription_update_localisation'));

		}else{

			$fields = $validator->failed();

			return Redirect::route('index_localisation')
			->withInput()
			->withErrors($validator)
			->withFields($fields);

		}
	}

	/**
	*
	* Type of location
	*
	**/
	
	public function indexTypesLocations( $user_slug, $building ){

		$typeLocation = TypeLocation::getList(trans('general.none'));
		
		$typesLocations = Location::getLocationByType( $building );

		/*$locations = $building->location()->remember(Config::get('var.remember'), 'building.location'.$building->id )->get();*/

		return View::make('inscription.owner.typeLocation', array('page'=>'inscription','widget'=>array('select')))
		->withSuccess(Session::get('success'))
		->with(compact('typeLocation','building','typesLocations'));
	}

	public function saveTypesLocations( $user_slug, $building ){

		$input = Input::all();

		$typeLocation = array_filter($input['type_location']);

		$typesLocations = Location::getLocationByType( $building );

		$number = array_filter($input['number']);
		
		$specifique = isset($input['global']) ? $input['global'] : null;

		foreach($typeLocation as $key => $type){

			if(isset($number[$key])){

				if($typesLocations[$key]['number'] !== (int)$number[$key]){

					if(Helpers::isOk($typesLocations[$key]['number']) || $typesLocations[$key]['number'] != 0){

						$building->location()->whereTypeLocationId($type)->delete();

					}

					if(isset($specifique[$key]) && Helpers::isOk($specifique)){

						for($i = 1; $i <= (int)$number[$key]; $i++){

							$location  =  new Location;

							if($type = 1){

								$location->nb_room = 1;
								$location->remaining_room = 1;
								$location->nb_locations = 1; 
							}

							$location->type_location_id = $type; 
							$location->building_id = $building->id;
							$location->advert_specific = 1; 

							$location->save();

						}

					}else{

						$location  =  new Location;

						$location->building_id = $building->id;
						$location->type_location_id = $type; 
						$location->advert_specific = 0; 
						$location->nb_locations = $number[$key]; 

						$location->save();
					}
				}
			}
		}

		Cache::forget('building.location'.$building->id);

		$building->location()->remember(Config::get('var.remember'), 'building.location'.$building->id )->get();

		Session::put('inscription.current', 2);

		if( count($typeLocation) > 1 || count($number) > 1 ){

			return Redirect::route('index_inscription_building', array(Auth::user()->slug, $building->id ))
			->withSuccess(trans('validation.custom.inscription_types_locations_multiple'));

		}else{

			return Redirect::route('index_inscription_building',  array(Auth::user()->slug, $building->id ))
			->withSuccess(trans('validation.custom.inscription_types_locations_single'));
		}
	}

	/**
	*
	* Description building
	*
	**/
	
	public function indexBuilding($user_slug, $building){

		$buildingOptionId = TypeOption::name('building')->remember(Config::get('var.remember'), 'typeOption.building.id')->pluck('id');
		
		$options = Option::whereTypeOptionId($buildingOptionId)->with('translation')->get();

		return View::make('inscription.owner.building_description', array('page'=>'inscription','widget'=>array('select','validator')))
		->with(compact('building','options'));
	}

	public function saveBuilding(){

		$input = Input::all();
		dd($input);

	}
	/*-----  End of INSCRIPTION OWNER  ------*/

	/**
	*
	* Register with facebook
	*
	**/
	
	public function facebook( $me , $uid, $facebook){

    	/**
    	*
    	* Civility
    	*
    	**/
    	if($me['gender'] === 'male'){
    		$civility = 0;
    	}
    	else{
    		$civility = 1;
    	}

 		/**
 		*
 		* Locality
 		*
 		**/
 		$locality = explode(',' , $me['location']['name'])[0];
 		$locality_id = Locality::whereName($locality)->first()->id;

		/**
		*
		* Language
		*
		**/
		$language = explode('_' , $me['locale'])[0];
		$language_id = Language::whereShort($language)->first()->id;

		$user = new User;
		$user->first_name = $me['first_name'];
		$user->name = $me['last_name'];;
		$user->email = $me['email'];
		$user->civility = $civility;
		$user->active = 1;
		$user->locality_id = $locality_id;
		$user->role_id = 1;
		$user->subscription_id = 1;
		$user->key = Helpers::createEmailKey($me['email']);
		$user->language_id = $language_id;

		$user->save();

		$photo = $this->ImageController->addUserPhoto( $user->id, 'https://graph.facebook.com/'.$me['username'].'/picture?type=large' );

		if(Helpers::isOk( $photo )){

			$user->photo = $photo;

		}

		$user->save();
		

		$profile = new Profile();
		$profile->uid = $uid;
		$profile->verified = $me['verified'];
		$profile->username = $me['username'];
		$profile = $user->profiles()->save($profile);

		$profile->access_token = $facebook->getAccessToken();
		$profile->save();

		$user = $profile->user;

		return $user;
	}
	public function activation( $key ){

		/**
		*
		* Check if key exist as param
		*
		**/
		if(Helpers::isOk( $key )){

			/**
			*
			* Find unique key
			*
			**/
			$userActive = User::whereKey( $key )->firstOrFail();

			if( $userActive ){

				/**
				*
				* if user not already check his email
				*
				**/
				if(!$userActive->email_comfirm){

					$user = User::find($userActive->id);

					if($user){

						$user->email_comfirm = true;

						$user->save();

					}
				}
				else{
					return View::make('account.activation', array('page'=>'activation'))
					->with(array(
						'validation'=>false,
						'message'=> trans('validation.custom.account_already_active')
						));
				}
				/**
				*
				* Retourne la vue avec le bon message
				*
				**/
				return View::make('account.activation', array('page'=>'activation'))
				->with(array(
					'validation'=>true,
					'user'=> $user
					));
			}
			else
			{
				return View::make('account.activation', array('page'=>'activation'))
				->with('validation',false);
			}

		}
		else
		{
			return View::make('account.activation', array('page'=>'activation'))
			->with(array('validation'=> false,
				'message'=>trans('validation.custom.key_invalid')));
		}
	}
}