<?php

class FileMessage extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	public function message(){

		return $this->belongsTo('Message'); 
	}


	

	
}
