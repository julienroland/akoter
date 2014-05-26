<?php 
/**
* 
*/
class LocationController extends BaseController
{
	public function voir( $location ){
		$building = $location->building()->first();

		$photosLocation = $location->photo()->orderBy('order')->get();
		$photosBuilding = $building->photo()->orderBy('order')->get();

		$lightbox = ImageType::name('lightbox')->first();

		$small = ImageType::name('small')->first();

		$gallery = ImageType::name('gallery')->first();

		$typeLocation = $location->typeLocation->translation()->pluck('value');
		$region = $building->region->translation()->pluck('value');

		$typeLocation = $location->typeLocation->translation()->pluck('value');
		
		$building_translations = $building->translation()->get()->lists('value','key');
		
		$optionBuiding = Building::getOptions( $building );

		$user = $building->user()->first();

		$translations = $location->translation()->get()->lists('value','key');

		return View::make('advert.show', array(
			'page'=>'advert',
			'widget'=>array(
				'tabs',
				'ui',
				'slideshow',
				'showMap',
				'gallery',
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
			'optionBuiding'
			));
	}

	public function getPhotos($type=null, $id=null){

		if(Helpers::isOk($id) && Helpers::isOk($type)){

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
		
		return View::make('listing.locations', array( 'page' => 'locations','widget'=>array(
			'date',
			'ui',
			'form',
			'select',
			'grid',
			'listing',
			'map',
			'slider')))
		->with(compact('locations','typeLocation','particularity','input'));
	}

}