@extends('account.layout')

@section('container')
<div class="hero">
	<div class="wrapper">

		<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.localisation')}}</h2>
		<div class="intro">
			{{trans('inscription.localisation_intro')}}
		</div>
	</div>
</div>
<div class="formContainer large">
	
	@include('includes.steps')
	
	@if( isset($building) && Helpers::isOk($building) )

	{{Form::open(array('route'=>array('update_localisation_building', Auth::user()->slug, $building->id) ,'method'=>'put','class'=>'mainType rules','data-rules'=>json_encode(Building::$inscription_rules)))}}

	@else

	@if( Session::has('inscription.building_id') )

	{{Form::open(array('route'=>array('update_localisation_building', Auth::user()->slug),'method'=>'put','class'=>'mainType rules','data-rules'=>json_encode(Building::$inscription_rules)))}}

	@else

	{{Form::open(array('route'=>array('save_localisation_building', Auth::user()->slug),'class'=>'mainType rules','data-rules'=>json_encode(Building::$inscription_rules)))}}

	@endif

	@endif

	<div class="requiredField"><span class="icon-required" aria-hidden="true"></span>{{trans('form.required_field')}}</div>

	@include('includes.errors')

	@include('includes.success')

	
	<div class="field previous">
		<a href="{{route('account_home', Auth::user()->slug)}}" title="{{trans('account.back_home')}}">{{trans('general.back')}}</a>
	</div>
	<div class="field next">
		{{Form::submit(trans('form.next'))}}
	</div>

	{{Form::close()}}
</div>
@stop