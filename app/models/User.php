<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
class User extends Eloquent implements UserInterface, RemindableInterface, SluggableInterface {
	use SluggableTrait;

	public function getDates()
	{
		return array('created_at', 'updated_at', 'connected_at','deleted_at');
	}
	/**
	*
	* Slug
	*
	**/
	
	public static $rules = array(
		'email_co' => 'required|email',
		'password_co'=>'required|min:5',
		);
	public static $inscription_rules = array(
		'first_name'=>'required|alpha ',
		'name'=>'required |alpha',
		'email'=>'required | email|unique:users,email',
		'civility'=>'required ',
		'day'=>'required |numeric',
		'month'=>'required |numeric',
		'year'=>'required |numeric|digits:4',
		'password'=>'required |min:5|alpha_num',
		'password_ck'=>'required|same:password|min:5|alpha_num ',
		
		);
	public static $personnals_rules = array(
		'first_name'=>'required |alpha | not_in:null',
		'name'=>'required |alpha | not_in:null',
		'email'=>' required | email |not_in:null',
		'email_bc'=>'email|different:email',
		'civility'=>'required | not_in:null',
		'address'=>'required | not_in:null ',
		'region'=>'required | not_in:null',
		'locality'=>'required | not_in:null',
		'postal'=>'required | not_in:null |integer',
		'phone'=>'required | not_in:null|numeric',
		);

	public static $personnals_exist = array(
		'first_name'=>'required | not_in:null',
		'name'=>'required | not_in:null',
		'email'=>'required | email |not_in:null',
		'civility'=>'required | not_in:null',
		'address'=>'required | not_in:null',
		'region'=>'required | not_in:null',
		'locality'=>'required | not_in:null',
		'postal'=>'required | not_in:null',
		'phone'=>'required | not_in:null',
		);

	public static $params_rules = array(
		'email'=>'required | email |not_in:null',
		'password'=>'required | min:5',
		'password_ck'=>'required | min:5 | same:password',
		'language'=>'required ',
		);

	public static $params_rules_password = array(
		'email'=>'required | email |not_in:null',
		'password'=>'',
		'password_ck'=>'',
		'language'=>'required ',
		);

	public static $config_rules = array(
		'email-comfirm'=>'required | accepted | not_in:null',
		);
	protected $sluggable = array(
		'build_from' => 'fullname',
		'save_to'    => 'slug',
		);


	public function getFullnameAttribute() {
		return $this->first_name . ' ' . $this->name;
	}
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public static function personnalsRequiredNotComplete( $data ){

		$validator = Validator::make($data, User::$personnals_exist);

		if($validator->fails()){

			$failed = $validator->failed();

			$nb_failed = count($failed );

			return (object)array('failed'=>$failed, 'count'=>$nb_failed, 'total'=>count(User::$personnals_rules));

		}
		else{

			return false;
		}
	}

	public function building(){

		return $this->hasMany('Building');
	}

	public function inactiveBuilding(){

		return $this->hasMany('Building')
		->whereStatusType(0);
	}

	public function activeBuilding(){

		return $this->hasMany('Building')
		->whereStatusType(1);
	}

	public function profiles()
	{
		return $this->hasMany('Profile');
	}

	public function currentLocation()
	{
		return $this->belongsToMany('Location','user_location')
		->where('status', 1);
	}

	public function previousLocation()
	{
		return $this->belongsToMany('Location','user_location')
		->where('status', 0);
	}

	public function allLocations()
	{
		return $this->belongsToMany('Location','user_location');
	}
	
	public function notice(){

		return $this->hasMany('Notice');
	}

	public function agence(){

		return $this->hasMany('Agence');
	}

	public function subscription()
	{
		return $this->belongsTo('Subscription');
	}
	
	public function message()
	{
		return $this->hasMany('Message');
	}
	
	public function post()
	{
		return $this->hasMany('Post');
	}

	public function locality()
	{
		return $this->belongsTo('Locality');
	}

	public function region()
	{
		return $this->belongsTo('Region');
	}

	public function language()
	{
		return $this->belongsTo('Language');
	}

	public function role()
	{
		return $this->belongsTo('Role');
	}

	public function userGroup()
	{
		return $this->belongsTo('UserGroup');
	}

	public static function getActiveLocations( $user ){

		return User::with(array(
			'activeBuilding'=>function($query) use($user){

				$query->remember(Config::get('var.remember'), 'activeBuilding'.$user->id);

			},
			'activeBuilding.location'=>function( $query ) use($user){

				$query->has('currentUser')->remember(Config::get('var.remember'), 'activeBuilding.location'.$user->id);

			},'activeBuilding.location.photo'=>function($query) use($user){

				$query->where('order', 1 )->remember(Config::get('var.activeBuilding.location.photo'.$user->id));

			},'activeBuilding.location.translation'=>function($query) use($user){

				$query->whereKey('slug')->remember(Config::get('var.remember'),'activeBuilding.location.translation'.$user->id);

			}))->whereId($user->id)->remember(Config::get('var.remember'), 'user->id'.$user->id)->first();
	}

	public static function getWaitingLocations( $user ){

		return User::with(array('activeBuilding'=>function($query) use($user){

			$query->remember(Config::get('var.remember'), 'activeBuilding'.$user->id);

		},
		'activeBuilding.location'=>function( $query ) use($user){

			$query->has('currentUser','<',1)->remember(Config::get('var.remember'), 'activeBuilding.location'.$user->id);

		}))->whereId($user->id)->remember(Config::get('var.remember'), 'user->id'.$user->id)->first();
	}

	public static function getInvalidLocations( $user ){

		return User::with(array('activeBuilding'=>function($query) use($user){

			$query->remember(Config::get('var.remember'), 'activeBuilding'.$user->id);

		},
		'activeBuilding.invalidLocation'=>function($query) use($user){

			$query->remember(Config::get('var.remember'), 'invalidLocation'.$user->id);

		}))->whereId($user->id)->remember(Config::get('var.remember'), 'user->id'.$user->id)->first();

	}
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}


}