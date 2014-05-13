<?php

class InscriptionColocationController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{

		return View::make('inscription.colocation.etape1');
	}

	public function createAccount()
	{
	
		return View::make('inscription.colocation.etape2');
	}

	public function image()
	{

	 	return View::make('inscription.colocation.etape3');
	 	
	}

	public function batiment()
	{
	 	return View::make('inscription.colocation.etape4');	
	}

	public function autre()
	{
	 	return View::make('inscription.colocation.etape5');	
	}

	public function annonce()
	{
	 	return View::make('inscription.colocation.annonce');	
	}
	public function comfirmer()
	{
	 	return View::make('inscription.colocation.comfirmer');	
	}

	

}