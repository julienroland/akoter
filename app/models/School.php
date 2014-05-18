<?php

class School extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	public function postal(){

		return $this->belongsTo('Postal'); 
	}
	
	public function region(){

		return $this->belongsTo('Region'); 
	}

	public function locality(){

		return $this->belongsTo('Locality'); 
	}

	
}
