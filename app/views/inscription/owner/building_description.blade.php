@extends('account.layout')

@section('container')

<div class="hero">
	<div class="wrapper">

		<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.description_building')}}</h2>
		<div class="intro">
			{{trans('inscription.description_building_intro')}}
		</div>
	</div>
</div>
<div class="formContainer">

{{Form::open(array('route'=>array('save_inscription_building', Auth::user()->slug, $building->id )))}}
	
	

{{Form::close()}}
</div>
@stop