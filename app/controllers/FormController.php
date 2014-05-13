<?php 
/**
* 
*/
class FormController extends BaseController
{

	public function getLocalityAutocomplete( $param ){

		return Locality::getLocationAutocomplete( )->toJson;

	}
	
}