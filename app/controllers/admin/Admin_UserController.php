<?php

use Carbon\Carbon;

class Admin_UserController extends \Admin_AdminController
{
	public function index()
	{	
		$users = User::with('role')->with('role','language');

		if(Input::has('search')){
			$users = $users
			->where('id','like','%'.Input::get('search').'%')
			->orWhere('first_name','like','%'.Input::get('search').'%')
			->orWhere('name','like','%'.Input::get('search').'%')
			->orWhere('email','like','%'.Input::get('search').'%');
		}

		$users =  $users->orderBy('validate','asc')->paginate(20);

		return View::make('admin.user.index')
		->with(compact('users'));
	}

	public function disconnect()
	{
		if(Auth::check()){

			Auth::logout();

			/*Session::flush();*/

			return Redirect::guest('/');
		}
		else{

			return Redirect::guest('/');

		}
		
	}

	public function leave()
	{
		return Redirect::to('/');
	}


	public function validate( $user ){

		$user->validate = 1;
		$user->save();

		return Redirect::back()
		->withSuccess('Utilisateur bien validaté');
	}

	public function devalidate( $user ){

		$user->validate = 0;
		$user->save();

		return Redirect::back()
		->withSuccess('Utilisateur bien devalidaté');
	}
}