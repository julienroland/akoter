<?php


class NewsletterController extends BaseController {

	public function add(){

		$input = Input::all();

		$validator = Validator::make($input, array('newsletter'=>'required |email|unique:newsletters,email'));

			if( $validator->passes() ){

				$newsletter = new Newsletter;
				$newsletter->email = $input['newsletter'];
				$newsletter->save();

				Mailgun::send('emails.newsletter', array('input'=>$input), function($message) use($input){

					$message
					->to($input['newsletter'])
					->subject(Helpers::translation('Confirmation d\'ajout à la newsletter','fr', Auth::check() ? Config::get('var.lang')[Auth::user()->language_id] : App::getLocale() ));
				});

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