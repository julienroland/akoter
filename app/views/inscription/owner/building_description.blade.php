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

	{{Form::open(array('route'=>array('save_inscription_building', Auth::user()->slug, $building->id ),'class'=>'mainType'))}}
	@include('includes.errors')
	@include('includes.success')
	
	@foreach($options as $option)
	
	<div class="field">

		@if(isset($option->translation[0]))

		<label for="building[{{$option->id}}]">{{$option->translation[0]->value}}</label>

		@endif

		<input type="checkbox" name="building[{{$option->id}}]" id="building[{{$option->id}}]">

	</div>

	@endforeach

	<div class="field previous">

	<a href="{{route(Config::get('var.steps_routes.2'), array(Auth::user()->slug, $building->id))}}" title="{{trans('account.back_previous_step')}}">{{trans('general.back')}}</a>

	</div>
	<div class="field next">

		{{Form::submit(trans('form.next'))}}

	</div>
	{{Form::close()}}
</div>
@stop