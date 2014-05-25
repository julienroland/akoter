@extends('layout.layout')

@section('container')

<div class="wrapper">

	<div class="advert">
		<h1 aria-level="1" role="heading" class="advertTitle">{{$translations['title']}}</h1>
		<div class="tabs">
			<ul class="advert-tabs">
				<li><a class="" href="#description-tab">{{trans('locations.decription')}}</a></li>
				<li><a class="" href="#localisation-tab">{{trans('locations.localisation')}}</a></li>
				<li><a class="" href="#pictures-tab">{{trans('locations.pictures')}}</a></li>
				<li><a class="" href="#equipment-tab">{{trans('locations.equipment')}}</a></li>
			</ul>

			<div id="description-tab " class="pannel">


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
					<div class="user-contact">
						
					</div>
				</div>
			</div>
			<div id="localisation-tab " class="pannel">
			</div>

			<div id="pictures-tab " class="pannel">
			</div>

			<div id="equipment-tab " class="pannel">
			</div>
		</div>
		<sidebar class="advert-sidebar">
			<div class="infos-master">
				<span class="price">300€</span>
				<span class="perMonth">Par mois</span>
				<div class="date">
					<span class="dt">A parti du: </span>
					<i class="icon icon-calendar68"></i>
					<span class="start fdate">19 Septembre</span>
					<span class="to">au</span>
					<span class="start fdate">18 Juin</span>
				</div>
				<span class="total-month">Contrat d'une durée de <b>10 mois</b></span>
				<a href="" class="reserved">Reserver</a>
				<a href="" class="contact">Contacter</a>
			</div>
		</sidebar>
	</div>
</div>

@stop