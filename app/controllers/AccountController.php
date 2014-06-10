<?php

use Carbon\Carbon;

class AccountController extends AccountBaseController {

	public function __construct( )
	{
		
		View::share(array(
			'request'=>$this->nb_request(),
			'personnal'=>$this->personnalComplete(),
			));
	}

	public function index(){

		/*$currentLocation = $user->currentLocation()->first();*/

		if(Auth::user()->isOwner == 1){

			$activeLocations = User::getActiveLocations( Auth::user() );

			$waitingLocations = User::getWaitingLocations( Auth::user() );

			$invalidLocations = User::getInvalidLocations( Auth::user() );

			return View::make('account.index', array('page'=>'account'))
			->with(compact(array('activeLocations','waitingLocations','invalidLocations','inactiveBuilding','numberRequest')));

		}
		/*$notices = Notice::valid()*/
		return View::make('account.index', array('page'=>'account'));

	}
	public function indexFavoris(){

		$favorisList = Auth::user()->favoris()->lists('location_id');

		if(count($favorisList) <= 0){

			$favorisList = array('');
		}

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
		->whereIn( 'locations.id', $favorisList)
		->distinct('building')
		->get( );

		return View::make('account.favoris', array('page'=>'bookmark','widget'=>array('grid')))
		->with(compact('locations'));
	}
	public function indexAdverts(){

		if(Auth::user()->isOwner == 1){

			$activeLocations = User::getActiveLocations( Auth::user() );

			$waitingLocations = User::getWaitingLocations( Auth::user() );

			$invalidLocations = User::getInvalidLocations( Auth::user() );


			return View::make('account.index', array('page'=>'account'))
			->with(compact(array('activeLocations','waitingLocations','invalidLocations','inactiveBuilding','numberRequest')));

		}


		return View::make('account.index', array('page'=>'account'));
	}
	public function personnalData(){

		$user = User::with(array(
			'region'=>Helpers::cacheEager('user_region'.Auth::user()->id),
			'region.translation'=>Helpers::cacheEager( 'user_region_trad'.Auth::user()->id ),
			'locality'=>Helpers::cacheEager('user_locality'.Auth::user()->id)))
		->whereId(Auth::user()->id)
		->remember(Config::get('var.remember'), 'user'.Auth::user()->id)
		->first();

		$regionList = Region::getList();
		$localityList = Locality::getList();

		return View::make('account.personnals',array('page'=>'account', 'widget'=>array('city_autocomplete','validator','select')))
		->with(compact('user','localityList','regionList'));
	}

	public function savePersonnalData(){

		$input = Input::all();

		User::$personnals_rules['email'] = 'unique:users,email,'. Auth::user()->id .'| required | email |not_in:null';

		$validator = Validator::make($input, User::$personnals_rules);

		Session::put('account_personnal', $input);

		if($validator->passes()){

			$user = Auth::user();

			$user->first_name = $input['first_name'];
			$user->name = $input['name'];
			$user->civility = $input['civility'];
			$user->email = $input['email'];
			$user->email_bc = $input['email_bc'];
			$user->phone = $input['phone'];
			$user->pro = isset($input['pro']) ? $input['pro'] : 0;
			$user->address = $input['address'];
			$user->postal = $input['postal'];
			$user->first_name = $input['first_name'];
			$user->region_id = $input['region'];
			$user->locality_id =  $input['locality'];

			$user->save();

			Session::forget('account-personnal');

			Cache::forget('user'.$user->id);
			Cache::forget('user_region'.$user->id);
			Cache::forget('user_region_trad'.$user->id);
			Cache::forget('user_locality'.$user->id);

			if( Input::has('from') ){

				if( Input::get('from') == 'p'){

					return Redirect::route('index_localisation_building', Auth::user()->slug);

				}else{

				}
			}
			return Redirect::route('account_home', Auth::user()->slug);


		}else{

			$field = $validator->failed();

			return Redirect::route('account_personnal',Auth::user()->slug)
			->with(compact('field'))
			->withInput()
			->withErrors($validator);

		}
	}

	public function params(){

		$user = User::find(Auth::user()->id);

		return View::make('account.params',array('page'=>'account','widget'=>array('validator','select')))
		->with(compact('user'));

	}

	public function saveParams(){

		$input = Input::all();

		User::$params_rules['email'] = 'unique:users,email,'. Auth::user()->id .'| required | email |not_in:null';
		User::$params_rules['password'] = '';
		User::$params_rules['password_ck'] = 'same:password';

		Session::put('account_params', $input);

		$validator = Validator::make($input, User::$params_rules);

		if($validator->passes()){

			$language_id = Language::whereShort( $input['language'])->pluck('id');
			$user = Auth::user();

			$user->email = $input['email'];
			$user->language_id = $language_id;

			if( Helpers::isOk($input['password']) || Helpers::isOk($input['password_ck']) ){

				$user->password = Hash::make($input['password']);

			}

			$user->save();

			Session::forget('account_params');

			return Redirect::route('account_home', Auth::user()->slug);

		}else{

			$field = $validator->failed();

			return Redirect::route('account_params', Auth::user()->slug)
			->with(compact('field'))
			->withInput()
			->withErrors($validator);

		}
	}

	public function suspend(){

		if(Auth::user()->suspend == 0){

			$user = Auth::user();

			$user->suspend = 1;

			$user->save();

			Cache::forget('user'.Auth::user()->id);

			Auth::logout();

			return Redirect::route('home');

		}else{

			return Redirect::intended(route('account-params', Auth::user()->slug));

		}
	}

	public function  indexReactive(){

		$user = Session::get('user_reactive');

		Session::forget('user_reactive');

		return View::make('account.reactive',array('page'=>'reactive'))
		->with(compact('user'));
	}

	public function reactive( $slug, $id ){

		$user = User::find($id);
		$user->suspend = 0;
		$user->save();

		Auth::login($user);

		return Redirect::route('account_home', Auth::user()->slug);
	}

	public function delete(){

		if(Auth::user()->delete == 0){

			$user = Auth::user();

			$user->delete = 1;
			$user->deleted_at = Carbon::now();

			$user->save();

			Cache::forget('user'.Auth::user()->id);

			Auth::logout();

			return Redirect::route('home');

		}else{

			return Redirect::intended(route('account-params', Auth::user()->slug));

		}
	}


	public function indexUndelete(){

		$user = Session::get('user_delete');

		Session::forget('user_reactive');

		return View::make('account.undelete',array('page'=>'undelete'))
		->with(compact('user'));
	}

	public function undelete( $slug, $id ){

		$user = User::find($id);
		$user->delete = 0;
		$user->save();

		Auth::login($user);

		return Redirect::route('account_home', Auth::user()->slug);
	}

	public function how_be_owner( ){

		$personnal = array(
			'first_name' => Auth::user()->first_name,
			'name' => Auth::user()->name,
			'email' => Auth::user()->email,
			'civility' => Auth::user()->civility,
			'address' => Auth::user()->address,
			'region' => Auth::user()->region_id,
			'locality' => Auth::user()->locality_id,
			'phone' => Auth::user()->phone,
			'postal' => Auth::user()->postal,

			);

		$personnalNotComplete = User::personnalsRequiredNotComplete( $personnal );

		return View::make('account.owner.how_be', array('page'=>'account'))
		->with(compact('personnalNotComplete'));
	}

	public function editPhoto(){

		return View::make('account.photo',array('page'=>'photo'));
	}

	public function howBeTenant(){

		return View::make('account.tenant.how_be', array('page'=>'account'));
	}

	public function indexRequest($user_slug){

		$requests = Auth::user()->building()->with(array('location.request','location.translation'=>function($query){
			$query->whereKey('title');
		}))->get();

		return View::make('account.owner.request', array('page'=>'account'))
		->withRequests($requests);
	}

	public function validRequest( $user_slug, $id_request){

		$request = UserLocation::findOrFail($id_request);
		$location = Location::findOrFail($request->location_id);

		if($location->remaining_location == 0 && $location->remaining_room == 0){

			return Redirect::back()
			->withError(trans('account.locationFull'));
		}
		$request->request = 0;
		$request->status = 1;
		$request->save();

		if($location->remaining_room != 0){

			$location->remaining_room -= $request->seat;

		}

		$location->save();

		if($location->remaining_room == 0 && $location->remaining_location != 0){

			$location->remaining_location -= $request->nb_locations;
			$location->remaining_room = $location->nb_room; 
		}
		
		$location->save();


		return Redirect::back()
		->withSuccess(trans('validation.custom.requestValidate'));
	}

	public function refuseRequest( $user_slug, $id_request){

		$request = UserLocation::findOrFail($id_request);
		$location = Location::findOrFail($request->location_id);

		$request->delete();

		return Redirect::back()
		->withSuccess(trans('validation.custom.rejectValidation'));
	}

	public function requestValidation( ){

		Mailgun::send('emails.requestValidation', array('user'=>Auth::user()), function($message){

			$message->to(Config::get('mailgun::from')['address'], Config::get('mailgun::from')['name'])
			->subject('Demande d\'avancement pour la validation du compte');
		});

		return Redirect::back()
		->withSuccess(trans('inscription.how_be.requestSend'));
	}
}