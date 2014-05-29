<?php

use Carbon\Carbon;

class Admin_UserController extends \Admin_AdminController
{
	public function index()
	{	
		$users = User::with('role','language')->orderBy('created_at','desc')->get();

		return View::make('admin.user.index')
		->with(compact('users'));
	}

	public function disconnect()
	{
		if(Auth::check()){

			Auth::logout();

			Session::flush();

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

}