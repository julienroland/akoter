<?php

class Admin_BuildingController extends \Admin_AdminController
{
	public function index()
	{	
		$unverified = Building::invalid()->with('user')->paginate(20);

		return View::make('admin.building.index')
		->with(compact('unverified'));
	}

	public function delete( $building ){

		dd('supp building');

		$destinationPath = public_path().'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.buildings_dir').$building->id;

		File::cleanDirectory( $destinationPath );

		$locations = $building->location()->with('translations')->get();

		foreach( $locations as $location){

			$destinationPath = public_path().'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.locations_dir').$location->id;

			File::cleanDirectory( $destinationPath );

		}

		$building->translations()->delete();
		$locations->delete();
		$building->location()->delete();

		return Redirect::back()
		->withSuccess('Bâtiment bien supprimé !');
	}

	public function validate( $building ){

		$building->status_type = 1;
		$building->save();

		Cache::forget('building_map');
		
		return Redirect::back()
		->withSuccess('Building bien validaté');
	}


	public function contact( $building ){
		
		$user = $building->user()->first();

		return View::make('admin.building.contact', array('page'=>'admin','widget'=>array('editor')))
		->with(compact('building','user'));
	}

	public function sendMessage( $building, $user){

		$input = Input::all();

		if(isset($input['translate'])  ){ //&& Config::get('var.lang')[$user->language_id] !== 'fr'
		$input['subject'] = Helpers::translate($input['subject'], 'fr', Config::get('var.lang')[$user->language_id]);
		$input['text'] = Helpers::translate($input['text'], 'fr', Config::get('var.lang')[$user->language_id]);
	}

	Mailgun::send('admin.emails.contact_building', array('input'=>$input), function($message) use($input, $user)
	{

		$message->to($user['email'], $user['name'].' '.$user['name'])->subject($input['subject']);

	});

	return Redirect::to('admin/buildings')
	->withSuccess('Message envoyé !');
}
}