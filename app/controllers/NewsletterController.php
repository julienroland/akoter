<?php


class NewsletterController extends BaseController {

	public function add(){

		$input = Input::all();

		$validator = Validator::make($input, array('newsletter'=>'required |email|unique:newsletters,email'));

			if( $validator->passes() ){

				$newsletter = new Newsletter;
				$newsletter->email = $input['newsletter'];
				$newsletter->save();

				return Redirect::back()
				->withSuccessNewsletter(trans('validaton.custom.newsletter'));

			}else{

				return Redirect::back()
				->withInput()
				->withFields($validator->failed())
				->withErrors($validator, 'newsletter');

			}
	}

	
}