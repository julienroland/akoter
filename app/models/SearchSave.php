<?php

class SearchSave extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	public function user(){

		return $this->belongsTo('User'); 
	}

	public function searchType(){

		return $this->belongsTo('SearchType'); 
	}


	

	
}
