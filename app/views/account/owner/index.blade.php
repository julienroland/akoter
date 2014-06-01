
<div class="home-location">
	<div class="account-intro">
		<h2 aria-level="2" role="heading" class="title-account">{{trans('account.your_properties')}}</h2>
	</div>
	<div class="content">

		@if(isset($activeLocations) && $activeLocations->count())

		@if($activeLocations->activeBuilding->count() > 1)

		<h3 aria-level="3" role="heading" class="undertitle-account">{{trans('account.validsLocations')}}</h3>

		@else

		<h3 aria-level="3" role="heading" class="undertitle-account">{{trans('account.validLocation')}}</h3>

		@endif

		<div class="activeLocations">

			<ul>

				@foreach( $activeLocations->activeBuilding as $building)
				@foreach( $building->activeLocation as $location)

				<li class="location-account success">
					<a href="{{route('dashboard_location', array(Auth::user()->slug,$location->id))}}">	
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

							<div class="remainingPlace">
								@if(Helpers::isNotOk($location->nb_locations))

								@if(Helpers::isOk($location->nb_room) && Helpers::isOk($location->remaining_room))
								{{trans('account.room_remaining_location')}}: {{$location->nb_room - $location->remaining_room }} / {{$location->nb_room}}
								@else
								{{trans('account.locationComplete',array('number'=>$location->nb_room - $location->remaining_room .'/'. $location->nb_room))}}
								@endif
								@else

								{{trans('account.nb_location', array('number'=>$location->remaining_location))}}

								@endif
							</div>

							<div class="applications_location">
								@if($location->request->count() == 1)
								{{trans('account.request_location',array('number'=>$location->request->count()))}}
								@else
								{{trans('account.requests_location',array('number'=>$location->request->count()))}}
								@endif
							</div>
						</div>
						<!-- <div class="actions">

							@if($location->available == 1)
							<div class="desactivate icon icon-remove11 tooltip-ui-e" title="{{trans('account.desactivateLocation')}}"></div>
							@else
							<div class="desactive icon icon-approve tooltip-ui-e" title="{{trans('account.activateLocation')}}"></div>
							@endif
							<div class="see icon icon-view6 tooltip-ui-e" title="{{trans('account.seeLocation')}}"></div>

						</div> -->

					</a>
				</li>

				@endforeach
				@endforeach

			</ul>

		</div>

		@endif

		@if($waitingLocations->building->count())


		<h3 aria-level="3" role="heading" class="undertitle-account">{{trans('account.waitingLocations')}}</h3>

		<div class="waitingLocations">

			<ul>
				@foreach( $waitingLocations->building as $building)
				@foreach($building->location as $location)

				<li class="location-account">	
					<a href="{{route('dashboard_location', array(Auth::user()->slug,$location->id))}}">
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
							{{trans('account.go_dashboard_location')}}
						</div>

					</a>
				</li>
				@endforeach
				@endforeach

			</ul>

		</div>

		@endif

		@if(isset($invalidLocations) && $invalidLocations->count())

		@if($invalidLocations->count() > 1)

		<h3 aria-level="3" role="heading" class="undertitle-account">{{trans('account.invalidLocations')}}</h3>

		@else

		<h3 aria-level="3" role="heading" class="undertitle-account">{{trans('account.invalidLocation')}}</h3>

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
	</div>
</div>