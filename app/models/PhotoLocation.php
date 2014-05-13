<?php

class PhotoLocation extends Eloquent {

	protected $guarded = array();

	public static $sluggable = array(
		'build_from' => 'title',
		'save_to'    => 'slug',
		);
	protected $table = 'photos_locations';
	
	public static $rules = array(
		);

	public function location(){

		return $this->belongsTo('Location'); 
	}

	
}
