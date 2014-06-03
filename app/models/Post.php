<?php

class Post extends Eloquent {

	protected $guarded = array();
	
	public static $rules = array(
		'title'=>'required',
		'text'=>'required',
		);

	public function user(){

		return $this->belongsTo('User'); 
	}
	public function scopeArticle( $query ){

		$query->wherePublish(1)->wherePostTypeId( 1 );
	}
	public function translation(){

		return $this->morphMany('Translation','content')
		->where(Config::get('var.t_langCol'), Session::get('langId')); 
	}

	public function translations(){

		return $this->morphMany('Translation','content');
	}

	public static function getPosts( $page, $hook = null){

		if(Helpers::isOk($hook)){

			$posts = Post::with(array(
				'translation'
				))
			->where('content_type', $page )
			->where('content_position', $hook)
			->where('publish', 1)
			->get();

		}else{

			$posts = Post::with(array(
				'translation'
				))
			->where('content_type', $page )
			->where('publish', 1)
			->get();
		}

		//[ content , hook] 
		$dataPosts = array(
			'data'=>array());
		$data = array(
			'mod5'=>new stdClass(),
			);

		if(Helpers::isOk($posts)){

			foreach( $posts as $post ){

				if(Helpers::isOk($post->translation) && Helpers::isOk($post->content_position))
				{
					$id = $post->id;
					$data[$post->content_position]->$id = new stdClass();
					$data[$post->content_position]->$id->img = new stdClass();
					$data[$post->content_position]->$id->img->url = $post->img;
					$data[$post->content_position]->$id->img->width = $post->width;
					$data[$post->content_position]->$id->img->height = $post->height;


					foreach($post->translation as $translation){
						$k = $translation->key;
						$data[$post->content_position]->$id->$k = $translation->value;
					}
					

				}
			}
			
			$dataPosts['data']  =  (object)$data;
			$dataPosts['count'] = count($posts);

			return (object)$dataPosts;

		}
		
	}

	
}
