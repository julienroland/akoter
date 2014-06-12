<?php 
/**
* 
*/
class BuildingController extends BaseController
{
	
	public function gmGetBuilding()
	{

		$locations = Building::where('status_type', 1)
			->whereHas('location', function( $query ){
				$query->where(Config::get('var.l_validateCol'), 1)
				->where(Config::get('var.l_availableCol'), 1)
				->where(Config::get('var.l_placesCol'),'>', 0);
			})
			->get( );

		return Response::json($locations, 200);
	}

	public function getPhotos($type=null, $id=null){

		if(Helpers::isOk($id) && Helpers::isOk($type)){

			return Building::find($id)->photo()->whereType($type)->orderBy('order')->get();

		}

	}

	public function getLocations( $building ){

		return Response::json($building->whereId($building->id)->with(array('photo'=>function($query){
			$query->orderBy('order');
		},'availableLocation.typeLocation.translation','availableLocation.accroche','availableLocation.translation'=>function($query){
			$query->whereKey('slug');
		}))->firstOrFail(),200);
	}


}