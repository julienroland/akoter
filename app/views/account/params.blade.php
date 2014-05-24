@extends('account.layout')

@section('account')
@if($user->count())
<div class="account-container">
<div class="account-dates">
	<?php setlocale(LC_TIME, Config::get('app.setLocale')[App::getLocale()]); ?> 
	<ul>
		<li>{{trans('general.created_at')}}: {{Helpers::beTime($user->created_at,'$d $nd $M $y $h:$m')}}</li>
		<li>{{trans('general.updated_at')}}: {{Helpers::beTime($user->updated_at,'$d $nd $M $y $h:$m')}}</li>
		<li>{{trans('general.connected_at')}}: {{Helpers::beTime($user->connected_at,'$d $nd $M $y $h:$m')}}</li>
		<li>{{trans('general.user_group')}}: {{trans('general.user_groups')[$user->role_id]}}</li>
	</ul>
</div>

{{Form::open(array('route'=>'save_params','method'=>'put','class'=>'inlineType rules','data-rules'=>json_encode(User::$params_rules_password)))}}

@include('includes.errors')
@include('includes.success')
@if(Auth::user()->email_comfirm == 0  )
<a href="{{route('checkEmail',Auth::user()->slug)}}" class="checkEmail">{{trans('form.checkEmail')}}</a>
@endif
<div class="field">
	{{Form::label('email',trans('form.login'))}}
	{{Form::text('email',isset($user->email) && !empty($user->email) ? $user->email :(Session::has('account_params') ? Session::get('account_params')['email']: ''),array('placeholder'=>trans('form.login'),'required', 'class'=>isset(Session::get('field')['email']) ? 'form-error':''))}}

	<i class="icon-required" aria-hidden="true"></i>
</div>

<div class="group">
	@if(Helpers::isNotOk($user->password))
	{{trans('account.no_password')}}
	@else
	{{trans('account.password_hide')}}
	@endif
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
	{{Form::select('language',trans('general.lang'),isset($user->language_id) && !empty($user->language_id) ? Config::get('var.lang')[$user->language_id] :(Session::has('account_params')['language'] ? Session::get('account_params')['language']: ''),array('placeholder'=>trans('form.language'),'required', 'class'=>isset(Session::get('field')['language']) ? 'form-error':''))}}
</div>

<ul>
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
{{Form::submit(trans('form.update'))}}
{{Form::close()}}
</div>
@endif
@stop