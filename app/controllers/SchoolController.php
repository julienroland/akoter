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

	
	public function add(){

		$regions = Region::getList();

		$localities = Locality::getList();

		return View::make('school.add', array('page'=>'school','widget'=>array('schoolMap','select','validator')))
		->with(compact('regions','localities'));
	}
	
	public function store(){

		$input = Input::all();

		$validator = Validator::make($input, School::$rules);

		if($validator->passes()){

			$postal_id = Postal::where('start','like', $input['postal'][0].'%')->where('end','>',$input['postal'])->pluck('id');

			$school = new School;
			$school->name = $input['name']; 
			$school->short = $input['shortname']; 
			$school->street = $input['address']; 
			$school->web = $input['web']; 
			$school->latlng = $input['latlng']; 
			$school->postal_id = $postal_id; 
			$school->region_id = $input['region']; 
			$school->locality_id = $input['locality']; 

			if(Auth::check()){

				$school->user_id = Auth::user()->id; 

			}


			$school->save();

			return Redirect::back()
			->withSuccess(trans('validation.custom.ecoleAdded'));

		}else{

			return Redirect::back()
			->withInput()
			->withErrors($validator);
		}
	}
}