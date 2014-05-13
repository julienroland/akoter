<?php

/**
*
* Subscription id 1 = free, 2  = bronze, 3 = prenium
*
**/

class Subscription extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	public function user(){

		return $this->hasMany('User'); 
	}


	

	
}
