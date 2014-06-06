@extends('account.layout')

@section('account')
<div class="account-intro">
	<h2 aria-level="2" role="heading" class="title-account">{{trans('account.your_favoris')}}</h2>

</div>
<div class="favoris">
	@foreach($locations as $location)
	<section class="kots" id="main">
		<div id="container" class="wrapper">
			@include('locations-list')
		</div>
	</section>

	@endforeach
</div>	
@stop