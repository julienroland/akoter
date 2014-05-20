<?php


class ImageType extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = "images_types";

	public function photoBuilding(){

		return $this->hasMany('photoBuilding');
	}
}