@extends('agence.layout')

@section('agence')

<div class="agence-profile">
	<div class="header">
		<div class="image thumbnail">
			<img src="/{{Config::get('var.images_dir')}}{{Config::get('var.agences_dir')}}{{$agence->id}}/{{Config::get('var.logoAgence_dir')}}{{$agence->logo}}" alt="{{$agence->name}}">
		</div>
		<span class="name">
			{{$agence->name}}
		</span>
		<span class="nb_employes">
			{{trans('agence.nb_employes',array('number'=>$agence->nb_employes))}}
		</span>		
	</div>
	<nav class="menu-agence-profile">
		<ul>
			<li >
				<a class="active" href="">Locations</a>
			</li>
			<li >
				<a class="active" href="">Membres</a>
			</li>
			<li >
				<a class="active" href="">Informations</a>
			</li>
		</ul>
	</nav>
	<div class="locations">
		<ul>
		@if($locations->count() > 0)
		@foreach($locations as $location)
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
@stop