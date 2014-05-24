
<h2 aria-level="2" role="heading">{{trans('account.your_properties')}}</h2>


@if(isset($activeLocations) && $activeLocations->count())

@if($activeLocations->count() > 1)

<h3 aria-level="3" role="heading">{{trans('account.activeLocations')}}</h3>

@else

<h3 aria-level="3" role="heading">{{trans('account.activeLocation')}}</h3>

@endif

<div class="activeLocations">

	<ul>
{{dd($activeLocations)}}
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

@if($waitingLocations->count())


<h3 aria-level="3" role="heading">{{trans('account.waitingLocations')}}</h3>

<div class="waitingLocations">

	<ul>
		@foreach( $waitingLocations->building as $building)
		@foreach($building->location as $location)

		<li class="location-account">	
			<div class="image">

				@if(isset($location->accroche[0]))

				<img class="thumbnail small-img" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.locations_dir').$location->id.'/'.Helpers::addBeforeExtension($location->accroche[0]->url, Config::get('var.img_small'))}}"  width="{{$location->accroche[0]->width}}" height="{{$location->accroche[0]->height}}">

				@else 

				<img class="thumbnail small-img" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoLocation')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">

				@endif
			</div>
			<div class="infos">

				@if(Helpers::isOk($building->address) && isset($location->translation[0]))
				<span class="title-location-account">{{$location->translation[0]->value}}</span>
				<span class="address-location-account">{{$building->address}}</span>
				@else 
				<span class="building">{{trans('account.building_id',array('number'=>$building->id))}}</span>
				<span class="location">{{trans('account.location_id',array('number'=>$location->id))}}</span>
				@endif
			</div>
			<div class="actions">
			<a href="{{route('dashboard_location', array(Auth::user()->slug,$location->id))}}">{{trans('account.go_dashboard_location')}}</a>
			</div>


		</li>
		@endforeach
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
