@extends('agence.layout')

@section('agence')
	@include('agence.top')
	<div class="locations">
		<ul>
			@if($locations->count() > 0)
			@foreach($locations as $location)
			<?php $slug = $location->translations->lists('value','key')['slug']; ?>
			<?php $title = $location->translations->lists('value','key')['title'];?>
			<li class="location-account success">
				<a @if(Auth::check()) href="{{route('dashboard_location', array(Auth::user()->slug,$location->id))}}" @else href="{{route('showLocation', $slug)}}" title="{{trans('locations.goTo',array('title'=>$title))}}" @endif>	
					<div class="image">

						@if(isset($location->accroche[0]))

						<img class="thumbnail small-img" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').$agence->user_id.'/'.Config::get('var.locations_dir').$location->id.'/'.Helpers::addBeforeExtension($location->accroche[0]->url, Config::get('var.img_small'))}}"  width="{{$location->accroche[0]->width}}" height="{{$location->accroche[0]->height}}">

						@else 

						<img class="thumbnail small-img" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoLocation')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">

						@endif
					</div>
					<div class="infos">

						@if(Helpers::isOk($location->building->address) && isset($location->translation[0]))
						<span class="title-location-account">{{$location->translation[0]->value}}</span>
						<span class="address-location-account">{{$location->building->address}}</span>
						@else 
						<span class="building">{{trans('account.building_id',array('number'=>$building->id))}}</span>
						<span class="location">{{trans('account.location_id',array('number'=>$location->id))}}</span>
						@endif

						<div class="remainingPlace">
							@if(Helpers::isNotOk($location->nb_locations))

							@if(Helpers::isOk($location->nb_room) && Helpers::isOk($location->remaining_room) && $location->remaining_room)
							{{trans('account.room_remaining_location')}}: {{$location->nb_room - $location->remaining_room }} / {{$location->nb_room}}
							@else
							{{trans('account.locationComplete',array('number'=>$location->nb_room - $location->remaining_room .'/'. $location->nb_room))}}
							@endif
							@else
							@if($location->remaining_location > 1)
							{{trans('account.nb_location', array('number'=>$location->remaining_location))}}
							@else
							{{trans('account.room_remaining',array('number'=>$location->remaining_room))}}
							@endif
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
					<div class="actions">
						<div class="see icon icon-view6 tooltip-ui-e" >{{trans('account.seeLocation')}}</div>

					</div>

				</a>
			</li>
			@endforeach
			@else
			<li class="informations">{{trans('agence.nos_locations', array('name'=>$agence->name))}}</li>
			@endif
		</ul>
	</div>
</div>
</div>
@stop