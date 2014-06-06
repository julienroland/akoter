@extends('agence.layout')

@section('agence')

<div class="connection large formContainer">
	<div class="hero">
		<div class="wrapper">

			<h2 aria-level="2" role="heading" class="mainTitle">{{trans('agence.joined')}}</h2>
			<div class="intro">
				{{trans('agence.joined_intro')}}
			</div>
		</div>
	</div>

	<div class="wrapper">
		<h3 aria-level="3" role="heading" class="section titlePopup">{{trans('connections.connect_you')}}</h3>
		
		<div class="connexion">

			<div class="loginSocial">
				<div class="loginEmail">

					{{Form::open(array('route'=>array('join', Auth::user()->slug),'class'=>'mainType rules','data-rules'=>json_encode(Agence::$join_rules)))}}

					@include('includes.errors')

					@if(Session::has('error'))

					<div class="errors">
						<ul>
							<li class="error">{{Session::get('error')}}</li>
						</ul>
					</div>
					@endif

					<div class="field">
						{{Form::label('login', trans('agence.login'))}}
							<input autofocus aria-required="true" aria-labelledby="login"  value="{{Session::has('agence_join') ? Session::get('agence_join')['login']:''}}" type="text" name="login" required  class="form-icon {{isset(Session::get('fields')['login']) ? 'form-error':''}}" id="login">

					</div>
					<div class="field">
						{{Form::label('password_agence', trans('agence.password'))}}
							<input aria-required="true" aria-labelledby="password_agence" type="password" name="password_agence" required  placeholder="{{trans('form.password')}}" class="form-password {{isset(Session::get('fields')['password']) ? 'form-error':''}}" id="password_agence">

					</div>

					<div class="field">
						{{Form::submit(trans('agence.join'))}}
					</div>
					{{Form::close()}}
				</div>
			</div>

		</div>
	</div>
</div>

@stop