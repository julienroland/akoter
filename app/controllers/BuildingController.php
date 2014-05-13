<?php 
/**
* 
*/
class BuildingController extends BaseController
{
	
	public function gmGetBuilding()
	{

		/*$cData = Building::where('status_type', 1)->get();*/
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

	/*	if(!$cData)
		{	
			return Response::json(array('data'=>NULL,'error'=>'Error with the database, try again or contact us.'), 400);	

		}else{*/
		/*	$oData = array();

			foreach ($cData as $oOneData)
			{
		
				$constructObject = array(
					'id'=>$oOneData->id,
					'street'=>$oOneData->street,
					'number'=>$oOneData->number,
					'lat'=>Helpers::sGetLatLng($oOneData->latlng,'lat'),
					'lng'=>Helpers::sGetLatLng($oOneData->latlng,'lng')
					);
				array_push($oData, $constructObject );
			}*/

			return Response::json($locations, 200);
			/*}*/
		}
	}