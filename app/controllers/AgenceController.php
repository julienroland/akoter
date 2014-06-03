<?php 
/**
* 
*/
class AgenceController extends BaseController
{
	public function __construct(ImageController $image){

		$this->image = $image;
		
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
	public function indexProfile( $agence ){

		$locations = $agence->location()->with('photo','request','translation','building')->get();

		return View::make('agence.show', array('page'=>'agence'))
		->with(compact('locations','agence'));
	}
	public function show( $user_slug, $agence ){

		$locations = $agence->location()->with('photo','request','translation')->get();

		return View::make('agence.show', array('page'=>'agence'))
		->with(compact('locations','agence'));
	}

	public function index(){

		$agences = Auth::user()->agence()->remember(Config::get('var.remember'), 'agences'.Auth::user()->id)->get();

		return View::make('agence.index', array( 'page'=>'agence'))
		->with(compact('agences'));

	}

	public function add(){

		return View::make('agence.add', array( 'page'=>'agence', 'widget'=>array('select','validator','city_autocomplete')));

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

			$agence->save();

			$agence->logo = $this->image->logoAgence( $agence->id );

			$agence->save();

			Auth::user()->agence()->attach($agence->id);

			Cache::forget('agences'.Auth::user()->id);

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