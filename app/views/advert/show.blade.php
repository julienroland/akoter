@extends('layout.layout')

@section('container')

<div class="wrapper">

	<div class="advert">
		<h1 aria-level="1" role="heading" class="advertTitle">{{$translations['title']}}</h1>
		<div class="tabs">
			<ul class="advert-tabs">
				<li><a class="" href="#description-tab">{{trans('locations.description')}}</a></li>
				<li><a class="" href="#localisation-tab">{{trans('locations.localisation')}}</a></li>
				<li><a class="" href="#pictures-tab">{{trans('locations.pictures')}}</a></li>
				<li><a class="" href="#equipment-tab">{{trans('locations.equipment')}}</a></li>
				<li><a class="" href="#comment-tab">{{trans('locations.comments')}}</a></li>
			</ul>

			<div id="description-tab" class="pannel">
				<div class="slider">
					<div class="slide">
						<div class="rslides" id="slider">
							@foreach($photosLocation as $photo)
							<li><a href="#"><img  src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.locations_dir').$photo->location_id.'/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_lightbox'))}}" width="{{$lightbox->width}}" height="{{$lightbox->height}}"></a></li>
							@endforeach

						</div>
					</div>
					<!-- Slideshow 3 Pager -->
					<ul id="slider-pager">
						@foreach($photosLocation as $photo)
						<li><a href="#"><img src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.locations_dir').$photo->location_id.'/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_lightbox'))}}" width="{{$small->width}}" height="{{$small->height}}" ></a></li>
						@endforeach

					</ul>
				</div>

				<div class="description">
					<span class="title-description">{{trans('locations.title_description', array('type'=>$typeLocation,'city'=>$locality))}}</span>

					{{$translations['advert']}}

				</div>

				
			</div>
			<div id="localisation-tab" class="pannel">
				<div id="showMap" data-location="{{$building->latlng}}"></div>
				<div class="informations-situation">
					<span class="title-situation">
						{{trans('locations.situation_title')}}
					</span>
					<p>
						{{$building_translations['situations']}}
					</p>
					<span class="title-situation">
						{{trans('locations.more_situation_infos')}}
					</span>
					<p>
						{{$building_translations['advert']}}
					</p>
				</div>
			</div>

			<div id="pictures-tab" class="pannel">
				@foreach($photosBuilding as $photo)
				<div class="picture-gallery">
					<img class="thumbnail" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.buildings_dir').$photo->building_id.'/'.$photo->type.'/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_gallery'))}}" width="{{$gallery->width}}">
				</div>	
				@endforeach
			</div>

			<div id="equipment-tab" class="pannel">
			</div>

			<div id="comment-tab" class="pannel">
			</div>
		</div>
		<sidebar class="advert-sidebar">
			<div class="infos-master">

				<span class="price">{{round($location->price)}}€</span>
				<span class="perMonth">{{trans('general.perMonth')}}</span>
				<div class="date">
					<span class="dt">A parti du: </span>
					<i class="icon icon-calendar68"></i>
					<span class="start fdate">{{Helpers::beTime(Helpers::createCarbonDate($location->start_date), '$d $nd $M $y')}}</span>
					<span class="to">{{trans('general.to')}}</span>
					<span class="start fdate">{{Helpers::beTime(Helpers::createCarbonDate($location->end_date), '$d $nd $M $y')}}</span>
				</div>
				@if($location->advert_specific == 0)
				{{trans('locations.remaining_location',array('number'=>$location->remaining_location))}}
				@endif
				<span class="total-month">{{trans('locations.contrat_during',array('time'=>Helpers::createCarbonDate($location->start_date)->diffInMonths(Helpers::createCarbonDate($location->end_date))))}} <b></b></span>
				<a href="" class="reserved">{{trans('locations.reserved')}}</a>
				<a href="" class="contact btn">{{trans('locations.contacted')}}</a>
			</div>
			<div class="rating">
				<div class="icons" >
					<span class="section">{{Helpers::getRating($location->rating)}} {{Lang::get('locations.stars')}}</span>
					<span class="icon {{Helpers::isStar( 1, Helpers::getRating($location->rating) )}} " aria-hidden="true"></span>
					<span class="icon {{Helpers::isStar( 2, Helpers::getRating($location->rating) )}}" aria-hidden="true"></span>
					<span class="icon {{Helpers::isStar( 3, Helpers::getRating($location->rating) )}}" aria-hidden="true"></span>
					<span class="icon {{Helpers::isStar( 4, Helpers::getRating($location->rating) )}}" aria-hidden="true"></span>
					<span class="icon {{Helpers::isStar( 5, Helpers::getRating($location->rating) )}}" aria-hidden="true"></span>
				</div>

				<span class="number_rate">Nombre de votes : <strong>{{$location->nb_rate}}</strong></span>
			</div>
			<div class="user">
				<div class="user-picture">
					<img class="thumbnail" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.profile_dir').$user->photo}}" alt="">
				</div>
				<div class="user-info">
					<span class="name">{{$user->first_name}} {{$user->name}}</span>
					<p>
						{{trans('locations.tenant_since', array('date'=>$user->created_at->year))}}
					</p>
					<p>
						{{trans('locations.profile_check')}}
					</p>
				</div>
				
			</div>
		</sidebar>
	</div>
</div>

@stop