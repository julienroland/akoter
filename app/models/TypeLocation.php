<?php

class TypeLocation extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);

	protected $table = 'types_locations';
	

	public function translation(){

		return $this->morphMany('Translation','content')
		->where(Config::get('var.t_langCol'), Session::get('langId')); 
	}

	public function location(){

		return $this->hasMany('Location'); 
	}

	public static function getList( $value = null ,$orderBy = 'id' , $orderWay  = 'asc'){

		if(Helpers::isNotOk($value)){

			$value = trans('form.all');
		}

		$typeLocationDump = TypeLocation::with(array('translation'=>function($query){

			$query->remember(Config::get('var.remember'), 'typeLocation.translation');

		}))->remember(Config::get( 'var.remember'), 'typeLocation' )->get();

		$data = array(
			''=>$value,
			);

		foreach( $typeLocationDump as $type){
			
			$data[$type->id] = $type->translation[0]->value;

		}

		return $data;

	} 

}
