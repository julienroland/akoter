@extends('layout.layout')

@section('container')
@include('agence.topProfile')
<div class="locations">
	<ul>
		@if($locations->count() > 0)

		<section class="kots" id="main">
			<div id="container" class="wrapper">
				<div class="row">

					@foreach($locations as  $location)

					@include('locations-list')

					@endforeach

				</div>
			</div>
		</section>

		@else
		<li class="informations">{{trans('agence.nos_locations', array('name'=>$agence->name))}}</li>
		@endif
	</ul>
</div>
</div>
</div>
@stop