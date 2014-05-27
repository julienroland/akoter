<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	/*$locale = Request::segment(1);

	if (in_array($locale, Config::get('app.available_locales')))
	{
		Session::put('lang',Request::segment(1) );
		\App::setLocale($locale);

	} else {

		\App::setLocale(Config::get('app.locale'));
	}*/
});


App::after(function($request, $response)
{
	//
});



App::error(function(ModelNotFoundException $e)
{

	return Response::make(Lang::get('general.introuvable'), 404);
});

/**
 * Filter admin
 */

Route::filter('admin', function()
{

    if(Auth::check()){

        if(Auth::user()->role_id > 2){

            return Redirect::back('/');
        }

    }else{

        return View::make('admin.login',array('page'=>'admin'));

    }

});
/**
*
* Filtre de langue
*
**/

Route::filter('lang', function(){

	$lang = Request::segment(1);

	if (in_array($lang, Config::get('app.available_locales')))
	{
		if($lang !== Session::get('lang')){

			Session::put('lang',$lang );
			Session::put('langId', Config::get('var.langId')[$lang]);	

		}

		if(App::getLocale() !== $lang){

			App::setLocale($lang);
			
			if(Helpers::isOk(Route::currentRouteName()))
			{

				return Redirect::route(Route::currentRouteName());

			}
			else{
				return Redirect::to('/');
			}
		}


	}
	else 
	{

		if(Auth::check()){

			if(Helpers::isOk(Auth::user()->language_id)){

				$language = Config::get('var.lang')[Auth::user()->language_id]  ;

				if(Helpers::isOk($language)){

					App::setLocale( $language );

					Session::put('lang',$language );
					Session::put('langId',Auth::user()->language_id);

				}

			}else{

				$lang = null;

			}


		}else{



			$langNav = Request::server('HTTP_ACCEPT_LANGUAGE');

			if (helpers::isOk($langNav)) 
			{
				$language = explode(',',$langNav);
				$language = strtolower(substr(chop($language[0]),0,2));

				if (in_array($language, Config::get('app.available_locales')))
				{	
					if($language !== Session::get('lang')){

						Session::put('lang',$language );
						Session::put('langId',Config::get('var.langId')[$language]);

					}

					App::setLocale($language);
					$lang = null;
				}
				else
				{
					$lang = null;
				}

			}
			else
			{

				$lang = null;

			}
		}
	}
	

});

Route::filter('allow_advance', function(){

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
	
	/**
	*
	* Email comfirm
	*
	**/

	$email_comfirm = Auth::user()->email_comfirm;

	
	if(Helpers::isOK($personnalNotComplete) && $personnalNotComplete->count < $personnalNotComplete->total ){ //|| $email_comfirm == 0
		
		return Redirect::route('how_be_owner', Auth::user()->slug );
	}

});
/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{	

	if(Auth::guest() && Cookie::has('login')) Auth::attempt( array( 'email'=> Cookie::get('login')['email_co'], 'password'=>Cookie::get('login')['password_co'] ), isset(Cookie::get('login')['remember']) ? true : false );
	if(Auth::guest()) return Redirect::guest(trans('routes.connection'));
	if(Auth::user()->suspend == 1) return Redirect::route('connection');
	if(Auth::user()->delete == 1) return Redirect::route('connection');

});


Route::filter('auth.basic', function()
{

	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{

	if (Auth::check()) return Redirect::intended('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});