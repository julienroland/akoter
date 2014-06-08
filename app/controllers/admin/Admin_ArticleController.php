<?php

use Carbon\Carbon;

class Admin_ArticleController extends \Admin_AdminController
{
	public function index()
	{	
		$articles = Post::with(array('translation'=>function($query){
			$query->whereKey('title');
		},'user'));

		if(Input::has('search')){
			$articles = $articles
			->join('users','posts.user_id','=','users.id')
			->join('translations', function($join) {
				$join->on('posts.id','=','translations.content_id')
				->where('translations.content_type','=','Post')
				->where('translations.key','=','title');
				
			})
			->orWhere('translations.value','like','%'.Input::get('search').'%')
			->orWhere('posts.id','like','%'.Input::get('search').'%')
			->orWhere('users.id','like','%'.Input::get('search').'%')
			->orWhere('users.first_name','like','%'.Input::get('search').'%')
			->orWhere('users.name','like','%'.Input::get('search').'%')
			->orWhere('posts.content_type','like','%'.Input::get('search').'%')
			->orWhere('posts.content_position','like','%'.Input::get('search').'%')
			->select('users.name','posts.*');
		}

		$articles = $articles->paginate(20);

		return View::make('admin.article.index')
		->with(compact('articles'));
	}

	public function add(){
		$postTypes = PostType::all()->lists('name','id');
		return View::make('admin.article.add', array('widget'=>array('editor')))
		->with(compact('postTypes'));
	}
	public function store(  ){
		$input = Input::all();
		
		$validator = Validator::make($input, Post::$rules);

		if($validator->passes()){

			$post = new Post;
			$post->content_type = $input['page'];
			$post->content_position = $input['position'];

			if(Input::hasFile('file')){
/*
				$post->img = ;
				$post->width = ;
				$post->height = ;*/
			}

			$post->publish = isset($input['publish']) ? true : false;
			$post->user_id = Auth::user()->id;
			$post->post_type_id = $input['type'];
			$post->save();

			foreach(Config::get('var.lang') as $id => $lang){

				$title = new Translation;

				$title->key = 'title';
				$title->content_id = $post->id;
				$title->content_type = 'Post';
				$title->value = Helpers::translate($input['title'], null, $lang);
				$title->language_id = $id;
				$title->save();

				$content = new Translation;

				$content->key = 'content';
				$content->content_id = $post->id;
				$content->content_type = 'Post';
				$content->value = Helpers::translate($input['text'], null, $lang);
				$content->language_id = $id;
				$content->save();

				$slug = new Translation;

				$slug->key = 'slug';
				$slug->content_id = $post->id;
				$slug->content_type = 'Post';
				$slug->value = Str::slug(Helpers::translate($input['title'], null, $lang).' '.$post->id);
				$slug->language_id = $id;
				$slug->save();


			}

			return Redirect::to('admin/articles')
			->withSucess('Article bien modifié');

		}else{

			return Redirect::back()
			->withInput()
			->withErrors($validator);

		}
		
	}
	public function edit( $post ){

		return View::make('admin.article.show', array('widget'=>array('editor')))
		->withPost($post);
	}
	
	public function unpublish( $post ){

		$post->publish = 0;
		$post->save();

		return Redirect::back();
	}

	public function publish( $post ){

		$post->publish = 1;
		$post->save();

		return Redirect::back();
	}

	public function update( $post ){
		$input = Input::all();

		$validator = Validator::make($input, Post::$rules);

		if($validator->passes()){

			foreach(Config::get('var.lang') as $id => $lang){

				$translation = $post->translations()->whereLanguage_id($id);

				$title = $post->translations()->whereLanguage_id($id)->whereKey('title')->first();
				$title->value = Helpers::translate($input['title'], null, $lang);
				$title->save();

				$content = $post->translations()->whereLanguage_id($id)->whereKey('content')->first();
				$content->value = Helpers::translate($input['text'], null, $lang);
				$content->save();

				$slug = $post->translations()->whereLanguage_id($id)->whereKey('slug')->first();
				$slug->value = Str::slug(Helpers::translate($input['title'], null, $lang).' '.$post->id);
				$slug->save();

			}
			
			$post->content_type = $input['page'];
			$post->content_position = $input['position'];
			$post->save();

			return Redirect::to('admin/articles')
			->withSucess('Article bien crée');

		}else{

			return Redirect::back()
			->withInput()
			->withErrors($validator);

		}
		
	}
	public function addPhoto( $post ){

		if(Input::hasFile('photo')){

			$destinationPath = Config::get('var.img_posts_dir');

			$timestamp = Carbon::now()->timestamp;

			$filename = sha1($timestamp).'.jpg';

			$filenameRetina = sha1($timestamp).'@2x.jpg';

			File::exists( $destinationPath ) or File::makeDirectory( $destinationPath , 0777, true, true);

			$image = Image::make(Input::file('photo'))->grab(Config::get('var.articles_photo.width'), Config::get('var.articles_photo.height'))->save($destinationPath.$filename)->encode('jpg', Config::get('var.img_quality'));

			$imageRetina = Image::make(Input::file('photo'))->grab(2 * Config::get('var.articles_photo.width'), 2 * Config::get('var.articles_photo.height'))->save($destinationPath.$filenameRetina)->encode('jpg', Config::get('var.img_quality'));

			$this->removePhoto($post);

			$post->img = $filename;
			$post->save();

			return Redirect::back()
			->withSuccess('Image bien ajouté');
		}
	}
	public function delete( $article ){

		$article->delete();

		return Redirect::back()
		->withSuccess('Article correctement supprimé');
	}

	public function removePhoto( $post ){

		$destinationPath = Config::get('var.img_posts_dir');

		if(File::exists( $destinationPath.$post->img )){

			File::delete( $destinationPath.$post->img );

			if(File::exists( Helpers::retinaFilename($destinationPath.$post->img, '@2x') )){

				File::delete( Helpers::retinaFilename($destinationPath.$post->img, '@2x') );
			}

			$post->img = '';
			$post->save();

			return true;
		}
		else{

			return false;
		}
	}
}