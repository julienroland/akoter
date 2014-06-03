<?php

class Agence extends Eloquent {

	public static $sluggable = array(
		'build_from' => 'name',
		'save_to'    => 'slug',
		);

	public static $rules = array(
		'name'=>'required',
		'address'=>'required',
		'nb_employer'=>'integer',
		'region'=>'required | alpha_dash',
		'locality'=>'required | alpha_dash',
		'postal'=>'required | numeric',
		'login'=>'required',
		'logo'=>'image | mimes:jpeg,jpg',
		'password'=>'required',
		'password_ck'=>'required|same:password',
		'language'=>'required',
		'day'=>'required|integer|digits_between:1,2',
		'month'=>'required|integer|digits_between:1,2',
		'year'=>'required|integer|digits:4',
		);

	public function boss()
	{
		return $this->belongsTo('User');
	}

	public function user()
	{
		return $this->belongsToMany('User')
		->withTimestamps();
	}
	public function language()
	{
		return $this->hasMany('Language');
	}

	public function locality()
	{
		return $this->belongsTo('Locality');
	}

	public function region()
	{
		return $this->belongsTo('Agence');
	}


}
