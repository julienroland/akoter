<?php

class ValidatorController extends BaseController {

	
	public function validate( $rules ){

		if(Helpers::isOk( $rules )){

			$rules = (array)json_decode($rules);

			$input = Input::all();

			$validator = Validator::make($input, $rules);

			if( $validator->fails() ){

				$fields = $validator->failed();
				
				$messages = $validator->messages();

				return Response::json( array( 'fields'=>$fields, 'messages'=>$messages->all() ), 200 );

			}else{

				return Response::json('success', 200);
			}

		}else{

			return Response::json('success', 200);

		}
	}

	public function validateOne( $name, $rules, $value = "" ){

		if(Helpers::isOk( $rules ) && Helpers::isOk( $name )){

			$value_ex = explode(':',$value);

			if(isset(explode('-',$name)[1])){

				$name_ex = explode('-',$name);

			}elseif(isset(explode('_',$name)[1])){

				$name_ex = explode('_',$name);

			}

			if( isset($value_ex[1])){

				$input = array(
					$name_ex[0] => $value_ex[0],
					$name => $value_ex[1],
					);
				$rules = array(
					$name => $rules,
					);

			}else{

				$input = array(
					$name => $value,
					);
				$rules = array(
					$name => $rules,
					);
			}

			$validator = Validator::make($input, $rules);

			if( $validator->fails() ){

				$fields = $validator->failed();

				$messages = $validator->messages();

				return Response::json( array( 'field'=>$fields, 'message'=>$messages->all() ), 200 );

			}else{

				return Response::json('success', 200);
			}

		}else{

			return Response::json('success', 200);

		}
	}

}