<?php

class RechercheController extends BaseController {



	public function accueil(){

		return View::make('recherche.index');
	}

	public function rapide(){

		return View::make('recherche.rapide');
	}
	public function trier($tri){

		$kots = Kot::orderBy($tri,'ASC')->get();
		return View::make('recherche.type.ville')->with('listeKot',$kots);
	}
	public function rechercheRapide($type = NULL){

		/*$formData = array(
			//'type' =>Input::get('type'),
			 //'loyer_max' => Input::get('loyer_max'),
			 //'loyer_min' => Input::get('loyer_min'),
			 //'charges' => Input::get('charge')
			);
		$formRules = array(
			'type' =>'required',
			//'loyer_max' => '',
			//'loyer_min' => '',
			//'charges' => ''
			);

		$validator = Validator::make($formData, $formRules);

		if($validator->fails())
		{
			$messages = $validator->messages();
			return Redirect::to('/')->with('validatorMessage',$messages);
		}*/
		$type=Input::get('type');

		/*if($type === 'aucun' )
		{
			$aucun = true;
			$ville = false;
			$ecole = false;
		}
		if($type === 'ville' )
		{
			$aucun = false;
			$ville = true;
			$ecole = false;
		}
		else if($type === 'ecole' )
		{
			$aucun = false;
			$ville = false;
			$ecole = true;
		}*/

		// $loyerMax=Input::get('loyer_max');
		// $loyerMin=Input::get('loyer_min');
		// $charges=Input::get('charge');
		$zone=Input::get('zone');
		$distance=Input::get('distance');

		$arrayRechercheRapide = array(
			//'ville'=>$ville,
			//'aucun'=>$aucun,
			//'ecole'=>$ecole,
			// 'loyer_max'=>$loyerMax,
			// 'loyer_min'=>$loyerMin,
			// 'charges'=>$charges,
			'zone'=>$zone,
			'distance'=>$distance
			);

		Session::put('ancienneRechercheRapide',$arrayRechercheRapide);
		
		if(Auth::check())
		{
			if(Input::get('enregistrer')=== '1') //register the rapid search of user
			{
				
				if(Input::get('enregistrerNom'))
				{
					$nom = Input::get('enregistrerNom');
				}
				else
				{
					$nom = 'recherchePerso';
				}	
				$countRechercheRapide = DB::table('rechercheRapideEnregistre')
				->count();
				if($countRechercheRapide >= 5){
					alert('Vous avez déjà'.$countRechercheRapide.' recherche rapide enregistré, vous pouvez modifier celle-ci sur votre profil');
				}
				else
				{

					$rechercheRapide = DB::table('rechercheRapideEnregistre')
					->insert(array(
						'user_id'=>Session::get('user')['id'],
						'rechercheEnregistre'=>json_encode($arrayRechercheRapide),
						'nom' =>$nom						
						)
					);
					if(!$rechercheRapide){
						return Redirect::to('/')->with('errorMessage','Erreur lors de l\'ajout à la base de donnée');
					}

				}
				
			}//end enregistrement recherche
		}
		
		if($type ==='aucun'){
			if(!empty($zone)){

				$kot = Kot::where('region',strtolower($zone))->get();

				return View::make('recherche.type.ville')->with('listeKot',$kot);
			}
			else
			{
				$kot = Kot::all();
				return View::make('recherche.type.ville')->with(array('listeKot'=>$kot,'message'=>'Vous n\'avez ciblé aucune école précédemment, vous pouvez le faire maintenant'));		
			}
		}
		else if(Input::get('listKot')!=="null" || Input::get('listKot'))
		{

			$kot = json_decode(Input::get('listKot')); //liste des kots
			
			Session::put('kotFromGoogle',$kot);

			return View::make('recherche.type.ville')->with('listeKot',Session::get('kotFromGoogle'));		
		}
		else if(empty($type))
		{
			if(!empty($zone)){

				$kot = Kot::where('region',strtolower($zone))->get();

				return View::make('recherche.type.ville')->with('listeKot',$kot);
			}
			else
			{
				$kot = Kot::all();
				return View::make('recherche.type.ville')->with(array('listeKot'=>$kot,'message'=>'Vous n\'avez ciblé aucune école précédemment, vous pouvez le faire maintenant'));		
			}
					
		}
		/*if(Input::get('type')==='aucun')
		{

			$kot = DB::table('kot')->get();

			if(!$kot)
			{
				$kot = DB::table('kot')->get();
			}
			return View::make('recherche.type.aucun')->with('listeKot',$kot);		
		}

		elseif(Input::get('type')==='ecole')
		{
			if(!empty(Input::get('listKot')))
			{
				$kot = json_decode(Input::get('listKot')); //Champ de l'école
				Session::put('kotFromGoogle',$kot);
				return View::make('recherche.type.ville')->with('listeKot',Session::get('kotFromGoogle'));
			}
			else
			{
				if(!empty(Input::get('zone'))){
					$ecole = strtolower(is_string(Input::get('zone')));
					
					$kot = DB::table('kot')->get();
					
					if(!$kot)
					{
						$kot = DB::table('kot')->orderBy('region')->get();
					}
					return View::make('recherche.type.ecole')->with(array('listeKot'=>$kot,'message'=>'Aucun résultat ne correspond à votre séléection, voici les kots les plus proches.'));
				}
				else
				{
					$kot = DB::table('kot')->orderBy('prix')->get();
					return View::make('recherche.type.ecole')->with(array('listeKot'=>$kot,'message'=>'Vous n\'avez ciblé aucune école précédemment, vous pouvez le faire '.link_to_route('showEcoleMap','maintenant')));
				}
			}
		}

		elseif(Input::get('type')==='ville')
		{
			if(!empty(Input::get('listKot')))
			{
				$kot = json_decode(Input::get('listKot')); //Champ de la ville
				Session::put('kotFromGoogle',$kot);
				return View::make('recherche.type.ville')->with('listeKot',Session::get('kotFromGoogle'));
			}
			else
			{
				if(!empty(Input::get('zone'))){
					$region = strtolower(is_string(Input::get('zone')));
					$region = ucwords($region);

					$kot = DB::table('kot')->orderBy('prix')->where('region',$region)->get();
					
					if(!$kot)
					{
						$kot = DB::table('kot')->orderBy('region')->get();
					}
					return View::make('recherche.type.ville')->with(array('listeKot'=>$kot,'message'=>'Aucun résultat ne correspond à votre séléection, voici les kots les plus proches.'));
				}	
				else
				{
					$kot = DB::table('kot')->orderBy('prix')->get();
					return View::make('recherche.type.ville')->with(array('listeKot'=>$kot,'message'=>'Vous n\'avez ciblé aucune ville précédemment, vous pouvez le faire '.link_to_route('showVilleMap','maintenant')));
				}
			}

		}*/

		
	}

	public function detaillee(){

		return View::make('recherche.detaillee');
	}

}