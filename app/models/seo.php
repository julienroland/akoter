<?php


class Seo extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	public function seoTraduction(){

		return $this->hasMany('seoTraduction');
	}

	public function seo(){

		return $this->morphTo();
	}

}