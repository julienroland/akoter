<?php

use Carbon\Carbon;

class AccountBaseController extends BaseController {

	public function __construct(){
	}

	public function nb_request(){

		return User::getNumberRequest(Auth::user());
	}

	public function personnalComplete(){

		$personnal = array(
			'first_name' => Auth::user()->first_name,
			'name' => Auth::user()->name,
			'email' => Auth::user()->email,
			'civility' => Auth::user()->civility,
			'address' => Auth::user()->address,
			'region' => Auth::user()->region_id,
			'locality' => Auth::user()->locality_id,
			'phone' => Auth::user()->phone,
			'postal' => Auth::user()->postal,

			);

		return User::personnalsRequiredNotComplete( $personnal );
	}
}