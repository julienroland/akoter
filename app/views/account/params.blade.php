@extends('account.layout')

@section('account')
@if($user->count())
<div class="account-container">

<h3 aria-level="3" role="heading" class="titlePopup">{{trans('account.settings_title')}}</h3>
	<div class="account-dates">
		<?php setlocale(LC_TIME, Config::get('app.setLocale')[App::getLocale()]); ?> 
		<ul>
			<li><span class="title">{{trans('general.created_at')}}:</span>&nbsp;{{Helpers::beTime($user->created_at,'$d $nd $M $y $h:$m')}}</li>
			<li><span class="title">{{trans('general.updated_at')}}:</span>&nbsp;{{Helpers::beTime($user->updated_at,'$d $nd $M $y $h:$m')}}</li>
			<li><span class="title">{{trans('general.connected_at')}}:</span>&nbsp;{{Helpers::beTime($user->connected_at,'$d $nd $M $y $h:$m')}}</li>
			<li><span class="title">{{trans('general.user_group')}}:</span>&nbsp;{{trans('general.user_groups')[$user->role_id]}}</li>
		</ul>
	</div>
	@if(Auth::user()->email_comfirm == 0  )
	<a href="{{route('checkEmail',Auth::user()->slug)}}" class="checkemail btn-inscription">{{trans('form.checkEmail')}}</a>
	@endif
	{{Form::open(array('route'=>array('save_params', Auth::user()->slug),'method'=>'put','class'=>'inlineType rules','data-rules'=>json_encode(User::$params_rules_password)))}}

	@if(Helpers::isNotOk($user->password))
			<div class="informations">
				{{trans('account.no_password')}}	
			</div>

		@else
			<div class="informations">
				{{trans('account.password_hide')}}
			</div>
		@endif
	<div class="field">
		{{Form::label('email',trans('form.email'))}}
		{{Form::text('email',isset($user->email) && !empty($user->email) ? $user->email :(Session::has('account_params') ? Session::get('account_params')['email']: ''),array('placeholder'=>trans('form.login'),'required', 'class'=>isset(Session::get('field')['email']) ? 'form-error':''))}}

		<i class="icon-required" aria-hidden="true"></i>
	</div>

	<div class="group">
		<div class="field">

			{{Form::label('password',trans('form.password'))}}
			<input type="password" value="{{Session::has('account_params') ? Session::get('account_params')['password'] : ''}}" placeholder="{{trans('form.password')}}" name="password" class="{{isset(Session::get('field')['password']) ? 'form-error':''}}" >

		</div>

		<div class="field">

			{{Form::label('password_ck',trans('form.password-ck'))}}
			<input type="password" value="{{Session::has('account_params') ? Session::get('account_params')['password_ck'] : ''}}" placeholder="{{trans('form.password-ck')}}" name="password_ck" class="{{isset(Session::get('field')['password-ck']) ? 'form-error':''}}" >

		</div>
	</div>

	<div class="field">
		{{Form::label('language',trans('form.language'))}}
		{{Form::select('language',trans('general.lang'),isset($user->language_id) && !empty($user->language_id) ? Config::get('var.lang')[$user->language_id] :(Session::has('account_params')['language'] ? Session::get('account_params')['language']: ''),array('placeholder'=>trans('form.language'),'required', 'class'=>isset(Session::get('field')['language']) ? 'form-error select':'select'))}}
	</div>

	{{Form::submit(trans('form.update'))}}
	{{Form::close()}}
	<div class="account-actions"> 
		<ul >
			@if($user->suspend == 0)

			<li>
				<a href="{{route('suspend_account', Auth::user()->slug)}}">{{trans('account.suspend')}}</a>
			</li>

			@endif

			@if($user->delete == 0)

			<li>
				<a href="{{route('delete_account', Auth::user()->slug)}}">{{trans('account.delete')}}</a>
			</li>

			@endif
		</ul>
	</div>
</div>
@endif
@stop