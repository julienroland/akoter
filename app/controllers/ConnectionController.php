<?php  

use Carbon\Carbon;

/**
* 
*/
class ConnectionController extends BaseController
{	
	public function __construct(InscriptionController $inscription)   
	{
		$this->InscriptionController = $inscription;
	}

	public function index(){

		return View::make('connection.index', array('page'=>'connection','widget'=>array('validator')));
	}
	public function connection() {
		
		$input = Input::all();

		$validator = Validator::make($input, User::$rules);
		
		if ($validator->passes()) {


			if (Auth::attempt( array( 'email'=> $input['email_co'], 'password'=>$input['password_co'] ), isset($input['remember']) ? true : false )) {

				$user = User::whereEmail($input['email_co'])->first();				

				if($user->suspend == 1){

					Auth::logout();

					Session::put('user_reactive', $user);

					return Redirect::route('account_reactive', $user->slug);
				}

				if($user->delete == 1){

					Auth::logout();

					Session::put('user_delete', $user);

					return Redirect::route('deleted_account', $user->slug);
				}

				$user->timestamps = false;

				$user->connected_at = Carbon::now();

				$user->save();

				if(isset($input['remember']) && !Cookie::has('login')){

					$login = Cookie::forever('login', $input);
/**
*
* -> CECI provoque le bug sur le sessions
*
**/


				}

				return Redirect::intended(route('account_home', Auth::user()->slug));

			} else {

				return Redirect::route('connection')
				->withInput()
				->with('error',trans('validation.custom.invalid_account'));

			}	

		}
		else
		{
			$fields = $validator->failed();
			return Redirect::route('connection')
			->with(compact('fields'))
			->withInput()
			->withErrors($validator);
		}

	}

	/**
	*
	* Facebook connect
	*
	**/

	public function facebookCall() {

		$facebook = new Facebook(Config::get('facebook'));
		$params = array(
			'redirect_uri' => url('login/fb/callback'),
			'scope' => 'email,public_profile',
			);
		return Redirect::to($facebook->getLoginUrl($params));
	}

	public function facebookCallback(){

		$code = Input::get('code');

		if (strlen($code) == 0) return Redirect::to('/')->with('errors', 'There was an error communicating with Facebook');

		$facebook = new Facebook(Config::get('facebook'));
		$uid = $facebook->getUser();

		if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');

		$me = $facebook->api('/me');

		$profile = Profile::whereUid($uid)->first();

		if (empty($profile)) {

			$user = $this->InscriptionController->facebook( $me, $uid, $facebook );

		}else{

			$user = $profile->user()->first();

		}
		Auth::login($user);
		
		if($user->suspend == 1){

			Auth::logout();

			Session::put('user_reactive', $user);

			return Redirect::route('account_reactive', $user->slug);
		}

		if($user->delete == 1){

			Auth::logout();

			Session::put('user_delete', $user);

			return Redirect::route('deleted_account', $user->slug);
		}

		if(isset($input['remember'])){

			$login = Cookie::forever('login', $input);

		}

		$user->timestamps = false;

		$user->connected_at = Carbon::now();

		$user->save();

		return Redirect::route('account_home', Auth::user()->slug)->with('message', 'Logged in with Facebook');
	}



/**
*
* Disconnection
*
**/
public function disconnect(){

	if(Auth::check()){

		$user = Auth::user();

		$user->timestamps = false;
	
		$user->connected_at = Carbon::now();

		$user->save();

		Auth::logout();

		Session::flush();

		Cookie::forget('login');

		return Redirect::to(trans('routes.home'));
	}
	else
	{
		return Redirect::to(trans('routes.home'));
	}
}
}