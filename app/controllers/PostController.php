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
		$translations = $post->translation->lists('value','key');

		return View::make('posts.show', array(
			'page'=>'articles',
			'title'=>$translations['title'],
			'description'=>substr(strip_tags(html_entity_decode($translations['content'])),0,170)
			))
		->withPost($post)
		->with(compact('otherPosts'));
	}

}