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
<div class="formContainer large">

	@include('includes.steps')
	
	@if(isset($currentOptions))
	
	{{Form::open(array('method'=>'put','route'=>array('update_inscription_building', Auth::user()->slug, $building->id, Helpers::isOk($currentLocation) ? $currentLocation->id:'' ),'class'=>'mainType'))}}	

	@else

	{{Form::open(array('route'=>array('save_inscription_building', Auth::user()->slug, $building->id, Helpers::isOk($currentLocation) ? $currentLocation->id:'' ),'class'=>'mainType'))}}

	@endif
	@include('includes.errors')

	@include('includes.success')


	@foreach($options as $option)
	<fieldset class="field listCheckbox">
	<legend class="section">{{trans('inscription.building_description_legend')}}</legend>
		<input type="checkbox" {{isset($currentOptions) && isset($currentOptions[$option->id]) ? 'checked':''}} name="building[{{$option->id}}]" id="building[{{$option->id}}]">
		@if(isset($option->translation[0]))

		<label for="building[{{$option->id}}]">{{$option->translation[0]->value}}</label>

		@endif

		

	</fieldset>

	@endforeach
	<div aria-hidden="true" class="clear"></div>
	<div class="field previous">

		<a role="button" href="{{route(Config::get('var.steps_routes.2'), array(Auth::user()->slug, $building->id))}}" title="{{trans('account.back_previous_step')}}">{{trans('general.back')}}</a>

	</div>
	<div class="field next">

		{{Form::submit(trans('form.next'))}}

	</div>
	{{Form::close()}}
</div>
@stop