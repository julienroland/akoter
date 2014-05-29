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

}