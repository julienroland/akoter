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
  /*  Mailgun::send('emails.invite', array('user'=>Auth::user()), function($message){
        $message->to('dominique.vilain@hepl.be','Dominique Vilain')
        ->from('akoter@julien-roland.be')
        ->subject('Avis de naissance');
    });
*/
return View::make('emails.requestLike')
->with('user', Auth::user())
->with('location',Location::whereId(1338)->with('translation')->first());
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
/*===========================
=            API            =
===========================*/
Route::group(array('prefix'=>'api'), function(){

    Route::get('/',array('uses'=>'ApiController@index'));

    Route::get('location/all', array('uses'=>'ApiController@allLocation'));

    Route::get('location/get/{take}', array('uses'=>'ApiController@getTakeLocation'));

    Route::get('location/in', array('uses'=>'ApiController@InLocation'));

    Route::group(array('prefix'=>'doc'), function(){

        Route::get('/',array('as'=>'api','uses'=>'ApiController@index'));


        Route::get('locations',array('uses'=>'ApiController@locations'));

        Route::get('schools',array('uses'=>'ApiController@schools'));

        Route::get('leave',array('uses'=>'ApiController@leave'));
    });

});

/*-----  End of API  ------*/



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
* Locations
*
**/
Route::get('ajax/getLocations/{building_id}',array('uses'=>'BuildingController@getLocations'));

/**
 *
 * Kots
 *
 **/

Route::get('ajax/getKots', array('as' => 'getKots', 'uses' => 'BuildingController@gmGetBuilding'));

/**
 *
 * Schools
 *
 **/

Route::get('ajax/getSchools', array('uses' => 'SchoolController@gmGet'));

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
        * Newsletter
        *
        **/

        Route::post(trans('routes.newsletter'), array('as'=>'newsletter','uses'=>'NewsletterController@add'));
        

        /**
         *
         * HOME
         *
         **/

        Route::get(trans('routes.home'), array('as' => 'home', 'uses' => 'HomeController@index'));

        /**
        *
        * Articles
        *
        **/

        Route::get(trans('routes.posts'), array('as'=>'indexPost','uses'=>'PostController@index'));

        Route::get(trans('routes.posts').'/{post_slug}', array('as'=>'showPost','uses'=>'PostController@show'));
        
        /**
        *
        * Contact owner
        *
        **/

        Route::get(trans('routes.contact-owner').'/{owner_slug}/'.trans('routes.on-location').'/{location_id}', array('as'=>'contact_owner','uses'=>'UserController@indexContactOwner'));

        Route::post(trans('routes.contact-owner').'/{owner_slug}/'.trans('routes.on-location').'/{location_id}', array('as'=>'contact_owner','uses'=>'UserController@ContactOwner'));

        /**
         *
         * Listing
         *
         **/

        Route::get(trans('routes.listing'), array('as' => 'listLocation', 'uses' => 'LocationController@getList'));

        Route::get(trans('routes.contact'), array('as' => 'contact', function () {

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
        * Edit photo
        *
        **/
        
        Route::post('editPhoto', array('as'=>'editPhotoProfile','uses'=>'UserController@editPhoto'));

        /**
        *
        * show
        *
        **/
        Route::get(trans('routes.locations').'/{location_slug}',array('as'=>'showLocation','uses'=>'LocationController@show'));

        /**
        *
        * Request
        *
        **/
        
        Route::get(trans('routes.account') . '/{user_slug}/' .trans('routes.request'),array('as'=>'seeRequest','uses'=>'AccountController@indexRequest'));

        Route::get(trans('routes.account') . '/{user_slug}/' .trans('routes.request').'/'.trans('routes.validRequest').'/{request_id}',array('as'=>'validRequest','uses'=>'AccountController@validRequest'));

        Route::get(trans('routes.account') . '/{user_slug}/' .trans('routes.request').'/'.trans('routes.refuseRequest').'/{request_id}',array('as'=>'refuseRequest','uses'=>'AccountController@refuseRequest'));

        /**
        *
        * Adverts
        *
        **/
        
        Route::get(trans('routes.account') . '/{user_slug}/' .trans('routes.adverts'),array('as'=>'indexAdverts','uses'=>'AccountController@indexAdverts'));
        
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

        /**
        *
        * Agence
        *
        **/
        
        Route::get(trans('routes.agences').'/{agence_slug}', array('as'=>'showAgence','uses'=>'AgenceController@indexProfile'));

        Route::get(trans('routes.agences').'/{agence_slug}', array('as' => 'show_agenceProfile', 'uses' => 'AgenceController@showProfile'));

        /*
        *
        *	IF LOGIN
        *
        */

        Route::group(array('before' => 'auth'), function () {

            Route::get( trans('routes.addFavoris').'/{location_id}', array('as'=>'addFavoris','uses'=>'UserController@addFavoris'));

            Route::get( trans('routes.removeFavoris').'/{location_id}', array('as'=>'removeFavoris','uses'=>'UserController@removeFavoris'));
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

                    Route::get('translations2', array('uses'=>'Admin_TranslationController@index'));

                    Route::get('/', array('as'=>'getIndexAdmin','uses'=>'Admin_AdminController@index'));

                    Route::get('disconnect', array('uses'=>'Admin_UserController@disconnect'));

                    Route::get('leave', array('uses'=>'Admin_UserController@leave'));

                    /**
                    *
                    * Building
                    *
                    **/
                    
                    Route::get('buildings', array('uses'=>'Admin_BuildingController@index'));

                    Route::get('building/delete/{building_id}', array('uses'=>'Admin_BuildingController@delete'));

                    Route::get('building/validate/{building_id}', array('uses'=>'Admin_BuildingController@validate'));

                    Route::get('building/contact/{building_id}', array('uses'=>'Admin_BuildingController@contact'));

                    Route::post('building/sendMessage/{building_id}/{user_id}', array('uses'=>'Admin_BuildingController@sendMessage'));

                    /**
                    *
                    * Location
                    *
                    **/
                    Route::bind('advert_id', function ($value, $route) {

                        return Location::findOrFail($value);

                    });
                    
                    Route::get('locations', array('uses'=>'Admin_AdvertController@index'));

                    Route::get('location/delete/{advert_id}', array('uses'=>'Admin_AdvertController@delete'));

                    Route::get('location/validate/{advert_id}', array('uses'=>'Admin_AdvertController@validate'));

                    Route::get('location/contact/{advert_id}', array('uses'=>'Admin_AdvertController@contact'));

                    Route::post('location/sendMessage/{advert_id}/{user_id}', array('uses'=>'Admin_AdvertController@sendMessage'));

                    /**
                    *
                    * Articles
                    *
                    **/
                    Route::bind('article_id', function ($value, $route) {

                        return Post::whereId($value)->with('translation','user')->firstOrFail();

                    });

                    Route::get('articles', array('uses'=>'Admin_ArticleController@index'));

                    Route::get('articles/edit/{article_id}', array('uses'=>'Admin_ArticleController@edit'));

                    Route::get('articles/notpublish/{article_id}', array('uses'=>'Admin_ArticleController@unpublish'));

                    Route::get('articles/publish/{article_id}', array('uses'=>'Admin_ArticleController@publish'));

                    Route::post('articles/addPhoto/{article_id}', array('uses'=>'Admin_ArticleController@addPhoto'));

                    Route::post('articles/edit/{article_id}', array('uses'=>'Admin_ArticleController@update'));

                    Route::get('articles/add', array('uses'=>'Admin_ArticleController@add'));

                    Route::get('articles/delete/{article_id}', array('uses'=>'Admin_ArticleController@delete'));

                    Route::post('articles/store', array('uses'=>'Admin_ArticleController@store'));
                    
                    /**
                    *
                    * Users
                    *
                    **/

                    Route::bind('user_id', function ($value, $route) {

                        return User::findOrFail($value);

                    });

                    Route::get('users', array('uses'=>'Admin_UserController@index'));

                    Route::get('users/validate/{user_id}', array('uses'=>'Admin_UserController@validate'));

                    Route::get('users/devalidate/{user_id}', array('uses'=>'Admin_UserController@devalidate'));

                    /**
                    *
                    * Notice
                    *
                    **/

                    Route::bind('notice_id', function ($value, $route) {

                        return Notice::whereId($value)->with('translation','user')->firstOrFail();

                    });

                    Route::get('notices', array('uses'=>'Admin_NoticeController@index'));

                    Route::get('notices/validate/{notice_id}', array('uses'=>'Admin_NoticeController@validate'));

                    Route::get('notices/devalidate/{notice_id}', array('uses'=>'Admin_NoticeController@devalidate'));

                    Route::get('notices/edit/{notice_id}', array('uses'=>'Admin_NoticeController@edit'));

                    Route::get('notices/delete/{notice_id}', array('uses'=>'Admin_NoticeController@remove'));

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
            Route::get( trans('routes.account') . '/{user_slug}/' .trans('routes.how_be_tenant'), array('as'=>'how_be_tenant', 'uses'=>'AccountController@howBeTenant'));
            
            Route::group(array('before'=>'available_user'), function(){

                Route::get(trans('routes.reserved').'/{location_slug}/', array('as'=>'reserved','uses'=>'UserController@reserved'));

                Route::post(trans('routes.reserved').'/{location_slug}/', array('as'=>'reserved_location','uses'=>'UserController@reserved_location'));

            });

            /**
            *
            * Test if user is a owner
            *
            **/
            
            Route::group(array('before'=>'isOwner'), function(){


                Route::get( trans('routes.account') . '/{user_slug}/' . trans('routes.add_notice'),array('as'=>'index_add_notice','uses'=>'NoticeController@add'));

                Route::post( trans('routes.account') . '/{user_slug}/' . trans('routes.add_notice'),array('as'=>'add_notice','uses'=>'NoticeController@store'));

            });

            /**
            *
            * Request validation
            *
            **/
            Route::get( trans('routes.account') . '/{user_slug}/' .trans('routes.requestValidation'), array('as'=>'requestValidation', 'uses'=>'AccountController@requestValidation'));
            
            /**
             *
             * Photo
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.edit_photo'), array('as' => 'edit_photo', 'uses' => 'AccountController@editPhoto'));

            Route::bind('user_slug', function($value, $route)
            {
                if(Auth::check()){
                    if(User::whereSlug($value)->firstOrFail()){

                        if($value === Auth::user()->slug){

                            return $value;

                        }
                    }
                }

                return Response::view('missing.default',array(),404); 

            });


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
            * Favorites
            *
            **/

            Route::get( trans('routes.account') . '/{user_slug}/' . trans('routes.favoris'), array('as'=>'indexFavoris','uses'=>'AccountController@indexFavoris'));

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

                if(Auth::check()){

                   return Location::whereId($value)->with(array('translation', 'building' => function ($query) {
                      $query->whereUserId(Auth::user()->id);
                  }))->firstOrFail();
               }
               else{

                return Location::whereId($value)->with(array('translation'))->firstOrFail();
            }
            return Response::view('missing.default', 404);

        });
            /**
            *
            * DASHBOARD
            *
            **/
            
            /**
             *
             * Dashboard one location
             *
             **/

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.dashboard') . '/{location_id}', array('as' => 'dashboard_location', 'uses' => 'LocationDashboardController@index'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.dashboard') . '/{location_id}/'. trans('routes.desactivate'), array('as' => 'dashboard_desactivateLocation', 'uses' => 'LocationDashboardController@desactivateLocation'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.dashboard') . '/{location_id}/'. trans('routes.activate'), array('as' => 'dashboard_activateLocation', 'uses' => 'LocationDashboardController@activateLocation'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.dashboard') . '/{location_id}/'. trans('routes.requestLike'), array('as' => 'requestLike', 'uses' => 'LocationDashboardController@requestLike'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.dashboard') . '/{location_id}/'. trans('routes.likes'), array('as' => 'dashboard_likes', 'uses' => 'LocationDashboardController@likes'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.dashboard') . '/{location_id}/'.trans('routes.tenants'), array('as' => 'dashboard_tenants', 'uses' => 'LocationDashboardController@indexTenants'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.dashboard') . '/{location_id}/'.trans('routes.likes').'/'.trans('routes.desactivate').'/{comment_id}', array('as' => 'dashboard_desactiveComment', 'uses' => 'LocationDashboardController@desactiveComment'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.dashboard') . '/{location_id}/'.trans('routes.likes').'/'.trans('routes.activate').'/{comment_id}', array('as' => 'dashboard_activeComment', 'uses' => 'LocationDashboardController@activeComment'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.dashboard') . '/{location_id}/'.trans('routes.likes').'/'.trans('routes.delete').'/{comment_id}', array('as' => 'dashboard_deleteComment', 'uses' => 'LocationDashboardController@deleteComment'));

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.dashboard') . '/{location_id}/'.trans('routes.request'), array('as' => 'dashboard_request', 'uses' => 'LocationDashboardController@requests'));
            
            /**
            *
            * END DASHBOARD
            *
            **/
            
            /* Localisation */

            /**
             *
             * Agence
             *
             **/
            Route::bind('agence_slug', function($value, $route){

                return Agence::whereSlug($value)->firstOrFail();
            });

            Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.your_agences'), array('as' => 'index_agence', 'uses' => 'AgenceController@index'));

            Route::get(trans('routes.account') . '/{user_slug}/' .trans('routes.your_agences').'/'. trans('routes.add_agence'), array('as' => 'add_agence', 'uses' => 'AgenceController@add'));

            Route::post(trans('routes.account') . '/{user_slug}/' .trans('routes.your_agences').'/'. trans('routes.add_agence'), array('as' => 'store_agence', 'uses' => 'AgenceController@store'));

            Route::group( array('before'=>'agenceBoss') , function(){

                Route::post(trans('routes.account') . '/{user_slug}/' .trans('routes.your_agences').'/{agence_slug}/'. trans('routes.update_agence') , array('as' => 'update_agence', 'uses' => 'AgenceController@update'));

                Route::get(trans('routes.account') . '/{user_slug}/' .trans('routes.your_agences').'/{agence_slug}/'. trans('routes.edit_agence'), array('as' => 'edit_agence', 'uses' => 'AgenceController@edit'));

                Route::get(trans('routes.account') . '/{user_slug}/' .trans('routes.your_agences').'/{agence_slug}/'. trans('routes.remove_member_agence').'/{member_id}', array('as' => 'remove_member_agence', 'uses' => 'AgenceController@deleteMember'));

            });


            Route::get(trans('routes.account') . '/{user_slug}/' .trans('routes.your_agences') .'/{agence_slug}/'. trans('routes.show_agence'), array('as' => 'show_agence', 'uses' => 'AgenceController@show'));

            Route::get(trans('routes.account') . '/{user_slug}/' .trans('routes.your_agences') .'/{agence_slug}/'. trans('routes.members_agence'), array('as' => 'agence_members', 'uses' => 'AgenceController@members'));
            
            Route::get(trans('routes.account') . '/{user_slug}/' .trans('routes.join_agences') , array('as'=>'join_agence','uses'=>'AgenceController@indexJoin'));

            Route::post(trans('routes.account') . '/{user_slug}/' .trans('routes.join_agences') , array('as'=>'join','uses'=>'AgenceController@join'));



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
                Route::bind('user_building_id', function ($value, $route) {

                	$building = Building::whereId($value)->whereUserId(Auth::user()->id)->firstOrFail();

                	return $building;

                });
                /* Localisation */
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/' . trans('routes.inscription_step1') . '/{building_id?}/{location_id?}', array('as' => 'index_localisation_building', 'uses' => 'InscriptionController@indexLocalisation'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/' . trans('routes.inscription_step1') . '/{building_id?}/{location_id?}', array('as' => 'save_localisation_building', 'uses' => 'InscriptionController@saveLocalisation'));

                Route::put(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/' . trans('routes.inscription_step1') . '/{building_id?}/{location_id?}', array('as' => 'update_localisation_building', 'uses' => 'InscriptionController@updateLocalisation'));

                /* Type of location*/
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step2'). '/{location_id?}', array('as' => 'index_types_locations', 'uses' => 'InscriptionController@indexTypesLocations'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step2'). '/{location_id?}', array('as' => 'save_types_locations', 'uses' => 'InscriptionController@saveTypesLocations'));

                /* Building */
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step3'). '/{location_id?}', array('as' => 'index_inscription_building', 'uses' => 'InscriptionController@indexBuilding'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step3'). '/{location_id?}', array('as' => 'save_inscription_building', 'uses' => 'InscriptionController@saveBuilding'));

                Route::put(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step3'). '/{location_id?}', array('as' => 'update_inscription_building', 'uses' => 'InscriptionController@updateBuilding'));

                /* Description */
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step4'). '/{location_id?}', array('as' => 'index_inscription_general', 'uses' => 'InscriptionController@indexInfosGeneral'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step4'). '/{location_id?}', array('as' => 'save_inscription_general', 'uses' => 'InscriptionController@saveInfosGeneral'));

                /* Photo building */
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step5'). '/{location_id?}', array('as' => 'index_photo_building', 'uses' => 'InscriptionController@indexPhotoBuilding'));

                /* Adverts for each locations */
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step6') . '/{location_id?}', array('as' => 'index_inscription_adverts', 'uses' => 'InscriptionController@indexAdverts'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step6'). '/{location_id?}', array('as' => 'save_inscription_adverts', 'uses' => 'InscriptionController@saveAdverts'));

                /* PHOTO advert*/

                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step7'). '/{location_id?}', array('as' => 'index_photo_advert', 'uses' => 'InscriptionController@indexPhotoAdvert'));

                /* contact*/
                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step8'). '/{location_id?}', array('as' => 'index_inscription_contact', 'uses' => 'InscriptionController@indexContact'));

                Route::post(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_step8'). '/{location_id?}', array('as' => 'save_inscription_contact', 'uses' => 'InscriptionController@saveContact'));

                Route::get(trans('routes.account') . '/{user_slug}/' . trans('routes.add_location') . '/{user_building_id}/' . trans('routes.inscription_comfirm'). '/{location_id?}', array('as' => 'index_validate_inscription_owner', 'uses' => 'InscriptionController@indexComfirm'));
            });


});
/* AUTH */

Route::group(array('before' => 'guest'), function () {

            /**
             *
             * Connection
             *
             **/

            Route::post(trans('routes.connection'), array('as' => 'connection', 'uses' => 'ConnectionController@connection'));

            Route::get(trans('routes.connection'), array('as' => 'connection', 'uses' => 'ConnectionController@index'));

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