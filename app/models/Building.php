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

	public static $infos_general_rules = array(
		'garantee'=>'required | numeric',
		'situations'=>'required | min:10',
		'advert'=>'min:30',
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

	public function option()
	{
		return $this->belongsToMany('Option');
	}

	public function translation()
	{
		return $this->morphMany('Translate','content');
	}

	public static function getCurrentStep(){

		return Session::has('inscription.current') ? Session::get('inscription.current') : 0;

	}
}
