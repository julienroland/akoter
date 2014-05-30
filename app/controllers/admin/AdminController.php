<?php

class Admin_AdminController extends \BaseController
{
	public function __construct()
	{
		$this->beforeFilter('auth');
	}

	public function index()
	{
		return View::make('admin.index');
	}

	function search( $search, $class){

		$class = $class->getModel();
		$table = $class->getModel()->getTable();
		$className = get_class($class->getModel());

		if(isset($search['search']) && Helpers::isOk($search['search'])){
			$search = $search['search'];
			$class = $class
			->join('users',$table.'.user_id','=','users.id')
			->join('translations', function($join) use($table, $className){
				$join->on($table.'.id','=','translations.content_id')
				->where('translations.content_type','=',$className)
				->where('translations.key','=','text');
				
			})
			->where($table.'.id','like','%'.$search.'%')
			->orWhere('users.first_name','like','%'.$search.'%')
			->orWhere('translations.value','like','%'.$search.'%')
			->orWhere('users.name','like','%'.$search.'%')
			->distinct()
			->select('users.id as user_id',$table.'.*');

			return $class;
		}
		
	}
}