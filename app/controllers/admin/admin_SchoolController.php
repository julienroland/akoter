<?php

use Carbon\Carbon;

class Admin_SchoolController extends \Admin_AdminController
{
	public function index()
	{	
		$schools = School::with('postal');

		if(Input::has('search')){
			$schools = $schools
			->where('id','like','%'.Input::get('search').'%')
			->orWhere('name','like','%'.Input::get('search').'%')
			->orWhere('short','like','%'.Input::get('search').'%')
			->orWhere('street','like','%'.Input::get('search').'%')
			->orWhere('web','like','%'.Input::get('search').'%');
		}

		$schools =  $schools->orderBy('status_type','asc')->paginate(20);

		return View::make('admin.school.index')
		->with(compact('schools'));
	}


	public function validate( $school ){

		$school->status_type = 1;
		$school->save();

		return Redirect::back()
		->withSuccess('Ecole bien validaté');
	}

	public function devalidate( $school ){

		$school->status_type = 0;
		$school->save();

		return Redirect::back()
		->withSuccess('Ecole bien devalidaté');
	}

	public function delete( $school ){

		$school->delete();

		return Redirect::back()
		->withSuccess('Ecole bien supprimé');
	}
}