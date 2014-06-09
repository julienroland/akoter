@extends('layout.layout')

@section('container')

<div class="connection large formContainer">
	<div class="hero">
		<div class="wrapper">

			<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.inscription_finish')}}</h2>
			<div class="intro">
				{{trans('inscription.inscription_finish_intro')}}
			</div>
		</div>
	</div>

	<div class="wrapper">
		<div class="formContainer large">
			<h3 aria-level="3" role="heading" class="section titlePopup">{{trans('connections.connect_you')}}</h3>

			@include('includes.steps')
			@include('includes.success')
	<div class="field">
			<a class="btn large" href="{{route('account_home',Auth::user()->slug)}}">{{trans('inscription.inscription_done')}}</a>
			</div>
		</div>
	</div>
</div>
@stop