<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|


*/

/*============================
=            TEST            =
============================*/
Route::get('test',function(){

});


/*-----  End of TEST  ------*/

/*==============================
=            GLOBAL            =
==============================*/

$lang = Request::segment(1);

if (in_array($lang, Config::get('app.available_locales')))
{

	App::setLocale($lang);


}else{

	$lang = null;

}
/**
*
* VALIDATOR
*
**/

Route::any('getValidation/{rules}', array('uses'=>'ValidatorController@validate'));

Route::post('getOneValidation/{name}/{rules}/{value?}', array('uses'=>'ValidatorController@validateOne'));

/**
*
* Checking email 
*
**/

Route::get('activation/{key}', array('uses'=>'InscriptionController@activation'));

/**
*
* Ajax
*
**/

/**
*
* Kots
*
**/

Route::get('getKots',array('as'=>'getKots','uses'=>'BuildingController@gmGetBuilding'));

/**
*
* Schools
*
**/

Route::get('getSchools',array('uses'=>'SchoolController@gmGet'));

/**
*
* locality autocomplete
*
**/

Route::get('getLocalityAutocomplete',array('as'=>'getLocalityAutocomplete','uses'=>'FormController@getLocalityAutocomplete'));

/**
*
* More Locations on scroll
*
**/

Route::get('ajax/getMoreLocations/{take}/{skip}/{orderBy}/{orderWay}/{json}', array('uses'=>'LocationController@getMoreLocation'));

/**
*
* Locations after filter
*
**/

Route::get('ajax/getLocationsFilter', array('uses'=>'LocationController@getLocationsFilter'));

/* 404 */
/*App::missing(function($exception){
 if (Request::is('admin/*'))
    {
        return Response::view('admin.missing',array(),404);
    }
    return Response::view('missing.default',array(),404); 

});*/

/* END 404 */

/**
*
* Facebook connection
*
**/
Route::get('login/fb', array('as'=>'fbConnect', 'uses'=>'ConnectionController@facebookCall'));

Route::get('login/fb/callback', array('uses'=>'ConnectionController@facebookCallback'));

Route::get('register/fb/callback', array('uses'=>'InscriptionController@facebook'));

/**
*
* Ajax languages
*
**/

Route::get('getAllLang',array('uses'=>'LangController@getAll'));

/*-----  End of GLOBAL  ------*/

/*==============================
=          LANGUAGE            =
==============================*/
Route::group(array('prefix' => $lang), function() use($lang)
{
	if(Helpers::isOk($lang)) {

		App::setLocale(Session::get('lang'));

	}

	Route::group(array('before' => 'lang'), function(){

	/**
	*
	* IF Session doesn't exist, put value in it
	*
	**/

	/*if(Helpers::isNotOk(Session::get('langId')))
	{

		Session::put('langId', Language::whereShort(App::getLocale())->first(['id'])->id);

	}*/


	/**
	*
	* HOME
	*
	**/	

	Route::get(Lang::get('routes.home') , array('as'=>'home','uses'=>'HomeController@index'));

	/**
	*
	* Listing
	*
	**/

	Route::any(Lang::get('routes.listing') , array('as'=>'listLocation','uses'=>'LocationController@getList'));

	Route::get(Lang::get('routes.contact') , array('as' => 'contact', function()
	{

		return View::make('contact');

	}));

		/**
		*
		* Reactive account
		*
		**/

		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.account-reactive'), array('as'=>'account_reactive','uses'=>'AccountController@indexReactive'));

		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.account-reactive').'/{id}', array('as'=>'account_reactive_query','uses'=>'AccountController@reactive'));

		/**
		*
		* Undelete account
		*
		**/

		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.account-undelete'), array('as'=>'deleted_account','uses'=>'AccountController@indexUndelete'));

		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.account-undelete').'/{id}', array('as'=>'account_undelete_query','uses'=>'AccountController@undelete'));

	/**
	*
	* Contact
	*
	**/

	Route::get(trans('routes.contact_us'), array('as'=>'contact_us','uses'=>'ContactController@contactUs'));

	Route::post(trans('routes.contact_us'), array('as'=>'contact_us','uses'=>'ContactController@sendMessage'));
	
	/**
	*
	* Create cookie for tuto
	*
	**/

	Route::get('createCookie/{name}', array('uses'=>'AjaxController@createCookie'));
	
/*
*
*	IF LOGIN
*
*/

Route::group(array('before'=>'auth'),function(){

	

	/**
	*
	* Profil
	*
	**/

	/**
	*
	* Photo
	*
	**/

	Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.edit_photo'),array('as'=>'edit_photo','uses'=>'AccountController@editPhoto'));
	
/*	Route::bind('user_slug', function($value, $route)
	{	
		if($value === Auth::user()->slug){

			return $value;

		}else{
			dd(str_replace('{user_slug}',Auth::user()->slug, Route::current()->getUri()));
			return Redirect::to(str_replace('{user_slug}',Auth::user()->slug, Route::current()->getUri()));
		}
		return User::where('initial_2', $value)->firstOrFail();

	});*/

	/**
	*
	* Disconnect
	*
	**/

		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.disconnect'), array('as'=>'disconnect','uses'=>'ConnectionController@disconnect'));

		/**
		*
		* Home
		*
		**/
		
		Route::get(trans('routes.account').'/{user_slug}', array('as'=>'account_home', 'uses'=>'AccountController@index'));
		
		Route::get(trans('routes.account').'/{user_slug}/', array('as'=>'account_home', 'uses'=>'AccountController@index'));
		
		/**
		*
		* Personnal infos
		*
		**/
		
		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.account-personnal'), array('as'=>'account_personnal', 'uses'=>'AccountController@personnalData'));

		Route::put(trans('routes.account').'/{user_slug}/'.trans('routes.account-personnal'), array('as'=>'save_personnal', 'uses'=>'AccountController@savePersonnalData'));

		/**
		*
		* Params account
		*
		**/
		
		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.account-params'), array('as'=>'account_params', 'uses'=>'AccountController@params'));

		Route::put(trans('routes.account').'/{user_slug}/'.trans('routes.account-params'), array('as'=>'save_params', 'uses'=>'AccountController@saveParams'));

		/**
		*
		* Check user email
		*
		**/

		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.checkEmail'), array('as'=>'checkEmail','uses'=>'UserController@sendEmailComfirm'));

		/**
		*
		* Suspend account
		*
		**/
		
		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.account-suspend'), array('as'=>'suspend_account','uses'=>'AccountController@suspend'));

		/**
		*
		* Delete account
		*
		**/
		
		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.account-delete'), array('as'=>'delete_account','uses'=>'AccountController@delete'));


		Route::bind('location_slug', function($value, $route){

			return Translation::whereContentType('Location')->whereKey('slug')->whereValue( $value )->first();

		});

		/**
		*
		* Dashboard one location
		*
		**/

		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.location').'/{location_slug}', array('as'=>'dashboard_location','uses'=>'LocationDashboardController@index'));
		
		/**
		*
		* Agence
		*
		**/

		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.agences'),array('as'=>'index_agence','uses'=>'AgenceController@index'));

		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.add_agence'),array('as'=>'add_agence','uses'=>'AgenceController@add'));

		Route::post(trans('routes.account').'/{user_slug}/'.trans('routes.add_agence'),array('as'=>'store_agence','uses'=>'AgenceController@store'));

		/*Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.add_agence'),array('as'=>'save_agence','uses'=>'AgenceController@add'));*/
		
		/**
		*
		* How be an owner
		*
		**/
		
		Route::get( trans('routes.account').'/{user_slug}/'.trans('routes.how_be_owner') , array('as'=>'how_be_owner','uses'=>'AccountController@how_be_owner') );

		Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.add_location'), array('uses'=>'AccountController@how_be_owner'));
		/**
		*
		* OWNER OR TENANT FILTER
		*
		**/

		Route::group(array('before'=>'allow_advance'), function(){


			/**
			*
			* INSCRIPTION OWNER
			*
			**/
			Route::bind('building_id', function($value, $route)
			{	

				$building = Building::whereId($value)->whereUserId(Auth::user()->id)->firstOrFail();

				return $building;

			});
			/* Localisation */
			Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.add_location').'/'.trans('routes.inscription_step1').'/{building_id?}/', array('as'=>'index_localisation_building','uses'=>'InscriptionController@indexLocalisation'));

			Route::post(trans('routes.account').'/{user_slug}/'.trans('routes.add_location').'/'.trans('routes.inscription_step1').'/{building_id?}/', array('as'=>'save_localisation_building','uses'=>'InscriptionController@saveLocalisation'));

			Route::put(trans('routes.account').'/{user_slug}/'.trans('routes.add_location').'/'.trans('routes.inscription_step1').'/{building_id?}/', array('as'=>'update_localisation_building','uses'=>'InscriptionController@updateLocalisation'));

			/* Type of location*/
			Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.add_location').'/{building_id}/'.trans('routes.inscription_step2'), array('as'=>'index_types_locations','uses'=>'InscriptionController@indexTypesLocations'));

			Route::post(trans('routes.account').'/{user_slug}/'.trans('routes.add_location').'/{building_id}/'.trans('routes.inscription_step2'), array('as'=>'save_types_locations','uses'=>'InscriptionController@saveTypesLocations'));

			/* Building */
			Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.add_location').'/{building_id}/'.trans('routes.inscription_step3'), array('as'=>'index_inscription_building','uses'=>'InscriptionController@indexBuilding'));

			Route::post(trans('routes.account').'/{user_slug}/'.trans('routes.add_location').'/{building_id}/'.trans('routes.inscription_step3'), array('as'=>'save_inscription_building','uses'=>'InscriptionController@saveBuilding'));
		});
		

	});

Route::group(array('before'=>'guest'), function(){

	/**
	*
	* Connection
	*
	**/

	Route::post(Lang::get('routes.connection'), array('as' =>'connection','uses'=>'ConnectionController@connection'));

	Route::get(Lang::get('routes.connection'), array('as' =>'connection','uses'=>'ConnectionController@index'));

	/**
	*
	* Inscription
	*
	**/

	Route::get(trans('routes.inscription'), array('as'=>'inscription_index','uses'=>'InscriptionController@index'));

	Route::post(trans('routes.inscription'), array('as'=>'inscription_save','uses'=>'InscriptionController@save'));

});	

/* END IF LOGIN */
/*
*
*	BUILDING
*
*/

/*
*
*	END BUILDING
*
*/




});
});
/*-----  End of LANGUAGE  ------*/