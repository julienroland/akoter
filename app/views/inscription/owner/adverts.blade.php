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

	{{Form::open(array('route'=>array('save_localisation_building', Auth::user()->slug),'class'=>'mainType rules','data-rules'=>json_encode(Building::$inscription_rules)))}}


	<div class="requiredField"><span class="icon-required" aria-hidden="true"></span>{{trans('form.required_field')}}</div>

	@include('includes.errors')

	@include('includes.success')

	<div class="tabs">
		<ul>
			@foreach($locations as $location)
			
			<li><a href="#{{$location->id}}-advert">{{$location->typeLocation->translation[0]->value}} {{$location->id}}</a></li>
			@endforeach
		</ul>

		@foreach($locations as $location)
		<div id="{{$location->id}}-advert">

		</div>
		@endforeach
	</div>

	<div class="field previous">
		<a href="{{route('account_home', Auth::user()->slug)}}" title="{{trans('account.back_home')}}">{{trans('general.back')}}</a>
	</div>
	<div class="field next">
		{{Form::submit(trans('form.next'))}}
	</div>
	{{Form::hidden('latlng', isset($building->latlng) ? $building->latlng : (Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['latlng'] : ''), array('id'=>'latlng'))}}
	{{Form::close()}}
</div>
@stop