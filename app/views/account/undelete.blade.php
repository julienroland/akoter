@extends('layout.layout')

@section('container')


<div class="reactiveAccount">
	<div class="logo">
		<img src="{{Config::get('var.img_dir')}}logo/logo.png" alt="">
	</div>
	<div class="status">{{trans('account.account_deleted')}}</div>
	<p>{{trans('account.undelete')}}</p>

	<a href="{{route('account_undelete_query',array($user->slug, $user->id))}}">{{trans('account.yes_undelete')}}</a>

</div>

@stop