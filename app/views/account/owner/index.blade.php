
<h2 aria-level="2" role="heading">{{trans('account.your_properties')}}</h2>

@if(isset($activeLocations) && $activeLocations->count())

@if($activeLocations->count() > 1)

<h3 aria-level="3" role="heading">{{trans('account.activeLocations')}}</h3>

@else

<h3 aria-level="3" role="heading">{{trans('account.activeLocation')}}</h3>

@endif

<div class="activeLocations">

	<ul>

		@foreach( $activeLocations->activeBuilding as $activeLocation)

		<li>		
			<a href="{{route('dashboard_location',array(Auth::user()->slug, $activeLocation->location[0]->translation[0]->value))}}">

				@if(Helpers::isOk($activeLocation->photo))

				<img src="{{Config::get('var.images_dir')}}{{$activeLocation->photo}}" alt="">

				@else 

				<img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoLocation')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">

				@endif

			</a>
		</li>

		@endforeach
		
	</ul>

</div>

@endif

@if(isset($waitingLocations) && $waitingLocations->count())

@if($waitingLocations->count() > 1)

<h3 aria-level="3" role="heading">{{trans('account.waitingLocations')}}</h3>

@else

<h3 aria-level="3" role="heading">{{trans('account.waitingLocation')}}</h3>

@endif
<div class="waitingLocations">

	<ul>

		@foreach( $waitingLocations->activeBuilding as $waitingLocation)

		<li>	
			@if(Helpers::isOk($waitingLocation->photo))

			<img src="{{Config::get('var.images_dir')}}{{$waitingLocation->photo}}" alt="">

			@else 
			
			<img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoLocation')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">

			@endif

		</li>

		@endforeach
		
	</ul>

</div>

@endif

@if(isset($invalidLocations) && $invalidLocations->count())

@if($invalidLocations->count() > 1)

<h3 aria-level="3" role="heading">{{trans('account.invalidLocations')}}</h3>

@else

<h3 aria-level="3" role="heading">{{trans('account.invalidLocation')}}</h3>

@endif
<div class="invalidLocations">

	<ul>

		@foreach( $invalidLocations->activeBuilding as $invalidLocation)

		<li>	
			@if(Helpers::isOk($invalidLocation->photo))

			<img src="{{Config::get('var.images_dir')}}{{$invalidLocation->photo}}" alt="">

			@else 
			
			<img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoLocation')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">

			@endif

		</li>

		@endforeach
		
	</ul>

</div>

@endif
