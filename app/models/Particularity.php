<?php

class Particularity extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	public function location(){

		return $this->belongsToMany('Location'); 
	}

	public function translation(){

		return $this->morphMany('Translation','content')
		->where(Config::get('var.t_langCol'), Session::get('langId')); 
	}

	public static function getList(){

		$particularityDump = Particularity::with(array('translation'=>function($query){

			$query->remember(Config::get('var.remember'), 'particularity.translation');

		}))->remember(Config::get('var.remember'), 'particularity')->get();

		$data = array();

		foreach($particularityDump as $particularity){

			$data[$particularity->id] = (object)array('value'=>$particularity->translation[0]->value,'icon'=>$particularity->icon);
		}
		
		return $data;
	}
	

	
}
