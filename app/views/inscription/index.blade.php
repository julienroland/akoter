@extends('layout.layout')

@section('container')

<div class="inscription">
	<div class="hero">
		<div class="wrapper">

			<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.create_account')}}</h2>
			<div class="intro">
				{{trans('inscription.create_account_intro')}}
			</div>
		</div>
	</div>
	<div class="inscription_form">
		<div class="wrapper">

			<div class="facebook">
				<a href="{{route('fbConnect')}}" title="{{trans('inscription.inscription_title',array('name'=>'Facebook'))}}">
					<div class="logo">

					</div>
					<div class="text">
						<span>{{trans('inscription.inscription_title',array('name'=>'Facebook'))}}</span>
					</div>
				</a>
			</div>
			<div class="loginEmail">
				<span class="or">{{strtolower(trans('connections.or'))}}</span>
				{{Form::open(array('route'=>'inscription_save','class'=>'inlineType rules','data-rules'=>json_encode(User::$inscription_rules)))}}
				@include('includes.errors')

				@if(Session::has('error'))
				<div class="errors">
					<ul>
						<li class="error">{{Session::get('error')}}</li>
					</ul>
				</div>
				@endif
				<div class="field">

				<label for="first_name">{{trans('inscription.first_name').trans('form.required')}}</label>
					<input type="text" id="first_name" name="first_name" autofocus value="{{Session::has('inscription') && isset(Session::get('inscription')['first_name'])? Session::get('inscription')['first_name'] :''}}" required placeholder="{{trans('inscription.first_name')}}">
					<i class="icon-required" aria-hidden="true"></i>
				</div>
				<div class="field">
					<label for="name">{{trans('inscription.name').trans('form.required')}}</label>
					<input type="text" id="name" name="name" value="{{Session::has('inscription') && isset(Session::get('inscription')['name']) ? Session::get('inscription')['name']:''}}" required placeholder="{{trans('inscription.name')}}">
					<i class="icon-required" aria-hidden="true"></i>
				</div>

				<fieldset class="field">
					<legend class="section">{{trans('form.sex').trans('form.required')}}</legend>

					<label for="c0">{{trans('form.male')}}</label>
					{{Form::radio('civility',0,Session::has('inscription') && isset(Session::get('inscription')['civility']) && Session::get('inscription')['civility'] == 0 ? true : false,array('id'=>'c0'))}}

					<label for="c1">{{trans('form.female')}}</label>
					{{Form::radio('civility',1,Session::has('inscription') && isset(Session::get('inscription')['civility']) && Session::get('inscription')['civility'] == 1 ? true :false,array('id'=>'c1'))}}
					<i class="icon-required" aria-hidden="true"></i>
				</fieldset>
				<fieldset class="field born">
					<legend class="label">{{trans('inscription.born').trans('form.required')}}:</legend>
					{{Form::input('number','day',Session::has('inscription') && isset(Session::get('inscription')['day']) ? Session::get('inscription')['day']:'',array('required','placeholder'=>trans('inscription.born_day'),'min'=>1,'max'=>31,'id'=>'day','data-validator'=>'false'))}}

					{{Form::select('month',trans('general.month_select'),Session::has('inscription') && isset(Session::get('inscription')['month']) ? Session::get('inscription')['month']:'',array('class'=>'select','data-placeholder'=>trans('inscription.born_month'),'id'=>'month','data-validator'=>'false'))}}

					{{Form::input('number','year',Session::has('inscription')&& isset(Session::get('inscription')['year'])  ? Session::get('inscription')['year']:'',array('required','placeholder'=>trans('inscription.born_year'),'min'=>1900,'max'=>date('Y'),'id'=>'year'))}}
				</fieldset>
				<div class="field">

					<label for="email">{{trans('inscription.email').trans('form.required')}}</label>
					<input id="email" value="{{Session::has('inscription') && isset(Session::get('inscription')['email']) ? Session::get('inscription')['email']:''}}" type="email" name="email" required placeholder="email@email.com" class="form-email form-icon {{isset(Session::get('fields')['email']) ? 'form-error':''}}" id="">
					<i class="icon-required" aria-hidden="true"></i>
				</div>
				<div class="field">

					<label for="password">{{trans('inscription.password').trans('form.required')}}</label>
					<input id="password" value="{{Session::has('inscription') && isset(Session::get('inscription')['password']) ? Session::get('inscription')['password']:''}}" type="password" name="password" required  placeholder="{{trans('form.password')}}" class="form-password {{isset(Session::get('fields')['password']) ? 'form-error':''}}" id="">
					<i class="icon-required" aria-hidden="true"></i>
				</div>
				<div class="field">

					<label for="password_ck">{{trans('inscription.password_ck').trans('form.required')}}</label>
					<input id="password_ck" value="{{Session::has('inscription') && isset(Session::get('inscription')['password_ck']) ? Session::get('inscription')['password_ck']:''}}" type="password" name="password_ck" required  placeholder="{{trans('form.password-ck')}}" class="form-password {{isset(Session::get('fields')['password_ck']) ? 'form-error':''}}" id="">
					<i class="icon-required" aria-hidden="true"></i>
				</div>

				<div class="field">
					<label for="cgu"><a href="{{route('showPost', $cgu->translation[0]->value)}}">{{trans('inscription.cgu')}}</a></label>
					<input type="checkbox" name="cgu" id="cgu">
				</div>
				{{Form::hidden('region',Session::has('inscription') && isset(Session::get('inscription')['region']) ? Session::get('inscription')['region']:'',array('class'=>'autocomplete'))}}
				{{Form::hidden('locality',Session::has('inscription') && isset(Session::get('inscription')['locality']) ? Session::get('inscription')['locality']:'',array('class'=>'autocomplete'))}}
				{{Form::hidden('address',Session::has('inscription') && isset(Session::get('inscription')['address']) ? Session::get('inscription')['address']:'',array('class'=>'autocomplete'))}}
				{{Form::hidden('postal',Session::has('inscription') && isset(Session::get('inscription')['postal']) ? Session::get('inscription')['postal']:'',array('class'=>'autocomplete'))}}
				<div class="field">
					{{Form::submit(trans('inscription.registering'))}}
				</div>
				{{Form::close()}}
			</div>

		</div>
	</div>

</div>

</div>

@stop