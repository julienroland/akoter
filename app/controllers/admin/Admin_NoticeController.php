<?php

use Carbon\Carbon;

class Admin_NoticeController extends \Admin_AdminController
{
	public function index()
	{	
		$notices = Notice::with('translation');


		if(Input::has('search')){

			$notices = $notices
			->join('users','notices.user_id','=','users.id')
			->join('translations', function($join){
				$join->on('notices.id','=','translations.content_id')
				->where('translations.content_type','=','Notice')
				->where('translations.key','=','text');
				
			})
			->where('notices.id','like','%'.Input::get('search').'%')
			->orWhere('users.first_name','like','%'.Input::get('search').'%')
			->orWhere('translations.value','like','%'.Input::get('search').'%')
			->orWhere('users.name','like','%'.Input::get('search').'%')
			->distinct()
			->select('users.id as user_id','notices.*');

		}
		$notices = $notices->with('user');
		
		$notices = $notices->paginate(20);


		return View::make('admin.notice.index')
		->with(compact('notices'));
	}

	public function validate( $notice ){

		$notice->validate = 1;
		$notice->save();

		return Redirect::back()
		->withSuccess('Avis bien validaté');
	}

	public function devalidate( $notice ){

		$notice->validate = 0;
		$notice->save();

		return Redirect::back()
		->withSuccess('Avis bien devalidaté');
	}

	public function edit( $notice ){
		
		return View::make('admin.notice.edit')
		->withNotice($notice);
	}

	public function remove( $notice ){

		Translation::whereContentId($notice->id)->delete();
		$notice->delete();

		return Redirect::back()
		->withSuccess('Avis bien supprimé');
	}

	

}