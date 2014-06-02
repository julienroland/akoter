<?php 
/**
* 
*/
class SchoolController extends BaseController
{
	

	public function gmGet(){

		$schools = School::with(array('region.translation','locality'))->whereStatusType(1)->remember( Config::get('var.remember'), 'schools' )->get();

		return Response::json($schools, 200);

	}

	
	
}