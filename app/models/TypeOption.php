<?php

class TypeOption extends Eloquent {

	protected $guarded = array();
	
	protected $table = "types_options";

	public static $rules = array(
		);

	public function typeOption(){

		return $this->hasMany('Option'); 
	}

	public function scopeName( $query, $type){

		$query->whereName($type);
	}
	

	
}
