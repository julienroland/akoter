<?php 
/**
* 
*/
class SchoolController extends BaseController
{
	

	public function gmGet(){

		$schools = School::whereStatusType(1)->remember( Config::get('var.remember'), 'schools' )->get();

		return Response::json($schools, 200);

	}

	
	
}