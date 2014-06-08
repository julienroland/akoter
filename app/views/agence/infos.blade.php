@extends('layout.layout')

@section('container')
@include('agence.topProfile')
<div class="infos">
	<h3 aria-level="3" role="heading" class="titlePopup">{{trans('agence.infos')}}</h3>

	<div class="agence-info">
		<span class="name">{{$agence->name}}</span>
		<span class="address">{{trans('agence.address')}}: {{$agence->address}}</span>
		<span class="region">{{trans('agence.region')}}: {{$region}}</span>
		<span class="locality">{{trans('agence.locality')}}: {{$locality}}</span>
		@if(Helpers::isOk($agence->email))
		<span class="email">{{trans('agence.email_contact')}}: <a href="mailto:{{$agence->email}}">{{$agence->email}}</a></span>
		@endif
		@if(Helpers::isOk($agence->web))
		<span class="web">{{trans('agence.web')}}: <a href="{{$agence->web}}">{{$agence->web}}</a></span>
		@endif
	</div>
</div>
</div>
</div>
@stop