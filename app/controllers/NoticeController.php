<?php 
/**
* 
*/
class NoticeController extends BaseController
{
	
	public function add( $user_slug )
	{

		return View::make('notice.add', array('page'=>'notice'));
		
	}



}