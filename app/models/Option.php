<?php

class Option extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	public function location(){

		return $this->belongsToMany('Location'); 
	}

	public function building(){

		return $this->belongsToMany('Building'); 
	}

	public function typeOption(){

		return $this->belongsTo('TypeOption'); 
	}

	public function translation(){

		return $this->morphMany('Translation','content')
		->where(Config::get('var.t_langCol'), Session::get('langId')); 
	}
	

	
}
