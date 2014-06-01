@extends('layout.layout')

@section('container')

<div class="connection large formContainer">
	<div class="hero">
		<div class="wrapper">

			<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.connect')}}</h2>
			<div class="intro">
				{{trans('inscription.connect_intro')}}
			</div>
		</div>
	</div>

	<div class="wrapper">
		<h3 aria-level="3" role="heading" class="section titlePopup">{{trans('connections.connect_you')}}</h3>
		
		<div class="connexion">

			<div class="loginSocial">
				<div class="facebook">
					<a href="{{route('fbConnect')}}" title="{{trans('connections.connection_title',array('name'=>'Facebook'))}}">
						<div class="logo">

						</div>
						<div class="text">
							<span>{{trans('connections.connection_with',array('name'=>'Facebook'))}}</span>
						</div>
					</a>
				</div>
				<div class="loginEmail">
					<span class="or">{{strtolower(trans('connections.or'))}}</span>

					{{Form::open(array('route'=>'connection','class'=>'mainType rules','data-rules'=>json_encode(User::$rules)))}}
					@include('includes.errors')

					@if(Session::has('error'))

					<div class="errors">
						<ul>
							<li class="error">{{Session::get('error')}}</li>
						</ul>
					</div>
					@endif

					<div class="field">
						{{Form::label('email_co', trans('connections.your_field',array('name'=>'email')))}}
						<div class="input-email icon-arroba">
							<input autofocus aria-required="true" aria-labelledby="email_co" value="{{Cookie::has('login') ? Cookie::get('login')['email_co']: ''}}" type="email" name="email_co" required placeholder="email@email.com" class="form-email form-icon {{isset(Session::get('fields')['email']) ? 'form-error':''}}" id="email_co">

						</div>
					</div>
					<div class="field">
						{{Form::label('password_co', trans('connections.your_password',array('name','password')))}}
						<div class="input-password icon-lock24">
							<input aria-required="true" aria-labelledby="password_co" value="{{Cookie::has('login') ? Cookie::get('login')['password_co']: ''}}" type="password" name="password_co" required  placeholder="{{trans('form.password')}}" class="form-password {{isset(Session::get('fields')['password']) ? 'form-error':''}}" id="password_co">

						</div>
					</div>
					<div class="field">
						{{Form::label('remember', trans('connections.remember_me',array('name','password')))}}
						{{Form::checkbox('remember',true,Cookie::get('login')['remember'] ? true: false ,array('id'=>'remember'))}}  
						

					</div>
					<div class="field">
						{{Form::submit(trans('connections.connect'))}}
					</div>
					{{Form::close()}}
				</div>
				<p class="registerYou">{{trans('general.dont_have_account')}} <a href="{{route('inscription_index')}}">{{trans('general.register_you')}}</a></p>
			</div>

		</div>
	</div>
</div>
@stop