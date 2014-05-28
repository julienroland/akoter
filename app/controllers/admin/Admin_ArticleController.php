<?php

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
	
}