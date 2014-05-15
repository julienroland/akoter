<?php

class Building extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	public static $inscription_rules = array(
		'region'=>'required',
		'locality'=>'required',
		'address'=>'required',
		'postal'=>'required|integer',
		'number'=>'required|integer',
		);


	public function user()
	{
		return $this->belongsTo('User');
	}

	public function location()
	{
		return $this->hasMany('Location');
	}

	public function invalidLocation()
	{
		return $this->hasMany('Location')
		->whereValidate( 0 );
	}


	public function postal()
	{
		return $this->belongsTo('Postal');
	}

	public function locality()
	{
		return $this->belongsTo('Locality');
	}

	public function region()
	{
		return $this->belongsTo('Region');
	}

	public static function getCurrentStep(){

		return Session::has('inscription.current') ? Session::get('inscription.current') : 0;

	}
}
