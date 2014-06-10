@extends('layout.layout')

@section('container')

@include('listing.short')

<div class="listing">
	<div class="wrapper">
		@if(isset($locations) && Helpers::isOk($locations))
		<p class="nb_result">{{$locations->getTotal()-1}} {{trans('locations.nb_result')}}</p>
		@endif
		<div class="residence" id="residence">
			<div class="wrapper">
				
				<section class="kots" id="main">
					<div id="container" class="wrapper">
						@if(Helpers::isOk($locations))
						@foreach($locations as  $location)
						@include('locations-list')
						@endforeach
						@endif
					</div>

					@if(Helpers::isOk($locations))
					@if(isset($input) && Helpers::isOk($input))
					
					{{$locations->appends( $input )->links()}}

					@else

					{{$locations->links()}}

					@endif
					@else 
					<p class="info">Aucune annonce pour cette recherche</p>
					@endif

				</section>

			</div>
		</div>
		
	</div>
</div>
@include('map.index')
</div>

@stop