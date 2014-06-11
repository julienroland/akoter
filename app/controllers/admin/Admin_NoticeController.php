<?php

use Carbon\Carbon;

class Admin_NoticeController extends \Admin_AdminController
{
	public function index()
	{	
		$notices = Notice::with('translation');


		$search = $this->search(Input::all(),$notices);
		if(Helpers::isOk($search)){
			$notices = $search;
		}

		$notices = $notices->with('user')->orderBy('validate');
		
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