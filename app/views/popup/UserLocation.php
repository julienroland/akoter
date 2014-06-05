<?php

class UserLocation extends Eloquent {

	protected $table = "user_location";

	public function getDates()
	{
		return array('created_at', 'updated_at', 'begin','end');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}
	
	public function location()
	{
		return $this->belongsTo('Location');
	}

	


}
