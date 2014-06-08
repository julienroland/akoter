<?php 
/**
* 
*/
class AgenceController extends BaseController
{
	public function __construct(ImageController $image){

		$this->image = $image;
		if(Auth::check()){
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

			$this->request = User::getNumberRequest(Auth::user());
			$this->personnal = User::personnalsRequiredNotComplete( $personnal );

			View::share(array(
				'request'=>$this->request,
				'personnal'=>$this->personnal
				));
		}
	}
	public function indexJoin( $user_slug ){

		return View::make('agence.join', array('page'=>'agence'));

	}

	public function update($user_slug, $agence){

		$input = Input::all();
		Agence::$rules_update['login']  = 'required | unique:agences,login,'.$agence->id;
		$validator  = Validator::make($input, Agence::$rules_update);

		if($validator->passes()){

			$agence->name = ucfirst($input['name']);
			$agence->login = $input['login'];

			if(Helpers::isOk($input['password'])){

				$agence->password = Hash::make($input['password']);
			}

			$agence->created = $input['year'].'-'.$input['month'].'-'.$input['day'];
			$agence->language_id = Config::get('var.langId')[$input['language']];
			$agence->user_id = Auth::user()->id;
			$agence->address = $input['address'];
			$agence->locality_id = Locality::where('name','like', $input['locality'])->pluck('id');
			$agence->region_id = Translation::whereContentType('Region')->whereKey('name')->where('value','like', $input['region'])->pluck('content_id');
			$agence->postal = $input['postal'];
			$agence->validate = 1;
			$agence->visible = 1;

			if(Input::hasFile('logo')){

				$agence->logo = $this->image->updateLogoAgence( $agence );
			}

			$agence->save();

			$fields = $validator->failed();
			return Redirect::back()
			->withSuccess(trans('validation.custom.agenceUpdate'));

		}else{

			$fields = $validator->failed();
			return Redirect::back()
			->withInput()
			->with(compact('fields'))
			->withErrors($validator);
		}


	}

	public function deleteMember( $user_slug, $agence, $member_id ){

		$user = User::find($member_id);
		$member = $agence->user()->whereUser_id($member_id)->first();

		$agence->user()->detach($member->id);

		return Redirect::back();

	}
	public function join( $user_slug ){

		$input = Input::all();

		$validator = Validator::make($input, Agence::$join_rules);

		Session::put('agence_join', $input);

		if($validator->passes()){

			$agence = Agence::whereLogin($input['login'])->first();

			if(Helpers::isOk($agence) && Hash::check($input['password_agence'], $agence->password )){

				if(Helpers::isOk($agence)){

					if($agence->user()->whereUserId(Auth::user()->id)->count() > 0){

						$agence->user()->detach(Auth::user()->id);
					}

					$agence->user()->attach(Auth::user()->id);


					return Redirect::route('index_agence', Auth::user()->slug);


				}else{

					return Redirect::back()
					->withInput()
					->withErrors(array('error'=>trans('validation.custom.agence_join')));
				}

			}else{

				return Redirect::back()
				->withInput()
				->withErrors(array('error'=>trans('validation.custom.agence_join')));
			}
		}else{

			return Redirect::back()
			->withInput()
			->withErrors($validator);
		}

	}
	public function indexProfile( $agence ){

		$locations = $agence->location()->with('photo','request','translation','building')->get();

		return View::make('agence.showProfile', array('page'=>'agence'))
		->with(compact('locations','agence'));
	}

	public function members( $user_slug, $agence ){

		$members = $agence->user()->get();
		$boss = $agence->boss()->first();

		return View::make('agence.members', array('page'=>'agence'))
		->with(compact('members','agence','boss'));
	}

	public function memberProfile( $agence ){

		$members = $agence->user()->get();
		$boss = $agence->boss()->first();

		return View::make('agence.membersProfile', array('page'=>'agence'))
		->with(compact('members','agence','boss'));

	}

	public function show( $user_slug, $agence ){

		$locations = $agence->location()->with('photo','request','translation')->get();

		return View::make('agence.show', array('page'=>'agence'))
		->with(compact('locations','agence'));
	}

	public function showProfile( $agence ){

		$locations = $agence->location()->with('photo','request','translation')->get();

		return View::make('agence.showProfile', array('page'=>'agence'))
		->with(compact('locations','agence'));
	}

	public function index(){

		$agences = Auth::user()->agence()->get();

		return View::make('agence.index', array( 'page'=>'agence'))
		->with(compact('agences'));

	}

	public function add(){

		return View::make('agence.add', array( 'page'=>'agence', 'widget'=>array('select','validator','city_autocomplete')));

	}

	public function edit($user_slug, $agence){

		$region = $agence->region->translation()->pluck('value');
		$locality = $agence->locality()->pluck('name');

		return View::make('agence.edit', array( 'page'=>'agence', 'widget'=>array('select','validator','city_autocomplete')))
		->with(compact('agence','region','locality'));

	}
	public function infoProfile( $agence){

		$region = $agence->region->translation()->pluck('value');
		$locality = $agence->locality()->pluck('name');

		return View::make('agence.infos', array( 'page'=>'agence'))
		->with(compact('agence','region','locality'));

	}
	public function store( ){

		$input = Input::all();

		$validator  = Validator::make($input, Agence::$rules);

		if($validator->passes()){

			$agence = new Agence;

			$agence->name = ucfirst($input['name']);
			$agence->nb_employes = $input['nb_employer'];
			$agence->login = $input['login'];
			$agence->password = Hash::make($input['password']);
			$agence->created = $input['year'].'-'.$input['month'].'-'.$input['day'];
			$agence->language_id = Config::get('var.langId')[$input['language']];
			$agence->user_id = Auth::user()->id;
			$agence->address = $input['address'];
			$agence->locality_id = Locality::where('name','like', $input['locality'])->pluck('id');
			$agence->region_id = Translation::whereContentType('Region')->whereKey('name')->where('value','like', $input['region'])->pluck('content_id');
			$agence->postal = $input['postal'];
			$agence->validate = 1;
			$agence->visible = 1;

			$agence->save();

			$agence->logo = $this->image->logoAgence( $agence->id );

			$agence->save();

			Auth::user()->agence()->attach($agence->id);


			if($agence){

				return Redirect::route('index_agence', Auth::user()->slug);

			}else{

				$fields = $validator->failed();
				return Redirect::back()
				->withInput()
				->with(compact('fields'))
				->withErrors($validator);
			}

		}else{


			$fields = $validator->failed();
			return Redirect::back()
			->withInput()
			->with(compact('fields'))
			->withErrors($validator);
		}

	}



}