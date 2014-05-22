<?php

class Region extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	public function building()
	{
		return $this->hasMany('Building');
	}

	public function school()
	{
		return $this->hasMany('School');
	}

	public function user()
	{
		return $this->hasMany('User');
	}

	public function postal()
	{
		return $this->hasMany('Postal');
	}

	public function agence(){

		return $this->hasMany('Agence');
	}
	
	public function translations(){

		return $this->morphMany('Translation','content');
	}
	
	public function translation()
	{
		return $this->morphMany('Translation','content')
		->where(Config::get('var.t_langCol'), Session::get('langId'));
	}

	public static function getList(){

		$dataDump = Region::with(array('translation'=>function($query){
			$query->orderBy('value','asc')->remember(Config::get('var.remember'), 'region.translation');
		}))->remember(Config::get('var.remember'), 'region')->get();

		$datas = array(

			'data'=>array(
				''=>'',
				),
			);

		foreach( $dataDump as $data){

			$datas['data'][$data->id] = $data->translation[0]->value;
		}
		

		return (object)$datas;
	}
}
