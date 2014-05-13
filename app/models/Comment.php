<?php

class Comment extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	public function location(){

		return $this->belongsTo('Location'); 
	}

	public function user(){

		return $this->belongsTo('User'); 
	}
	

	
}
