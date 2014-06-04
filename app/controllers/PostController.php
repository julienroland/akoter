<?php 
/**
* 
*/
class PostController extends BaseController
{
	public function index(){

		$posts = Post::article()->with('translation')->get();

		return View::make('posts.index', array('page'=>'articles'))
		->withPosts($posts);

	}
	public function show( $slug )
	{
		$id = Translation::whereContentType('Post')->whereKey('slug')->whereValue( $slug )->firstOrFail()->content_id;

		$post = Post::whereId($id)->with('translation')->firstOrFail();

		$otherPosts = Post::where('id','!=',$id)->article()->with('translation')->take(3)->get();

		return View::make('posts.show', array('page'=>'articles'))
		->withPost($post)
		->with(compact('otherPosts'));
	}

}