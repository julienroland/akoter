<?php 
/**
* 
*/
class LocationController extends BaseController
{
	public function show( $location ){

		$building = $location->building()->first();

		$photosLocation = $location->photo()->orderBy('order')->get();
		$photosBuilding = $building->photo()->orderBy('order')->get();

		$lightbox = ImageType::name('lightbox')->first();

		$small = ImageType::name('small')->first();

		$gallery = ImageType::name('gallery')->first();

		/*$typeLocation = $location->typeLocation->translation()->pluck('value');*/
		$region = $building->region->translation()->pluck('value');

		$typeLocation = $location->typeLocation->translation()->pluck('value');

		$building_translations = $building->translation()->get()->lists('value','key');
		
		$optionBuilding = Building::getOptions( $building );

		$optionLocation = Location::getOptions( $location );

		$particularities = $location->with('particularity.translation')->first()->particularity;

		$user = $building->user()->first();

		$translations = $location->translation()->get()->lists('value','key');

		$comments = LocationComment::valid()->whereLocationId($location->id)->with('translation','user')->get();

		$agence = $location->agence()->valid()->first();

		$favoris = $user->favoris()->whereLocationId($location->id)->first();

		$location->nb_views +=  1;
		$location->save();

		Session::put('oldPage_reserved', Request::url());
		
		return View::make('advert.show', array(
			'title'=>trans('title.showLocation',
				array(
					'typeLocation'=>$typeLocation,
					'region'=>$region,
					'title'=>Helpers::title($translations['title']),
					)),
			'description'=>trans('description.showLocation',array(
				'description'=>Helpers::description(strip_tags($translations['advert'])),
				)),
			'keywords'=>$translations['title'].','.$typeLocation.' '.$region.','.$user->first_name.' '.$user->name,
			'ogImage'=>Config::get('var.url').Helpers::imgDir(Config::get('var.img_locations_replace') ,array(
				'user_id'=>$user->id,
				'location_id'=>$location->id,
				)).Helpers::addBeforeExtension($location->accroche()->pluck('url'), 'medium'),
			'page'=>'advert',
			'widget'=>array(
				'tabs',
				'ui',
				'slideshow',
				'showMap',
				'gallery',
				'validator',
				),
			))
		->with(compact(
			'photos',
			'location',
			'photosLocation',
			'photosBuilding',
			'lightbox',
			'small',
			'gallery',
			'translations',
			'typeLocation',
			'region',
			'locality',
			'user',
			'building',
			'building_translations',
			'typeLocation',
			'optionBuilding',
			'optionLocation',
			'particularities',
			'comments',
			'agence',
			'favoris'
			));
	}
	public function addComment( $location ){

		$input = Input::all();

		$validator = Validator::make($input, Location::$comment_rules);

		if($validator->passes()){

			$comment = new LocationComment;
			$comment->rating = $input['note'];
			$comment->location_id = $location->id;
			$comment->user_id = Auth::user()->id;
			$comment->validate = 1;
			$comment->save();

			$location->nb_rate = $location->nb_rate + 1;
			$location->rating = $location->rating == 0 && $location->nb_rate == 0  ? $input['note']:(Helpers::isOk($location->rating) ? ($location->rating + $input['note'] ) / 2 : $input['note']) ;
			$location->save();


			foreach(Config::get('var.lang') as $id => $lang){

				$title = Helpers::translate($input['title'], Config::get('var.lang')[Auth::user()->language_id], $lang );

				$translation = new Translation;
				$translation->content_type = 'LocationComment';
				$translation->content_id = $comment->id;
				$translation->key = 'title';
				$translation->value = $title;
				$translation->language_id = $id;
				$translation->save();

				$text = Helpers::translate($input['text'], Config::get('var.lang')[Auth::user()->language_id], $lang );

				$translation = new Translation;
				$translation->content_type = 'LocationComment';
				$translation->content_id = $comment->id;
				$translation->key = 'text';
				$translation->value = $text;
				$translation->language_id = $id;
				$translation->save();	
			}

			return Redirect::back();

		}
		else{

			return Redirect::back('#comment-tab')
			->withInput()
			->withErrors($validator);
		}

	}
	public function getPhotos($type=null, $id=null){

		if(Helpers::isOk($id)){

			return Location::find($id)->photo()->orderBy('order')->get();

		}

	}

	public function getList( $orderBy = Null, $orderWay = null )
	{

		$input = Input::all();

		$typeLocation = TypeLocation::getList();

		$particularity = Particularity::getList();

		/**
		*
		* If input is not empty
		*
		**/
		
		if(isset( $input ) && Helpers::isOk( $input )){
			
			/**
			*
			* If list exist
			*
			**/
			
			if(  isset($input['list']) && Helpers::isOk($input['list'] ) && $input['list'] != "[]"){


				$locations = Location::getLocationsFilter( $input );

			}	
			else{

				/**
				*
				* If city is NOT present
				*
				**/
				
				if( !isset( $input['city'] ) || Helpers::isNotOk($input['city'])){

					if(isset($input['filter']) && Helpers::isOk($input['filter'])){

						$locations = Location::getLocationsFilter($input);

					}else{

						$locations = Location::getLocationsPaginateList();

					}

				}
				else{

					if( isset(explode(',', $input['city'])[1]) ){

						dd('ok1');
						$locality = explode(',', $input['city'])[0];
						$locality = ucfirst(Helpers::cleanString( $locality ));

					}
					elseif( isset(explode(' ', $input['city'])[1]) ){
						dd('ok2');
						$locality = explode(' ', $input['city'])[0];
						$locality = ucfirst(Helpers::cleanString( $locality ));

					}
					else{

						$locations = Location::getLocationsFilter( $input );

					}
					
				}

			}

		}
		else
		{


			$locations = Location::getLocationsPaginateList( );
		}

		$input = Input::except('page');

		Session::put('filter', $input );

		return View::make('listing.locations', array( 
			'page' => 'locations',
			'title'=>trans('title.listing',array('region'=>isset($input['city']) ? $input['city']:'')),
			'description'=>trans('description.listing',array('number'=>$locations->count(),'region'=>isset($input['city']) ? $input['city']:'')),
			'widget'=>array(
			'date',
			'ui',
			'form',
			'select',
			'grid',
			'listing',
			'map',
			)))
		->with(compact('locations','typeLocation','particularity','input'));
	}

}