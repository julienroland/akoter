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
	

	{{Form::open(array('route'=>array('save_inscription_contact', Auth::user()->slug, $building->id, Helpers::isOk($currentLocation) ? $currentLocation->id:'' ),'class'=>'mainType rules','data-rules'=>json_encode(User::$contact_rules)))}}

	<div class="requiredField"><span class="icon-required" aria-hidden="true"></span>{{trans('form.required_field')}}</div>

	@include('includes.errors')

	@include('includes.success')

	<div class="field">
		{{Form::label('first_name',trans('form.first_name'))}}
		{{Form::text('first_name',Helpers::isOk(Auth::user()->first_name) ? Auth::user()->first_name :'',array('placeholder'=>'John','required'))}}
	</div>

	<div class="field">
		{{Form::label('name',trans('form.name'))}}
		{{Form::text('name',Helpers::isOk(Auth::user()->name) ? Auth::user()->name :'',array('placeholder'=>'Doe','required'))}}
	</div>

	<div class="field">
		{{Form::label('email',trans('form.email'))}}
		{{Form::email('email',Helpers::isOk(Auth::user()->email) ? Auth::user()->email :'',array('placeholder'=>'email@email.com','required'))}}
	</div>


	<div class="field">
		{{Form::label('region',trans('form.region'))}}
		{{Form::select('region',isset($regions->data) ? $regions->data :array(''), isset(Auth::user()->region_id) ? Auth::user()->region_id :(Session::has('input_7') && isset(Session::get('input_7')['region']) ? Session::get('input_7')['region']: '') ,array('class'=>'select','data-placeholder'=>trans('form.region'),'required'))}}
	</div>
	<div class="field">
		{{Form::label('locality',trans('form.locality'))}}
		{{Form::select('locality',isset($localities->data) ? $localities->data : array(), isset(Auth::user()->locality_id) ? Auth::user()->locality_id :'',array('class'=>'select','data-placeholder'=>trans('form.locality'),'required'))}}
	</div>


	<div class="field">
		{{Form::label('address',trans('form.address'))}}
		{{Form::text('address',Helpers::isOk(Auth::user()->address) ? Auth::user()->address :'',array('placeholder'=>trans('form.address'),'required'))}}
	</div>
	<div class="field">
	{{Form::label('postal',trans('form.postal'))}}
		{{Form::input('number','postal',Helpers::isOk(Auth::user()->postal) ? Auth::user()->postal :'',array('placeholder'=>trans('form.postal'),'required'))}}

	</div>
	<div class="field">
		{{Form::label('phone',trans('form.phone'))}}
		{{Form::input('number','phone',Helpers::isOk(Auth::user()->phone) ? Auth::user()->phone :'',array('placeholder'=>trans('form.phone'),'required'))}}
	</div>
	<div class="field previous">
		<a href="{{route(Config::get('var.steps_routes.3'), array(Auth::user()->slug, $building->id))}}" title="{{trans('account.back_home')}}">{{trans('general.back')}}</a>
	</div>
	<div class="field next">
		{{Form::submit(trans('form.next'))}}
	</div>

	{{Form::close()}}
</div>
@stop