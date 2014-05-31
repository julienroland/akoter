<?php 
/**
* 
*/
class BuildingController extends BaseController
{
	
	public function gmGetBuilding()
	{

		$locations = Helpers::cache(Building::where('status_type', 1)
		->get( ),'building_map');

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
		},'activeLocation.typeLocation.translation','activeLocation.accroche','activeLocation.translation'=>function($query){
			$query->whereKey('slug');
		}))->firstOrFail(),200);
	}


}