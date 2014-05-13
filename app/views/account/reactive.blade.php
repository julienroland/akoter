@extends('layout.layout')

@section('container')


<div class="reactiveAccount">
	<div class="logo">
		<img src="{{Config::get('var.img_dir')}}logo/logo.png" alt="">
	</div>
	<div class="status">{{trans('account.account_sleep')}}</div>

	<a href="{{route('account_reactive_query',array($user->slug, $user->id))}}">{{trans('account.yes_reactive',array('name'=>$user->first_name.' '.$user->name))}}</a>

</div>

@stop