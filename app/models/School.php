<?php

class School extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		'address'=>'required',
		'region'=>'required',
		'locality'=>'required',
		'postal'=>'required| integer',
		'name'=>'required',
		'shortname'=>'max:5',
		'web'=>'url',
		'latlng'=>'required',
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
