<?php

class LocationDashboardController extends BaseController {


	public function index($user_slug, $location){

        $photo = $location->accroche->first();

    return View::make('account.owner.dashboard.index',array('page'=>'dashboard'))
		->with(compact('location','photo'));
	}

}