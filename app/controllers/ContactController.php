<?php


class ContactController extends BaseController {

	public function contactUs(){
		
		return View::make('contact_us', array('page'=>'contact','widget'=>array('validator')));
	}

	public function sendMessage(){
dd('ok');
		$input = Input::all();

		$validator = Validator::make($input, array('name'=>'required | alpha', 'email'=>'email | required','text'=>'required'));

		Session::put('contact_us', $input);

		if( $validator->passes() ){


			Mailgun::send('emails.contact_us', array('input'=>$input), function($message) use($input)
			{

				$message->to($input['email'], $input['name']);
				
			});

			return Redirect::route('contact_us')
			->withSuccess(trans('form.success_message'));
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