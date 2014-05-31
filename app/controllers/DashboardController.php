<?php

class DashboardController extends AccountBaseController {


	public function __construct( )
	{
		dd($this);
		View::share(array(
			'request'=>$this->nb_request(),
			'personnal'=>$this->personnalComplete(),
			'location'=>$this->$location
			));
	}


}