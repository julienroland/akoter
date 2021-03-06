<?php

class Building extends Eloquent {

	protected $guarded = array();

	public static $rules = array();

	public static $inscription_rules = array(
		'region'=>'required',
		'locality'=>'required',
		'address'=>'required',
		'postal'=>'required|integer',
		'number'=>'required|integer',
		);

	public static $infos_general_rules = array(
		'situations'=>'required|array',
		'situations.en'=>'required_without_all:situations.fr,situations.nl',
		'situations.en'=>'min:30 |max:10000',
		'situations.fr'=>'min:30 |max:10000',
		'situations.nl'=>'min:30 |max:10000',
		'advert.en'=>'required_without_all:advert.fr,advert.nl',
		'advert.en'=>'min:50 |max:10000',
		'advert.fr'=>'min:50 |max:10000',
		'advert.nl'=>'min:50 |max:10000',
		);


	public function user()
	{
		return $this->belongsTo('User');
	}
	public function userValid()
	{
		return $this->belongsTo('User')
		->whereEmailComfirm(1)->whereVPalidate(1);
	}

	public function scopeInvalid($query){
		$query->whereStatusType( 0 );
	}
	public function photo()
	{
		return $this->hasMany('BuildingPhoto');
	}

	public function location()
	{
		return $this->hasMany('Location');
	}

	public function invalidLocation()
	{
		return $this->hasMany('Location')
		->where('register_step','<', 7 );
	}

	public function waitingLocation()
	{
		return $this->hasMany('Location')
		->where('validate', 0 )
		->where('register_step', '>', 6 );
	}

	public function availableLocation()
	{
		return $this->hasMany('Location')
		->whereValidate( 1 )
		->whereAvailable( 1 )
		->where( 'register_step','>', 6 );
	}

	public function activeLocation()
	{
		return $this->hasMany('Location')
		->whereValidate( 1 )
		->where( 'register_step','>', 6 );
	}

	public function postal()
	{
		return $this->belongsTo('Postal');
	}

	public function locality()
	{
		return $this->belongsTo('Locality');
	}

	public function region()
	{
		return $this->belongsTo('Region');
	}

	public function option()
	{
		return $this->belongsToMany('Option');
	}

	public function translation()
	{
		return $this->morphMany('Translation','content')
		->where(Config::get('var.t_langCol'), Session::get('langId')); ;
	}

	public function translations()
	{
		return $this->morphMany('Translation','content');
	}

	public static function getCurrentStep(){

		return Session::has('inscription.current') ? Session::get('inscription.current') : 0;

	}

	public static function getOptions($building){

		$dump = $building->option()->with('translation')->get();

		$data = array();

		foreach($dump as $option){

			$data[$option->id]  = isset($option->translation[0]) ? $option->translation[0]->value: '';

		}
		return Collection::make($data);

	}
}
