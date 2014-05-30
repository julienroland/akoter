<?php

use Carbon\Carbon;

class Admin_NoticeController extends \Admin_AdminController
{
	public function index()
	{	
		$notices;

		return View::make('admin.notice.index')
		->with(compact('notices'));
	}

	

}