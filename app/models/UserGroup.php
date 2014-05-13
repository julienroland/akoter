<?php

class UserGroup extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	public function user(){

		return $this->hasMany('User'); 
	}
	
	public function translation(){

		return $this->morphMany('Translation','content')
		->where(Config::get('var.t_langCol'), Session::get('langId')); 
	}


	

	
}
