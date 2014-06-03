<?php

class Admin_AdvertController extends \Admin_AdminController
{
	public function index()
	{	
		$unverified = Location::with('building.user');

		
		if(Input::has('search')){
			$unverified = $unverified
			->join('buildings','locations.building_id','=','buildings.id')
			->join('users','buildings.user_id','=','users.id')
			->orWhere('locations.id','like','%'.Input::get('search').'%')
			->orWhere('users.id','like','%'.Input::get('search').'%')
			->orWhere('users.first_name','like','%'.Input::get('search').'%')
			->orWhere('users.name','like','%'.Input::get('search').'%')
			->select('users.name as us','buildings.id as bud','locations.*');
		}

		$unverified = $unverified->where('locations.validate',0)->with('building.user')->paginate(20);

		return View::make('admin.advert.index')
		->with(compact('unverified'));
	}

	public function delete( $location ){

		$destinationPath = public_path().'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.buildings_dir').$location->id;

		File::cleanDirectory( $destinationPath );

		$locations = $location->location()->with('translations')->get();

		foreach( $locations as $location){

			$destinationPath = public_path().'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.locations_dir').$location->id;

			File::cleanDirectory( $destinationPath );

		}

		$location->translations()->delete();
		$locations->delete();
		$location->location()->delete();

		return Redirect::back()
		->withSuccess('Bâtiment bien supprimé !');
	}

	public function validate( $location ){

		$location->validate = 1;
		$location->save();

		return Redirect::back()
		->withSuccess('Annonce bien validaté');
	}


	public function contact( $location ){
		$user = $location->building->user()->first();

		return View::make('admin.advert.contact', array('page'=>'admin','widget'=>array('editor')))
		->with(compact('location','user'));
	}

	public function sendMessage( $location, $user){

		$input = Input::all();

		if(isset($input['translate'])  ){ //&& Config::get('var.lang')[$user->language_id] !== 'fr'
		$input['subject'] = Helpers::translate($input['subject'], 'fr', Config::get('var.lang')[$user->language_id]);
		$input['text'] = Helpers::translate($input['text'], 'fr', Config::get('var.lang')[$user->language_id]);
	}


	Mailgun::send('admin.emails.contact_building', array('input'=>$input), function($message) use($input, $user)
	{

		$message->to($user['email'], $user['name'].' '.$user['name'])->subject($input['subject']);

	});

	return Redirect::to('admin/locations')
	->withSuccess('Message envoyé !');
}
}