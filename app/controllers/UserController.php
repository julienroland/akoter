<?php 

class UserController extends BaseController
{

	public function sendEmailComfirm(  ){

		$key = Auth::user()->key;

		$user = Auth::user();

		Mailgun::send('emails.auth.check', array('key'=>$key,'user'=>$user), function($message) use($user)
		{
			$message->to($user->email, $user->first_name . ' ' . $user->name)
			->subject(trans('general.check_email'));
		});

		return Redirect::back()
		->withSuccess(trans('account.mailSend'));
	}
	
}