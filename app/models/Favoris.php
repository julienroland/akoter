<?php

class Favoris extends Eloquent {

	public function user()
	{
		return $this->belongsTo('User');
	}
	
	public function location()
	{
		return $this->belongsTo('Location');
	}

	


}
