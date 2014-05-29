<?php

use Carbon\Carbon;

class Admin_ArticleController extends \Admin_AdminController
{
	public function index()
	{	
		$articles = Post::with(array('translation'=>function($query){
			$query->whereKey('title');
		},'user'))->orderBy('created_at','desc')->get();

		return View::make('admin.article.index')
		->with(compact('articles'));
	}
	public function show( $post ){

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

	public function edit( $post ){
		$input = Input::all();
dd(Input::all());
		$validator = Validator::make($input, Post::$rules)

		if($validator->passes()){

			return Redirect::back()
			->withSucess('Article bien modifié'),

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