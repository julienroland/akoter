<?php 

class UserController extends BaseController
{	
	public function __construct(ImageController $image){

		$this->image = $image;

	}
	public function addFavoris( $location ){

		$already = Auth::user()->favoris()->whereLocationId($location->id)->get();

		if(!$already->count() > 0){

			$favoris = new Favoris;
			$favoris->user_id = Auth::user()->id;
			$favoris->location_id = $location->id;
			$favoris->save();

			Auth::user()->isTenant = 1;
			Auth::user()->save();

			return Redirect::back();
		}

		return Redirect::back();


	}

	public function removeFavoris( $location ){

		Auth::user()->favoris()->delete();

		return Redirect::back()
		->withSuccess(trans('validation.custom.removedFavoris'));


	}

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

	public function editPhoto(){

		if(Input::hasFile('file')){

			$validator = Validator::make(array('file'=>Input::file('file')), array('file'=>'required | mimes:jpeg,bmp,png,gif,jpg'));

			if($validator->passes()){

				$this->image->editUserPhoto( Auth::user(), Input::file('file'));

				return Redirect::back()
				->withSuccess(trans('validation.custom.userPhotoEdit'));

			}
			else{

				return Redirect::back()
				->withErrors($validator);

			}

		}

	}

	public function indexContactOwner( $owner_slug, $location ){

		$user = User::whereSlug($owner_slug)->firstOrFail();

		return View::make('account.contact_owner', array(
			'page'=>'contact',
			'title'=>trans('title.contact_owner', array('name'=>$user->first_name.' '.$user->name)),
			'description'=>trans('description.contact_owner', array('name'=>$user->first_name.' '.$user->name)),
			))
		->with(compact('user','location'));
	}

	public function ContactOwner( $owner_slug, $location ){

		$input = Input::all();

		$rules = array('name'=>'required', 'email'=>'email | required','text'=>'required');
		$validator = Validator::make($input, $rules);

		if($validator->passes()){

			$user = User::whereSlug($owner_slug)->firstOrFail();
			$slug =  $location->translations()->whereLanguageId($user->language_id)->whereKey('slug')->pluck('value');

			if(isset($input['translate'])){ 

				$input['text'] = Helpers::translate($input['text'], null , Config::get('var.lang')[$user->language_id]);
			}

			$input['subject'] = Helpers::translate('Message à propos de votre bien n°:'.$location->id, 'fr', Config::get('var.lang')[$user->language_id]);

			Mailgun::send('emails.contact_owner', array('input'=>$input,'user'=>$user,'location'=>$location,'slug'=>$slug), function($message) use($input, $user)
			{

				$message
				->from($input['email'], $input['name'])
				->to($user->email, $user->first_name.' '.$user->name)
				->subject($input['subject']);

			});

			$sender = User::whereEmail($input['email'])->first();
			$message = new Message;
			if(Helpers::isOk($sender)){
				$message->sender_id = $sender->id;
			}
			$message->receiver_id = $user->id;
			$message->subject = $input['subject'];
			$message->content = $input['text'];
			$message->save();

			Auth::user()->isTenant = 1;
			Auth::user()->save();

			return Redirect::back()
			->withSuccess(trans('validation.custom.message_success'));


		}else{

			return Redirect::back()
			->withInput()
			->withErrors($validator);
		}
	}

	public function reserved( $location ){

		return View::make('account.reserved', array('page'=>'reserved', 'widget'=>array('ui','date','validator')))
		->withLocation($location);
	}

	public function reserved_location( $location ){

		$input = Input::all();
		User::$reserved_rules['seat'] = 'required|numeric|min:1|max:'.$location->remaining_room;
		User::$reserved_rules['nb_locations'] = 'required|numeric|max:'.$location->remaining_location;
		$validator = Validator::make( $input, User::$reserved_rules );

		if($validator->passes()){

			$user = $location->building->user()->firstOrFail();

			if(!$location->user()->whereUserId(Auth::user()->id)->whereStatus(1)->get()->count()){

				if(isset($input['translate'])){ 

					$input['text'] = Helpers::translate($input['text'], Config::get('var.lang')[$user->language_id], Config::get('var.lang')[$user->language_id]);
				}

				$input['subject'] = Helpers::translate('Demande de réservation de votre bien n°:'.$location->id, 'fr', Config::get('var.lang')[$user->language_id]);

				Mailgun::send('emails.reservation_location', array('input'=>$input,'user'=>$user,'location'=>$location,'sender'=>Auth::user()), function($message) use($input, $user)
				{

					$message
					->from(Auth::user()->email, Auth::user()->first_name.' '.Auth::user()->name)
					->to($user->email, $user->first_name.' '.$user->name)
					->subject($input['subject']);

				});
			}

			if(!$location->user()->whereUserId(Auth::user()->id)->whereStatus(1)->get()->count()){

				if($location->user()->whereUserId(Auth::user()->id)->whereRequest(1)->get()->count()){

					$location->user()->whereUserId(Auth::user()->id)->whereRequest(1)->detach();
				}

				$location->user()->attach(Auth::user(), array(
					'begin'=>Helpers::dateNaForm($input['start_date']),
					'end'=>$location->end_date,
					'request'=>true,
					'seat'=>$input['seat'],
					'nb_locations'=>$input['nb_locations'],
					'text'=>$input['text'],
					));
			}

			Auth::user()->isTenant = 1;
			Auth::user()->save();

			return Redirect::back()
			->withSuccess(trans('validation.custom.request_reservation_succes'));

		}else{

			return Redirect::back()
			->withInput()
			->withErrors($validator);
		}
	}

}