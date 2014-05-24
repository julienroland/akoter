<?php

class Translation extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		);
	
	protected $table = 'translations';

	public function language(){

		return $this->belongsTo('Language'); 
	}
	
    public function translate(){

        return $this->morphTo(); 
    }

	 public function scopeOfName($query, $type, $value)
    {
        return $query->whereContentType($type)->whereKey('name')->where('value','like','%'.$value.'%');
    }

	 public function scopeOfSlug($query, $type, $key, $save_to ,$value)
    {
        return $query->whereContentType($type)->whereKey($key)->where($save_to,'LIKE', $value.'%');
    }
	 public function scopeTitle($query)
    {
        return $query->whereKey('title');
    } 
    public function scopeName($query)
    {
        return $query->whereKey('name');
    }
	 public function scopeDescription($query)
    {
        return $query->whereKey('description');
    }
	 public function scopeSlug($query)
    {
        return $query->whereKey('slug');
    }

}
