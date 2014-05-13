<?php

class SearchType extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	public function searchSave(){

		return $this->hasMany('SearchSave'); 
	}


	

	
}
