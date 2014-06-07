<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
class Agence extends Eloquent implements SluggableInterface {
	use SluggableTrait;

	protected $sluggable = array(
		'build_from' => 'name',
		'save_to'    => 'slug',
		);

	public static $rules = array(
		'name'=>'required',
		'address'=>'required',
		'nb_employer'=>'integer',
		'region'=>'required | alpha_dash',
		'locality'=>'required | alpha_dash',
		'postal'=>'required | numeric',
		'login'=>'required | unique:agences,login',
		'logo'=>'image | mimes:jpeg,jpg,gif,png',
		'password'=>'required',
		'password_ck'=>'required|same:password',
		'language'=>'required',
		'day'=>'required|integer|digits_between:1,2',
		'month'=>'required|integer|digits_between:1,2',
		'year'=>'required|integer|digits:4',
		);
	public static $rules_update = array(
		'name'=>'required',
		'address'=>'required',
		'nb_employer'=>'integer',
		'region'=>'required | alpha_dash',
		'locality'=>'required | alpha_dash',
		'postal'=>'required | numeric',
		'logo'=>'image | mimes:jpeg,jpg,gif,png',
		'password_ck'=>'same:password',
		'language'=>'required',
		'day'=>'required|integer|digits_between:1,2',
		'month'=>'required|integer|digits_between:1,2',
		'year'=>'required|integer|digits:4',
		);

	public static $join_rules = array(
		'login'=>'required ',
		'password_agence'=>'required',
		);

	public function boss()
	{
		return $this->belongsTo('User','user_id');
	}


	public function scopeValid($query)
	{
		return $query->whereValidate(1)->whereVisible(1);
	}

	public function user()
	{
		return $this->belongsToMany('User')
		->withTimestamps();
	}

	public function language()
	{
		return $this->hasMany('Language');
	}

	public function location()
	{
		return $this->hasMany('Location');
	}

	public function locality()
	{
		return $this->belongsTo('Locality');
	}

	public function region()
	{
		return $this->belongsTo('Region');
	}


}
