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
Route::get('test', function () {

});


/*-----  End of TEST  ------*/

/*==============================
=            GLOBAL            =
==============================*/

$lang = Request::segment(1);

if (in_array($lang, Config::get('app.available_locales'))) {

	App::setLocale($lang);


} else {

	$lang = null;

}
/**
 *
 * VALIDATOR
 *
 **/

Route::any('getValidation/{rules}', array('uses' => 'ValidatorController@validate'));

Route::post('getOneValidation/{name}/{rules}/{value?}', array('uses' => 'ValidatorController@validateOne'));

/**
 *
 * Checking email
 *
 **/

Route::get('activation/{key}', array('uses' => 'InscriptionController@activation'));

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

Route::get('getKots', array('as' => 'getKots', 'uses' => 'BuildingController@gmGetBuilding'));

/**
 *
 * Schools
 *
 **/

Route::get('getSchools', array('uses' => 'SchoolController@gmGet'));

/**
 *
 * locality autocomplete
 *
 **/

Route::get('getLocalityAutocomplete', array('as' => 'getLocalityAutocomplete', 'uses' => 'FormController@getLocalityAutocomplete'));

/**
 *
 * More Locations on scroll
 *
 **/

Route::get('ajax/getMoreLocations/{take}/{skip}/{orderBy}/{orderWay}/{json}', array('uses' => 'LocationController@getMoreLocation'));

/**
 *
 * Locations after filter
 *
 **/

Route::get('ajax/getLocationsFilter', array('uses' => 'LocationController@getLocationsFilter'));

/**
 *
 * Upload image
 *
 **/
Route::any('ajax/uploadBuildingImage/{type}/{id}', array('as' => 'ajax_upload_image', 'uses' => 'ImageController@postBuildingImage'));

Route::any('ajax/uploadLocationImage/{type}/{id}', array('uses' => 'ImageController@postLocationImage'));

Route::any('ajax/updatePhotoPosition/{type}', array('uses' => 'ImageController@upatePosition'));

Route::get('ajax/getBuildingPhoto/{type}/{id}', array('uses' => 'BuildingController@getPhotos'));

Route::get('ajax/getLocationPhoto/{type}/{id}', array('uses' => 'LocationController@getPhotos'));

Route::get('ajax/deleteImage/{photoId}/{proprieteId}/{type}', array('uses' => 'ImageController@deletePhoto'));

Route::get('ajax/deleteAdvertImage/{photoId}/{proprieteId}', array('uses' => 'ImageController@deleteAdvertPhoto'));
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
Route::get('login/fb', array('as' => 'fbConnect', 'uses' => 'ConnectionController@facebookCall'));

Route::get('login/fb/callback', array('uses' => 'ConnectionController@facebookCallback'));

Route::get('register/fb/callback', array('uses' => 'InscriptionController@facebook'));

/**
*
* Comments
*
**/

Route::post('addComment/{location_id}',array('as'=>'addComments', 'uses'=>'LocationController@addComment'));
/**
 *
 * Ajax languages
 *
 **/

Route::get('getAllLang', array('uses' => 'LangController@getAll'));

/*-----  End of GLOBAL  ------*/

/*==============================
=          LANGUAGE            =
==============================*/
Route::group(array('prefix' => $lang), function () use ($lang) {

	if (Helpers::isOk($lang)) {

		App::setLocale($lang);

	}

	Route::group(array('before' => 'lang'), function () {

		App::setLocale(Session::get('lang'));

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

        Route::get(Lang::get('routes.home'), array('as' => 'home', 'uses' => 'HomeController@index'));
        /**
        *
        * Contact tenant
        *
        **/

        Route::get(trans('routes.contact-owner').'/{owner_slug}/'.trans('routes.on-location').'/{location_id}', array('as'=>'contact_owner','uses'=>'UserController@indexContactOwner'));

        Route::post(trans('routes.contact-owner').'/{owner_slug}/'.trans('routes.on-location').'/{location_id}', array('as'=>'contact_owner','uses'=>'UserController@ContactOwner'));

        /**
         *
         * Listing
         *
         **/

        Route::any(Lang::get('routes.listing'), array('as' => 'listLocation', 'uses' => 'LocationController@getList'));

        Route::get(Lang::get('routes.contact'), array('as' => 'contact', function () {

        	return View::make('contact');

        }));

        Route::bind('location_slug', function ($value, $route) {

        	$translation = Translation::whereKey('slug')->whereContentType('Location')->whereValue($value)->first();
            if(Helpers::isNotOk($translation)){
                $location = Location::findOrFail($value);
                $translation = $location->translation()->whereKey('slug')->firstOrFail();
                $route->forgetParameter('location_slug');
                $route->setParameter('location_slug', $translation->value);
            }

        	return Location::findOrFail($translation->content_id);

        });
        /**
        *
        * Voir
        *
        **/
        Route::get(trans('routes.locations').'/{location_slug}',array('as'=>'showLocation','uses'=>'LocationController@voir'));
        
        /**
         *
         * Reactive account
         *
         **/

        Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.account-reactive'), array('as' => 'account_reactive', 'uses' => 'AccountController@indexReactive'));

        Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.account-reactive') . '/{id}', array('as' => 'account_reactive_query', 'uses' => 'AccountController@reactive'));

        /**
         *
         * Undelete account
         *
         **/

        Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.account-undelete'), array('as' => 'deleted_account', 'uses' => 'AccountController@indexUndelete'));

        Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.account-undelete') . '/{id}', array('as' => 'account_undelete_query', 'uses' => 'AccountController@undelete'));

        /**
         *
         * Contact
         *
         **/

        Route::get(trans('routes.contact_us'), array('as' => 'contact_us', 'uses' => 'ContactController@contactUs'));

        Route::post(trans('routes.contact_us'), array('as' => 'contact_us', 'uses' => 'ContactController@sendMessage'));

        /**
         *
         * Create cookie for tuto
         *
         **/

        Route::get('createCookie/{name}', array('uses' => 'AjaxController@createCookie'));

        /*
        *
        *	IF LOGIN
        *
        */

        Route::group(array('before' => 'auth'), function () {

            /*
             * Admin
             *
             */
            Route::group(array('prefix' => 'admin'), function () {

            	Route::group(array('before' => 'admin'), function () {

            		Route::bind('building_id', function ($value, $route) {

            			return Building::findOrFail($value);

            		});

            		Route::bind('user_id', function ($value, $route) {

            			return User::findOrFail($value);

            		});

            		Route::controller('translations', 'Barryvdh\TranslationManager\Controller');


            		Route::get('/', array('as'=>'getIndexAdmin','uses'=>'Admin_AdminController@index'));

            		Route::get('login', array('as' => 'login_admin', 'uses' => 'Admin_UserController@connect'));

            		Route::get('disconnect', array('uses'=>'Admin_UserController@disconnect'));

            		Route::get('leave', array('uses'=>'Admin_UserController@leave'));

            		Route::get('buildings', array('uses'=>'Admin_BuildingController@index'));

            		Route::get('building/delete/{building_id}', array('uses'=>'Admin_BuildingController@delete'));

            		Route::get('building/validate/{building_id}', array('uses'=>'Admin_BuildingController@validate'));

            		Route::get('building/contact/{building_id}', array('uses'=>'Admin_BuildingController@contact'));

            		Route::post('building/sendMessage/{building_id}/{user_id}', array('uses'=>'Admin_BuildingController@sendMessage'));
            		
            	});

});
            /**
             *
             * Profil
             *
             **/

            /**
            *
            * Reserved
            *
            **/

            Route::get(trans('routes.reserved').'/{location_slug}/', array('as'=>'reserved','uses'=>'UserController@reserved'));

            Route::post(trans('routes.reserved').'/{location_slug}/', array('as'=>'reserved_location','uses'=>'UserController@reserved_location'));

            /**
             *
             * Photo
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.edit_photo'), array('as' => 'edit_photo', 'uses' => 'AccountController@editPhoto'));

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

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.disconnect'), array('as' => 'disconnect', 'uses' => 'ConnectionController@disconnect'));

            /**
             *
             * Home
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/', array('as' => 'account_home', 'uses' => 'AccountController@index'));

            /**
             *
             * Personnal infos
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.account-personnal'), array('as' => 'account_personnal', 'uses' => 'AccountController@personnalData'));

            Route::put(trans('routes.account') . '/{user_slug}/' . trans('routes.account-personnal'), array('as' => 'save_personnal', 'uses' => 'AccountController@savePersonnalData'));

            /**
             *
             * Params account
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.account-params'), array('as' => 'account_params', 'uses' => 'AccountController@params'));

            Route::put(trans('routes.account') . '/{user_slug}/' . trans('routes.account-params'), array('as' => 'save_params', 'uses' => 'AccountController@saveParams'));

            /**
             *
             * Check user email
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.checkEmail'), array('as' => 'checkEmail', 'uses' => 'UserController@sendEmailComfirm'));

            /**
             *
             * Suspend account
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.account-suspend'), array('as' => 'suspend_account', 'uses' => 'AccountController@suspend'));

            /**
             *
             * Delete account
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.account-delete'), array('as' => 'delete_account', 'uses' => 'AccountController@delete'));


            Route::bind('location_id', function ($value, $route) {

            	return Location::whereId($value)->with(array('translation', 'building' => function ($query) {
            		$query->whereUserId(Auth::user()->id);
            	}))->firstOrFail();

            });

            /**
             *
             * Dashboard one location
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.location') . '/{location_id}', array('as' => 'dashboard_location', 'uses' => 'LocationDashboardController@index'));

            /**
             *
             * Edit location
             */
            /* Localisation */

            /**
             *
             * Agence
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.agences'), array('as' => 'index_agence', 'uses' => 'AgenceController@index'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_agence'), array('as' => 'add_agence', 'uses' => 'AgenceController@add'));

            Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_agence'), array('as' => 'store_agence', 'uses' => 'AgenceController@store'));

            /*Route::get(trans('routes.account').'/{user_slug}/'.trans('routes.add_agence'),array('as'=>'save_agence','uses'=>'AgenceController@add'));*/

            /**
             *
             * How be an owner
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.how_be_owner'), array('as' => 'how_be_owner', 'uses' => 'AccountController@how_be_owner'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location'), array('uses' => 'AccountController@how_be_owner'));
            /**
             *
             * OWNER OR TENANT FILTER
             *
             **/

            Route::group(array('before' => 'allow_advance'), function () {


                /**
                 *
                 * INSCRIPTION OWNER
                 *
                 **/
                Route::bind('building_id', function ($value, $route) {

                	$building = Building::whereId($value)->whereUserId(Auth::user()->id)->firstOrFail();

                	return $building;

                });
                /* Localisation */
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/' . trans('routes.inscription_step1') . '/{building_id?}/', array('as' => 'index_localisation_building', 'uses' => 'InscriptionController@indexLocalisation'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/' . trans('routes.inscription_step1') . '/{building_id?}/', array('as' => 'save_localisation_building', 'uses' => 'InscriptionController@saveLocalisation'));

                Route::put(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/' . trans('routes.inscription_step1') . '/{building_id?}/', array('as' => 'update_localisation_building', 'uses' => 'InscriptionController@updateLocalisation'));

                /* Type of location*/
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step2'), array('as' => 'index_types_locations', 'uses' => 'InscriptionController@indexTypesLocations'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step2'), array('as' => 'save_types_locations', 'uses' => 'InscriptionController@saveTypesLocations'));

                /* Building */
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step3'), array('as' => 'index_inscription_building', 'uses' => 'InscriptionController@indexBuilding'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step3'), array('as' => 'save_inscription_building', 'uses' => 'InscriptionController@saveBuilding'));

                Route::put(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step3'), array('as' => 'update_inscription_building', 'uses' => 'InscriptionController@updateBuilding'));

                /* Description */
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step4'), array('as' => 'index_inscription_general', 'uses' => 'InscriptionController@indexInfosGeneral'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step4'), array('as' => 'save_inscription_general', 'uses' => 'InscriptionController@saveInfosGeneral'));

                /* Photo building */
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step5'), array('as' => 'index_photo_building', 'uses' => 'InscriptionController@indexPhotoBuilding'));

                /* Adverts for each locations */
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step6'), array('as' => 'index_inscription_adverts', 'uses' => 'InscriptionController@indexAdverts'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step6'), array('as' => 'save_inscription_adverts', 'uses' => 'InscriptionController@saveAdverts'));

                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step7'), array('as' => 'index_photo_advert', 'uses' => 'InscriptionController@indexPhotoAdvert'));

                /* contact*/
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step8'), array('as' => 'index_inscription_contact', 'uses' => 'InscriptionController@indexContact'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_step8'), array('as' => 'save_inscription_contact', 'uses' => 'InscriptionController@saveContact'));

                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{building_id}/' . trans('routes.inscription_comfirm'), array('as' => 'index_validate_inscription_owner', 'uses' => 'InscriptionController@indexComfirm'));
            });


});
/* AUTH */

Route::group(array('before' => 'guest'), function () {

            /**
             *
             * Connection
             *
             **/

            Route::post(Lang::get('routes.connection'), array('as' => 'connection', 'uses' => 'ConnectionController@connection'));

            Route::get(Lang::get('routes.connection'), array('as' => 'connection', 'uses' => 'ConnectionController@index'));

            /**
             *
             * Inscription
             *
             **/

            Route::get(trans('routes.inscription'), array('as' => 'inscription_index', 'uses' => 'InscriptionController@index'));

            Route::post(trans('routes.inscription'), array('as' => 'inscription_save', 'uses' => 'InscriptionController@save'));

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