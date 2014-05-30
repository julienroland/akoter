<?php 
/**
* 
*/
class NoticeController extends BaseController
{
	
	public function add( $user_slug )
	{

		return View::make('notice.add', array('page'=>'notice','widget'=>array('validator')));
		
	}

	public function store( $user_slug )
	{
		$input = Input::all();
		
		$validator = Validator::make($input, Notice::$rules);

		if($validator->passes()){

			$notice = new Notice;
			$notice->user_id = Auth::user()->id;
			$notice->save();

			foreach(Config::get('var.lang') as $id => $lang){

				$translation = new Translation;
				$translation->content_type = 'Notice';
				$translation->content_id = $notice->id;
				$translation->key = 'text';
				$translation->value = Helpers::translate($input['notice'], null, $lang);
				$translation->language_id = $id;
				$translation->save();

			}

			return Redirect::back()
			->withSuccess(trans('validation.custom.success_add_notice'));

		}
		else{

			return Redirect::back()
			->withInput()
			->withFields($validator->failed())
			->withErrors($validator);
		}
		return View::make('notice.add', array('page'=>'notice'));
		
	}



}