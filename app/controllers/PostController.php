<?php 
/**
* 
*/
class PostController extends BaseController
{
	
	public function show( $slug )
	{
		$id = Translation::whereContentType('Post')->whereKey('slug')->whereValue( $slug )->firstOrFail()->content_id;

		$post = Post::find($id)->with('translation')->firstOrFail();

		$otherPosts = Post::where('id','!=',$id)->with('translation')->take(3)->get();

		return View::make('posts.show', array('page'=>'articles'))
		->withPost($post)
		->with(compact('otherPosts'));
	}

}