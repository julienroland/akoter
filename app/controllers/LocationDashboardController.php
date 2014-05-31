<?php

class LocationDashboardController extends AccountBaseController {

	public function __construct( )
	{	
		$params = Route::current()->parameters();
		if(isset($params['location_id'])){
			$this->location = Route::current()->parameters()['location_id'];
		}	
		View::share(array(
			'request'=>$this->nb_request(),
			'personnal'=>$this->personnalComplete(),
			'location'=>$this->location,
			));
	}

	public function index($user_slug, $location){

		$photo = $location->accroche->first();

		return View::make('account.owner.dashboard.index',array('page'=>'dashboard'))
		->with(compact('photo'));
	}

	public function indexTenants( $user_slug, $location ){

		$tenants = $location->tenants()->get();

		return View::make('account.owner.dashboard.tenants',array('page'=>'dashboard'))
		->with(compact('tenants'));
	}

}