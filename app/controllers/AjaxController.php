<?php 
/**
* 
*/
class AjaxController extends BaseController
{
	
	public function listKot()
	{
		$datas = DB::table('kot')->get();
			
		if(!$datas)
		{	
			

		}
		$id = [];
		$prix = [];
		$region = [];
		//$disponibilite = []; 
		$lat= [];
		$lng= [];
		$adresse = [];
		$excerpt = [];
		//$charges = [];
		$oData = [];

		foreach ($datas as $data)
			{
				$d = array('id'=>$data->id,'prix'=>$data->prix,'region'=>$data->region,'adresse'=>$data->adresse,'lat'=>$data->lat,'lng'=>$data->lng,'excerpt'=>$data->excerpt);
				array_push($oData, $d );
			}
			return(json_encode(array('data'=>$oData)));
	}
	public function listEcole()
	{
		$datas = DB::table('ecoles')->get();

		if(!$datas)
		{	
			

		}
		$id = [];
		$nom = [];
		$siteweb = [];
		$region = []; 
		$lat= [];
		$lng= [];
		$adresse = [];
		$postal = [];
		$initial = [];
		$oData = [];

		foreach ($datas as $data)
			{
				$d = array('id'=>$data->id,'nom'=>$data->nom,'siteweb'=>$data->siteweb,'region'=>$data->region,'lat'=>$data->lat,'lng'=>$data->lng,'adresse'=>$data->adresse,'postal'=>$data->postal,'initial'=>$data->initial);
				array_push($oData, $d );
			}
		 
		return(json_encode(array('data'=>$oData)));
	}
}