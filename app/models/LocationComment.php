<?php

class LocationComment extends Eloquent {

	protected $table = 'locations_comments';
	
	public static $rules = array(
		);

	public function location(){

		return $this->belongsTo('Location'); 
	}

	public function scopeValid($query){

		$query->whereValidate(1);
	}

	public function scopeInvalid($query){

		$query->whereValidate(0);
	}

	public function user(){

		return $this->belongsTo('User'); 
	}

	public function translation()
	{
		return $this->morphMany('Translation','content')
		->where(Config::get('var.t_langCol'), Session::get('langId')); ;
	}

	public function translations()
	{
		return $this->morphMany('Translation','content');
	}
	

	
}
