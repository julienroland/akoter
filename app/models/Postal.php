<?php

class Postal extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	protected $table = 'postal';

	public function building()
	{
		return $this->hasMany('Building');
	}

	public function school()
	{
		return $this->hasMany('School');
	}

	public function region()
	{
		return $this->belongsTo('Region');
	}

}
