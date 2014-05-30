<?php

class LocationDashboardController extends AccountBaseController {

	public function __construct( )
	{
		
		View::share(array(
			'request'=>$this->nb_request(),
			'personnal'=>$this->personnalComplete()
			));
	}

	public function index($user_slug, $location){

		$photo = $location->accroche->first();

		return View::make('account.owner.dashboard.index',array('page'=>'dashboard'))
		->with(compact('location','photo'));
	}

}