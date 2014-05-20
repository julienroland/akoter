<?php

class BuildingPhoto extends Eloquent {

	public static $rules = array(
		);
	protected $table ="buildings_photos";
	
	public function building()
	{
		return $this->belongsTo('Building');
	}

}
