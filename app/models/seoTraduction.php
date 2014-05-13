<?php


class SeoTraduction extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'seo_traduction';

	public function seo(){

		return $this->belongsTo('seo');
	}

}