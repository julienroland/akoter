<?php

class PostType extends Eloquent {

	protected $table = "posts_types";

	public function post()
	{
		return $this->hasMany('Post');
	}
	

	


}
