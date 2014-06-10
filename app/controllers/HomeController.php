<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index(){

		$locations = Location::getLocationsList( 12, null, 'created_at' , 'desc');
		
		$notices = Notice::getHomeNotices( 3 );

		$posts = Post::getPosts( 'home' );

		$nb_locations = Location::with(array('building'=>function($query){
			$query->whereStatusType( 1 );
		}))->whereValidate( 1 )->count();

		return View::make('home.index',array('title'=>trans('title.homepage'),'description'=>trans('description.homepage'),'page'=>'home','widget'=>array(
			'map',
			'slider',
			'mousewheel',
			'form',
			'grid',
			'slideshow',
			)))
		->with(compact(array(
			'locations',
			'notices',
			'posts',
			'nb_locations',
			)));
		
	}

}