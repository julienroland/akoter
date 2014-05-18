<?php 
/**
* 
*/
class BuildingController extends BaseController
{
	
	public function gmGetBuilding()
	{

		$locations = Building::
		whereHas('location',function($query){
			$query
			->where( Config::get( 'var.l_validateCol' ) , 1 )
			->where( Config::get( 'var.l_placesCol' ) ,'>', 0 )
			->remember(Config::get('var.remember'), 'map_hasLocations');
		})
		->with(
			array(
				'location'=>function($query){
					$query->remember(Config::get('var.remember'), 'map_locations');
				},
				))
		->where('status_type', 1)
		->remember(Config::get('var.remember'), 'map_buildings')
		->get( );

		return Response::json($locations, 200);
	}
}