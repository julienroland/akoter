<?php

class ContactController extends BaseController {

	public function contactUs(){

		return View::make('contact_us', array('page'=>'contact','widget'=>array('validator')));
	}

	public function sendMessage(){

		$input = Input::all();

		$validator = Validator::make($input, array('name'=>'required | alpha', 'email'=>'email | required','text'=>'required'));

		Session::put('contact_us', $input);

		if( $validator->passes() ){

			/*Mail::send('emails.contact_us', array('input'=>$input), function($message) use($input)
			{
				$message->to(Mail::get('from.address'), Mail::get('from.name'));
			});*/

			$success = trans('form.success_message');

			return Redirect::route('contact_us')
			->with(compact('success'));
		}
		else{

			$fields = $validator->failed();

			return Redirect::route('contact_us')
			->withInput()
			->with(compact('fields'))
			->withErrors($validator);
		}
	}
}