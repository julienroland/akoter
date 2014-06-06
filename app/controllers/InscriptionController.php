<?php

use Carbon\Carbon;

class InscriptionController extends AccountBaseController {

	public function __construct(ImageController $image)   
	{
		$this->ImageController = $image;
		
		if(Auth::check()){
			View::share(array(
				'request'=>$this->nb_request(),
				'personnal'=>$this->personnalComplete()
				));
		}
	}

	public function index(){
		$cgu = Post::whereId(4)->with(array('translation'=>function($query){
			$query->whereKey('slug');
		}))->first();

		return View::make('inscription.index', array(
			'title'=>trans('title.register'),
			'description'=>trans('description.register'),
			'page'=>'inscription',
			'widget'=>array('select','validator','geoRegionLocality')))
		->withCgu($cgu);

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
	
	public function indexLocalisation( $user_slug, $building = null, $currentLocation=null){

		$regions = Region::getList();

		$localities = Locality::getList();

		if(Helpers::isOk($building)){

			return View::make('inscription.owner.localisation', array('page'=>'inscription_localisation','widget'=>array('validator','select','city_autocomplete')))
			->with(compact('regions','localities','building','currentLocation'));
		}

		return View::make('inscription.owner.localisation', array('page'=>'inscription_localisation','widget'=>array('validator','select','city_autocomplete')))
		->with(compact('regions','localities','currentLocation'));
	}

	public function saveLocalisation($user_slug, $building = null, $currentLocation=null){

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

			$user = Auth::user();
			$user->isOwner = 1;
			$user->save();
			
			Session::put('inscription.building_id', $building->id);

			Session::put('inscription.current', 1);

			return Redirect::route('index_types_locations', array(Auth::user()->slug, $building->id, Helpers::isOk($currentLocation) ? $currentLocation->id : ''))
			->withSuccess(trans('validation.custom.inscription_localisation'));

		}else{

			$fields = $validator->failed();

			return Redirect::route('index_localisation')
			->withInput()
			->withErrors($validator)
			->withFields($fields);

		}
	}
	public function updateLocalisation($user_slug, $building = null, $currentLocation=null){

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

				$building->save();

				Session::put('inscription.current', 1);

			}

			return Redirect::route('index_types_locations', array(Auth::user()->slug, $building->id, Helpers::isOk($currentLocation) ? $currentLocation->id : ''))
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
	
	public function indexTypesLocations( $user_slug, $building , $currentLocation=null){

		$typeLocation = TypeLocation::getList(trans('general.none'));
		
		$typesLocations = Location::getLocationByType( $building );

		/*$locations = $building->location()->remember(Config::get('var.remember'), 'building.location'.$building->id )->get();*/

		return View::make('inscription.owner.typeLocation', array('page'=>'inscription','widget'=>array('select')))
		->withSuccess(Session::get('success'))
		->with(compact('typeLocation','building','typesLocations','currentLocation'));
	}

	public function saveTypesLocations( $user_slug, $building ,$currentLocation=null){

		$input = Input::all();

		$typeLocation = array_filter($input['type_location']);

		$typesLocations = Location::getLocationByType( $building );

		$number = array_filter($input['number']);
		
		$specifique = isset($input['global']) ? $input['global'] : null;

		if(count(array_filter($input['number'])) == 0 ){

			return Redirect::back()
			->withErrors(array(trans('inscription.no_typeLocation')));
		}

		foreach($typeLocation as $key => $type){

			if(isset($number[$key])){

				if((int)$typesLocations[$key]['number'] !== (int)$number[$key]){

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
								$location->remaining_location = 1; 
							}

							$location->type_location_id = $type; 
							$location->building_id = $building->id;
							$location->advert_specific = 1;
							$location->available = 1; 

							$location->save();

						}

					}else{

						$location  =  new Location;

						$location->building_id = $building->id;
						$location->type_location_id = $type; 
						$location->advert_specific = 0; 
						$location->nb_locations = $number[$key]; 
						$location->remaining_location = $number[$key]; 
						$location->available = 1;

						$location->save();
					}

					$building->register_step = $building->register_step < 2 ? 2 : $building->register_step;
					$building->save();

					Session::put('inscription.current', 2);
				}
			}
		}

		Cache::forget('building.location'.$building->id);

		$building->location()->remember(Config::get('var.remember'), 'building.location'.$building->id )->get();

		Session::put('inscription.current', 2);

		if( count($typeLocation) > 1 || count($number) > 1 ){

			return Redirect::route('index_inscription_building', array(Auth::user()->slug, $building->id, Helpers::isOk($currentLocation) ? $currentLocation->id : '' ))
			->withSuccess(trans('validation.custom.inscription_types_locations_multiple'));

		}else{

			return Redirect::route('index_inscription_building',  array(Auth::user()->slug, $building->id, Helpers::isOk($currentLocation) ? $currentLocation->id : '' ))
			->withSuccess(trans('validation.custom.inscription_types_locations_single'));
		}
	}

	/**
	*
	* Description building
	*
	**/
	
	public function indexBuilding($user_slug, $building, $currentLocation = null){

		$optionId = TypeOption::name('building')->remember(Config::get('var.remember'), 'typeOption.building.id')->pluck('id');

		$options = Option::whereTypeOptionId($optionId)->with('translation')->get();

		$currentOptions = $building->option()->lists('value','option_id');

		if(count($currentOptions) > 0){

			return View::make('inscription.owner.building_description', array('page'=>'inscription'))
			->with(compact('building','options','currentOptions','currentLocation'));

		}else{

			return View::make('inscription.owner.building_description', array('page'=>'inscription'))
			->with(compact('building','options','currentLocation'));
		}
	}

	public function saveBuilding($user_slug, $building, $currentLocation = null){

		$input = Input::get('building');

		if(Helpers::isOk($input)){

			foreach( $input as $key => $value ){

				$building->option()->attach($key);

			}

		}

		$building->register_step = $building->register_step < 3 ? 3 :$building->register_step;
		$building->save();
		Session::put('inscription.current', 3);

		return Redirect::route('index_inscription_general', array(Auth::user()->slug, $building->id ))
		->withSuccess(trans('validation.custom.inscription_description_batiment'));

	}

	public function updateBuilding($user_slug, $building, $currentLocation = null){

		$input = Input::get('building');

		if(Helpers::isOk($input)){

			$building->option()->detach( );

			foreach( $input as $key => $value ){

				$building->option()->attach($key);

			}
		}

		return Redirect::route('index_inscription_general', array(Auth::user()->slug, $building->id ))
		->withSuccess(trans('validation.custom.inscription_description_batiment'));

	}

	/**
	*
	* Informations général
	*
	**/


	public function indexInfosGeneral( $user_slug, $building , $currentLocation = null){
		


		$optionId = TypeOption::name('infos')->remember(Config::get('var.remember'), 'typeOption.infos.id')->pluck('id');

		$options = Option::whereTypeOptionId($optionId)->with('translation')->get();

		$situations = $building->translations()->whereKey('situations')->get();

		$adverts = $building->translations()->whereKey('advert')->get();

		return View::make('inscription.owner.infos_general', array('page'=>'inscription','widget'=>array('validator','ui','tabs','editor')))
		->with(compact('building','options','situations','adverts','currentLocation'));

	}

	public function saveInfosGeneral( $user_slug, $building , $currentLocation = null){

		$input = Input::all();

		$validator = Validator::make($input, Building::$infos_general_rules);

		Session::put('inscription.infos_general', $input );
		
		if( $validator->passes()){

			$situations = array_filter($input['situations']);
			$adverts = array_filter($input['advert']);

			$situation = reset($situations);
			$fromSituation = key($situations);	

			$advert = reset($adverts);
			$fromAdvert = key($adverts);

			if(Helpers::isOk(array_filter($input['situations']))){

				foreach($input['situations'] as $key => $text){

					if(Helpers::isOk($text)){

						if(Helpers::isNotOk(Translation::whereContentType('building')->whereContentId($building->id)->whereKey('situations')->whereLanguageId(Config::get('var.langId')[$key])->first())){

							$translation = new Translation;
						}
						else{

							$translation = Translation::whereContentType('building')->whereContentId($building->id)->whereKey('situations')->whereLanguageId(Config::get('var.langId')[$key])->first();
						}

						$translation->content_type = "Building";
						$translation->content_id = $building->id;
						$translation->key = 'situations';
						$translation->value = ucfirst($text);
						$translation->language_id = Config::get('var.langId')[$key];

					}else{

						if(Helpers::isNotOk(Translation::whereContentType('building')->whereContentId($building->id)->whereKey('situations')->whereLanguageId(Config::get('var.langId')[$key])->first())){

							$translation = new Translation;

						}else{

							$translation = Translation::whereContentType('building')->whereContentId($building->id)->whereKey('situations')->whereLanguageId(Config::get('var.langId')[$key])->first();
						}

						$translation->content_type = "Building";
						$translation->content_id = $building->id;
						$translation->key = 'situations';
						$translation->value = ucfirst(Helpers::translate($situation, $fromSituation, $key));
						$translation->language_id = Config::get('var.langId')[$key];
					}

					$translation->save();
				}
			}
			if(Helpers::isOk(array_filter($input['advert']))){

				foreach($input['advert'] as $key => $text){

					if(Helpers::isOk($text)){

						if(Helpers::isNotOk(Translation::whereContentType('building')->whereContentId($building->id)->whereKey('advert')->whereLanguageId(Config::get('var.langId')[$key])->first())){

							$translation = new Translation;
						}
						else{

							$translation = Translation::whereContentType('building')->whereContentId($building->id)->whereKey('advert')->whereLanguageId(Config::get('var.langId')[$key])->first();
						}

						$translation->content_type = "Building";
						$translation->content_id = $building->id;
						$translation->key = 'advert';
						$translation->value = ucfirst($text);
						$translation->language_id = Config::get('var.langId')[$key];

					}else{

						if(Helpers::isNotOk(Translation::whereContentType('building')->whereContentId($building->id)->whereKey('advert')->whereLanguageId(Config::get('var.langId')[$key])->first())){

							$translation = new Translation;

						}else{

							$translation = Translation::whereContentType('building')->whereContentId($building->id)->whereKey('advert')->whereLanguageId(Config::get('var.langId')[$key])->first();
						}

						$translation->content_type = "Building";
						$translation->content_id = $building->id;
						$translation->key = 'advert';
						$translation->value = ucfirst(Helpers::translate($advert, $fromAdvert, $key));
						$translation->language_id = Config::get('var.langId')[$key];
					}

					$translation->save();
				}
			}

			$building->register_step = $building->register_step < 4 ? 4 : $building->register_step;
			$building->save();

			Session::put('inscription.current', 4);

			return Redirect::route('index_photo_building', array(Auth::user()->slug, $building->id ))
			->withSuccess(trans('validation.custom.inscription_infos_general'));

		}else{

			return Redirect::back()
			->withInput()
			->withErrors($validator);
		}

	}

	public function indexPhotoBuilding($user_slug, $building, $currentLocation = null){

		$photos = $building->photo()->orderBy('order')->get()->groupBy('type');

		return View::make('inscription.owner.photo_building', array('page'=>'inscription','widget'=>array('upload','ui','sort')))
		->with(compact('building','photos','currentLocation'));
	}

	public function indexAdverts($user_slug, $building, $currentLocation = null){

		$locations = $building->location()->with(array('typeLocation.translation'))->get();

		$locationsData = $building->location()->with(array('option','translations'=>function($query){
			$query->whereIn('key', array('title','advert'));
		}
		,'particularity'))->get()->groupBy('id');

		$options = Option::whereTypeOptionId(3)->with('translation')->get();

		$particularities = particularity::with('translation')->get();

		$agency = User::agenceList();
		
		return View::make('inscription.owner.adverts', array('page'=>'inscription','widget'=>array('ui','tabs','editor','datepicker','select')))
		->with(compact('building','locations','options','particularities','locationsData','agency','currentLocation'));
	}

	public function saveAdverts( $user_slug, $building, $currentLocation = null ){

		$inputs = Input::except('_token');

		Session::put('adverts', $inputs);

		foreach($inputs as $keyInput => $input){

			$validator = Validator::make($input, Location::$rules);

			Helpers::attr( $validator );

			if( $validator->passes() ){

				$location_id = (int)explode('_',$keyInput)[1];

				$location = Location::find($location_id);
				if(isset($input['agency'])){
					$location->agence_id = $input['agency'];	
				}
				$location->price = $input['price'];
				$location->size = $input['size'];
				$location->floor = $input['floor'];
				$location->nb_room = $input['room'];
				$location->garantee = $input['garantee'];
				$location->remaining_room = $input['room'];
				$location->available = isset($input['available']) ? 1 : 0;
				$location->charge_price = $input['chargePrice'];
				$location->start_date = Helpers::dateNaForm($input['start_date']);
				$location->end_date = Helpers::dateNaForm($input['end_date']);
				$location->comments_status = isset($input['comments']) ? 1 : 0;
				$location->charge_type = isset($input['charge']) ? $input['charge'] : 0;
				$location->accessible = isset($input['accessible']) ? 1 : 0;
				$location->register_step = $location->register_step < 6 ? 6 : $location->register_step;
				
				if(isset($input['option']) && Helpers::isOk($input['option'])){

					$location->option()->detach();
					

					foreach($input['option'] as $key => $option){

						$location->option()->attach($key);
					}
				}
				if(isset($input['particularity']) && Helpers::isOk($input['particularity'])){

					$location->particularity()->detach();
					

					foreach($input['particularity'] as $key => $particularity){

						$location->particularity()->attach($key);
					}
				}
				$titles = array_filter($input['title']);


				$title = reset($titles);
				$fromTitle = key($titles);

				foreach($input['title'] as $key => $text){

					if(Helpers::isOk($text)){

						if(Helpers::isNotOk(Translation::whereContentId($location_id)->whereContentType('Location')->whereKey('title')->whereLanguageId(Config::get('var.langId')[$key])->first())){

							$translation = new Translation;
						}
						else{

							$translation = Translation::whereContentId($location_id)->whereContentType('Location')->whereKey('title')->whereLanguageId(Config::get('var.langId')[$key])->first();
						}

						$translation->content_type = "Location";
						$translation->content_id = $location_id;
						$translation->key = 'title';
						$translation->value = ucfirst($text);
						$translation->language_id = Config::get('var.langId')[$key];

					}else{

						if(Helpers::isNotOk(Translation::whereContentId($location_id)->whereContentType('Location')->whereKey('title')->whereLanguageId(Config::get('var.langId')[$key])->first())){

							$translation = new Translation;
						}
						else{

							$translation = Translation::whereContentId($location_id)->whereContentType('Location')->whereKey('title')->whereLanguageId(Config::get('var.langId')[$key])->first();
						}

						$translation->content_type = "Location";
						$translation->content_id = $location_id;
						$translation->key = 'title';
						$translation->value = ucfirst(Helpers::translate($title, $fromTitle, $key));
						$translation->language_id = Config::get('var.langId')[$key];
					}

					$translation->save();
				}

				$adverts = array_filter($input['advert']);

				$advert = reset($adverts);

				$fromAdvert = key($adverts);

				foreach($input['advert'] as $key => $text){

					if(Helpers::isOk($text)){

						if(Helpers::isNotOk(Translation::whereContentId($location_id)->whereContentType('Location')->whereKey('advert')->whereLanguageId(Config::get('var.langId')[$key])->first())){

							$translation = new Translation;
						}
						else{

							$translation = Translation::whereContentId($location_id)->whereContentType('Location')->whereKey('advert')->whereLanguageId(Config::get('var.langId')[$key])->first();
						}

						$translation->content_type = "Location";
						$translation->content_id = $location_id;
						$translation->key = 'advert';
						$translation->value = ucfirst($text);
						$translation->language_id = Config::get('var.langId')[$key];

					}else{

						if(Helpers::isNotOk(Translation::whereContentId($location_id)->whereContentType('Location')->whereKey('advert')->whereLanguageId(Config::get('var.langId')[$key])->first())){

							$translation = new Translation;
						}
						else{

							$translation = Translation::whereContentId($location_id)->whereContentType('Location')->whereKey('advert')->whereLanguageId(Config::get('var.langId')[$key])->first();
						}
						$translation->content_type = "Location";
						$translation->content_id = $location_id;
						$translation->key = 'advert';
						$translation->value = Helpers::translate($advert, null, $key);
						$translation->language_id = Config::get('var.langId')[$key];
					}

					$translation->save();
				}

				$location->save();

				foreach(Config::get('var.langId') as $lang => $langId){

					$title = $location->translations()->whereLanguageId($langId)->whereKey('title')->pluck('value');
					$price = round($location->price).'-euros';
					$typeLocation = $location->typeLocation->translations()->whereLanguageId($langId)->pluck('value');
					$region = $location->building->region->translations()->whereLanguageId($langId)->pluck('value');
					$locality = $location->building->locality->pluck('name');

					$slug = Str::slug($typeLocation.' '.$region.' '.$locality.' '.$price.' '.$title.' '.$location->id);

					$slug_translation  = Translation::whereContentId($location_id)->whereContentType('Location')->whereKey('slug')->whereLanguageId($langId)->first();

					if(Helpers::isOk($slug_translation)){

						$slug_translation->value = $slug;

					}else{
						$slug_translation = new Translation;
						$slug_translation->value = $slug;
						$slug_translation->key = 'slug';
						$slug_translation->content_id = $location->id;
						$slug_translation->content_type = 'Location';
						$slug_translation->language_id = $langId;
					}

					$slug_translation->save(); 
				}



			}else{

				$fields = $validator->failed();

				return Redirect::back()
				->withInput($inputs)
				->withFields($fields)
				->withErrors($validator);
			}
		}
		
		$building->register_step = $building->register_step < 6 ? 6 : $building->register_step;
		$building->save();

		Session::put('inscription.current', 6);

		return Redirect::route('index_photo_advert', array(Auth::user()->slug, $building->id, Helpers::isOk($currentLocation) ? $currentLocation->id : '' ))
		->withSuccess(trans('validation.custom.inscription_adverts'));
	}

	public function indexPhotoAdvert($user_slug, $building , $currentLocation = null){

		$locations = $building->location()->with(array('typeLocation.translation'))->get();

		$photos = $building->location()->with(array('photo'=>function($query){
			$query->orderBy('order');
		}))->get()->groupBy('id');

		return View::make('inscription.owner.photo_advert', array('page'=>'inscription','widget'=>array('upload','ui','sort','tabs')))
		->with(compact('building','locations','photos','currentLocation'));

	}

	public function indexContact( $user_slug, $building){

		$regions = Region::getList();
		$localities = Locality::getList();

		return View::make('inscription.owner.contact',array('page'=>'inscription','widget'=>array('select','validator')))
		->with(compact('building','localities','regions'));


	}

	public function saveContact($user_slug, $building){

		$input = Input::all();

		User::$contact_rules['email'] = 'unique:users,email,'. Auth::user()->id .'| required | email ';

		$validator = Validator::make($input,User::$contact_rules);

		if($validator->passes()){

			$user = Auth::user();

			$user->name = $input['name'];
			$user->first_name = $input['first_name'];
			$user->email = $input['email'];
			$user->region_id = $input['region'];
			$user->locality_id = $input['locality'];
			$user->address = $input['address'];
			$user->postal = $input['postal'];
			$user->phone = $input['phone'];

			$user->save();

			$building->register_step = 8;
			$building->save();

			return Redirect::route('index_validate_inscription_owner', array(Auth::user()->slug , $building->id))
			->withSuccess(trans('validation.custom.success_inscription_steps'));

		}else{

			$fields = $validator->failed();

			return Redirect::back()
			->withInput()
			->withErrors($validator)
			->withFields($fields);
		}

	}

	public function indexComfirm( $user_slug, $building){

		return View::make('inscription.owner.comfirm', array('page'=>'inscription'))
		->with(compact('building'));
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