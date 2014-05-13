<?php
/**
*
* Language id 1 = fr; 2 = en; 3 = nl
*
**/

class Language extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	public function translation(){

		return $this->hasMany('Translation'); 
	}
	
	public function agence(){

		return $this->hasMany('Agence');
	}

	public function user(){

		return $this->hasMany('User');
	}

	
}
