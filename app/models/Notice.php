<?php

class Notice extends Eloquent {


	protected $guarded = array();

	public static $rules = array(
		'notice'=>'min:50 | required',
		);

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function translation()
	{
		return $this->morphMany('Translation','content')
		->where(Config::get('var.t_langCol'), Session::get('langId'));
	}

	public static function getHomeNotices(  $nb_obj = 3, $orderBy = 'created_at'  , $orderWay = 'asc' , $lang_id = null  )
	{
		if($orderBy === 'date' || $orderBy === 'create' || $orderBy === 'created' || $orderBy === 'created_at')
		{

			$orderBy = 'created_at';

		}

		if(Helpers::isNotOk( $lang_id )){

			$lang_id = Helpers::getLangId(Session::get('langId'));
		}
		//[ photo, firstname, name, text ]
		/**
		
			TODO:
			- SELECT DISTINCT NOT WORKING ON USER
		
			**/

			$notices = Notice::with(
				array(
					'translation' => function( $query) use ( $lang_id ){ 
						$query
						->where(Config::get('var.t_langCol'), $lang_id)
						->where('key', 'text');
					},
					'user' => function($query){

						$query
						->distinct();

					},
					'user.locality',
					))
			->where( 'validate', 1 )
			->orderBy( $orderBy , $orderWay )
			->groupBy('user_id')
			->take( $nb_obj )
			->get();



			$dataNotices = array(
				'data' => array(),
				);
			$data = array();

			if(Helpers::isOk($notices)){

				foreach( $notices as $notice ){

					if(Helpers::isOk($notice->user) && Helpers::isOk($notice->translation)){

						$data['firstname'] = $notice->user->first_name;
						$data['name'] = $notice->user->name;
						$data['civility'] = $notice->user->civility;
						$data['text'] = $notice->translation[0]->value;
						$data['photo'] = $notice->user->photo;
						$data['locality'] = $notice->user->locality->name;
						$data['user_id'] = $notice->user->id;
						$data['postal'] = $notice->user->locality->postal;

						array_push($dataNotices['data'], (object)$data);
					}

				}
				$dataNotices['count'] =  count($notices);

				return (object)$dataNotices;

			}else{

				return (object)array(
					'errors'=> Lang::get('errors.l_noNotice'),
					'date'=> Carbon::now()->toDateTimeString(),
					);
			}
		}
	}
