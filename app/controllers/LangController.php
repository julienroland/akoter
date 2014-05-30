<?php

class LangController extends BaseController {

	public function getAll( ){

		/**
		*
		* Array qui stockera les traductions
		*
		**/
		$langs = new Collection;

		/**
		*
		* @return array
		* Tous les fichiers de langs
		*
		**/
		
		$langages = File::directories(base_path().'/app/lang/');

		/**
		*
		* Pour chaque ou récupère la [$key] du fichier de la langue en cours
		*
		**/
		foreach( $langages as $key => $langage){

			$ex = explode('/', $langage);

			if(in_array(App::getLocale(), $ex)){

				$pathId = $key;
			}
		}

		/**
		*
		* On chope les traductions
		* @return array [$nom-fichier => $valeur]
		*
		**/
		
		foreach( File::files($langages[$pathId]) as $key => $files ){

			$ex = explode('/', $files);

			$fileName = explode('.' , $ex[count($ex)-1])[0];

			if(Request::ajax()){

				$langs[$fileName] = File::getRequire( $files );

			}else{

				$this->recursivePush($langs, File::getRequire( $files ));
				
			}
			
		}
		
		/**
		*
		* @return json
		*
		**/
		if(Request::ajax()){

			return Response::json($langs, 200);

		}else{

			return $langs;
		}
	}

	public function recursivePush($langs, $data){

		foreach($data as $file){

			if(is_array($file)){

				$this->recursivePush($langs, $file);
			}

			$langs->push($file);
		}

		return $langs;

	}
}