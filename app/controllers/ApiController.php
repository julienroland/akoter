<?php

class ApiController extends BaseController {

	public function index(){

		return View::make('api.index');
	}

	public function locations()
	{
		return View::make('api.locations');
	}

	public function schools()
	{
		return View::make('api.schools');
	}

	public function leave()
	{
		return Redirect::to('/');
	}

	public function allLocation(){
		
		return Response::json(Location::with('translation','typeLocation.translation')->valid()->get(), 200);
	}

	public function getTakeLocation( $take=null ){

		if(Helpers::isNotOk($take) || !is_numeric($take)){

			return Response::json('Invalid take data, it should be a valid integer', 400);
		}

		return Response::json(Location::with('translation','typeLocation.translation')->valid()->take( $take )->get(), 200);
	}

	public function inLocation(){

		$ids = Input::has('locationsArray') ? Input::get('locationsArray') : array('');

		return Response::json(Location::whereIn('id', $ids )->with('translation','typeLocation.translation')->valid()->get(), 200);
	}
}