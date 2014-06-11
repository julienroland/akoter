@extends('layout.layout')

@section('container')

<div class="wrapper">

	<div class="advert" itemscope itemtype="http://schema.org/Residence">
		<div class="section" itemprop="geo" itemtype="GeoCoordinates">
			<meta content="{{Helpers::extractLatLng($location->building->latlng, 'lat')}}" itemprop="latitude">
			<meta content="{{Helpers::extractLatLng($location->building->latlng, 'lng')}}" itemprop="longitude">
		</div>
		<h1 aria-level="1" role="heading" itemprop="name" title="{{$translations['title']}}" class="advertTitle">{{$translations['title']}}</h1>
		<div class="tabs">
			<div class="ref">{{trans('locations.ref',array('ref'=>$location->id))}}</div>
			<ul class="advert-tabs">
				<li><a class="" href="#description-tab">{{trans('locations.description')}}</a></li>
				<li><a class="" id="tabslocalisation" href="#localisation-tab">{{trans('locations.localisation')}}</a></li>
				<li><a class="" id="tabspicture" href="#pictures-tab">{{trans('locations.pictures')}}</a></li>
				<li><a class="" href="#equipment-tab">{{trans('locations.specificity')}}</a></li>
				@if($location->comments_status == 1  )
				<li><a class="" href="#comment-tab">{{trans('locations.comments')}}</a></li>
				@endif
			</ul>

			<div id="description-tab" class="pannel">
				<div class="slider">
					<div class="slide">
						<div class="rslides" id="slider">
							@foreach($photosLocation as $photo)
							<li class="thumbnail"><a href="#"><img itemprop="image" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').$user->id.'/'.Config::get('var.locations_dir').$photo->location_id.'/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_lightbox'))}}" width="{{$lightbox['width']}}" height="{{$lightbox['height']}}"></a></li>
							@endforeach

						</div>
					</div>
					<!-- Slideshow 3 Pager -->
					<ul id="slider-pager">
						@foreach($photosLocation as $photo)
						<li><a href="#"><img src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').$user->id.'/'.Config::get('var.locations_dir').$photo->location_id.'/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_small'))}}" width="{{$small['width']}}" height="{{$small['height']}}" ></a></li>
						@endforeach

					</ul>
				</div>

				<div class="description" itemprop="description">
					<span class="title-description">{{trans('locations.title_description', array('type'=>$typeLocation,'city'=>$location->building->locality->name))}}</span>

					{{$translations['advert']}}

				</div>

			</div>
			<div id="localisation-tab" class="pannel">
				<div class="thumbnail showmap">
					<div  id="showMap" data-location="{{$building->latlng}}"></div>
				</div>
				<div class="localisation">

					<address itemscope itemprop="address" class="address">
						<div class="line"><span class="number">{{$location->building->number}}</span> <span itemprop="streetAddress" class="street">{{$location->building->address}}</span></div>
						<div class="line"><span class="postal" itemprop="postal">{{$location->building->postal}}</span>  <span itemprop="addressRegion" class="locality">{{$location->building->locality->name}}</span> (<span class="region">{{$region}}</span>)</div>
						<meta content="BE" itemprop="addressCountry">
					</address>
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
							{{isset($building_translations['advert']) ? html_entity_decode($building_translations['advert']) :''}}
						</p>
					</div>
				</div>
			</div>

			<div id="pictures-tab" class="pannel">
				@foreach($photosBuilding as $photo)
				<div class="picture-gallery thumbnail">
					<img  itemprop="image" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').$user->id.'/'.Config::get('var.buildings_dir').$photo->building_id.'/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_gallery'))}}" width="{{$gallery['width']}}">
				</div>	
				@endforeach
			</div>

			<div id="equipment-tab" class="pannel">
				<div class="infos-usefull">
					<span class="equipment-title">{{trans('locations.particularity-title')}}</span>
					<ul>
						<li class="option"><span class="icon icon-meter2"></span>{{trans('locations.size')}}: {{round($location->size)}} m<sup>2</sup></li>
						<li class="option"><span class="icon icon-longa"></span>{{trans('locations.floor')}}: {{$location->floor}} {{$location->floor == 0 ? trans('locations.ground_floor') : $location->floor == 1 ? trans('locations.first_floor') : trans('locations.th')}}</li>
						@if($location->accessible == 1 )
						<li class="option"><span class="icon icon-check30"></span>{{trans('locations.accessible')}} </li>
						@endif
					</ul>
				</div>
				<div class="particularity">
					<span class="equipment-title">{{trans('locations.particularity-title')}}</span>
					<ul>
						@foreach($particularities as $particularity)

						<li class="option"><i class="icon {{$particularity->icon}}"></i>{{$particularity->translation[0]->value}}</li>
						@endforeach
					</ul>
				</div>
				<div class="building-equipment">
					<span class="equipment-title">{{trans('locations.building-equipment-title')}}</span>
					<ul>
						<?php $i=0; ?>
						@foreach($optionBuilding as $id => $name)

						<li class="option {{$i !== 0 && $i%2 != 0 ? 'striped' : ''}} "><i class="icon icon-check30"></i>{{$name}}</li>

						<?php $i++; ?>
						@endforeach
					</ul>
				</div>
				<div class="location-equipment">
					<span class="equipment-title">{{trans('locations.location-equipment-title')}}</span>
					<ul>
						<?php $i=0; ?>
						@foreach($optionLocation as $id => $name)

						<li class="option {{$i !== 0 && $i%2 != 0 ? 'striped' : ''}} "><i class="icon icon-check30"></i>{{$name}}</li>

						<?php $i++; ?>
						@endforeach
					</ul>
				</div>
			</div>
			@if($location->comments_status == 1  )
			<div id="comment-tab" class="pannel">
				<div class="comments_location">

					@if(Helpers::isOk($comments))
					<div class="comments">

						<?php $i=0; ?>
						@foreach($comments as $comment)
						<?php $translation = $comment->translation->lists('value','key'); ?>

						<div class="comment {{$i !== 0 && $i%2 != 0 ? 'striped' : ''}}">
							<div class="user vcard" id="hcard-{{$comment->user->first_name}}-{{$comment->user->name}}">
								<div class="photo">
									@if(Helpers::isOk($comment->user->photo))
									<img class="thumbnail" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').$comment->user->id.'/'.Config::get('var.profile_dir').$comment->user->photo}}" >
									@else
									@if($comment->user->civility == 0)

									<img class="thumbnail" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserM')}}" alt="{{trans('account.imageProfile', array('name'=>$comment->user->first_name. ' ' .$comment->user->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">

									@else 

									<img class="thumbnail" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserF')}}" alt="{{trans('account.imageProfile', array('name'=>$comment->user->first_name. ' ' .$comment->user->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
									@endif
									@endif
								</div>
								<span class="fn n name"><span class="given-name">{{$comment->user->first_name}}</span> <span class="family-name">{{$comment->user->name}}</span></span>
								<a class="email section" href="mailto:{{$comment->user->email}}">{{$comment->user->email}}</a>
								<div class="adr section">
									<div class="street-address">{{$comment->user->address}}</div>
									<span class="locality">{{$comment->user->locality}}</span>

									<span class="region">{{$comment->user->region->translation[0]->value}}</span>
									
									<span class="postal-code">{{$comment->user->postal}}</span>

								</div>

							</div>
							<span class="date">{{trans('locations.comment_publish',array('date'=>Helpers::beTime($comment->created_at)))}}</span>
							<div class="icons rating" >
								<span class="section">{{Helpers::getRating($comment->rating)}} {{Lang::get('locations.stars')}}</span>
								<span class="icon {{Helpers::isStar( 1, $comment->rating )}} " aria-hidden="true"></span>
								<span class="icon {{Helpers::isStar( 2, $comment->rating )}}" aria-hidden="true"></span>
								<span class="icon {{Helpers::isStar( 3, $comment->rating )}}" aria-hidden="true"></span>
								<span class="icon {{Helpers::isStar( 4, $comment->rating )}}" aria-hidden="true"></span>
								<span class="icon {{Helpers::isStar( 5, $comment->rating )}}" aria-hidden="true"></span>
							</div>
							<span class="title">{{$translation['title']}}</span>
							<p>
								{{$translation['text']}}
							</p>
						</div>

						<?php $i++; ?>
						@endforeach

					</div>
					@else

					@if(Auth::user()->location()->whereLocationId($location->id)->whereRequest(0)->count())

					<p class="no_comment">{{trans('locations.no_comments_allow')}}</p>

					@else

					<p class="no_comment">{{trans('locations.no_comments')}}</p>

					@endif

					@endif


					@if(Auth::check())

					@if(Auth::user()->location()->whereLocationId($location->id)->whereRequest(0)->count())

					{{Form::open(array('route'=>array('addComments', $location->id),'class'=>'mainType rules','data-rules'=>json_encode(Location::$comment_rules)))}}
					<div class="user">
						<div class="user-photo">
							@if(Helpers::isOk(Auth::user()->photo))
							<img  class="thumbnail" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.profile_dir').Auth::user()->photo}}">
							@else
							@if(Auth::user()->civility == 0)

							<img class="thumbnail" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserM')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">

							@else 

							<img class="thumbnail" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserF')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
							@endif
							@endif
						</div>
						<span class="name">{{Auth::user()->first_name. ' ' . Auth::user()->name}}</span>
						<!-- <div class="date">

							<span class="start">{{Helpers::dateNaForm(Auth::user()->location()->get()->last()->pivot->begin)}}</span>
							<span class="end">{{Helpers::dateNaForm(Auth::user()->location()->get()->last()->pivot->end)}}</span>
						</div> -->

					</div>

					<div class="form">
						<div class="field">
							<label for="title">{{trans('form.title')}}</label>
							<input type="text" name="title" id="title" placeholder="{{trans('form.title')}}">
						</div>

						<div class="field">
							{{Form::label('note',trans('form.rate'). ' ('.trans('form.click-rating').')')}}
							<div class="note_propriete">

								<label for="note1" >

									{{Form::radio('note','1',array('id'=>'note1'))}}	

								</label>

								<label for="note2" >

									{{Form::radio('note','2',array('id'=>'note2'))}}	

								</label>	

								<label for="note3">

									{{Form::radio('note','3',array('id'=>'3note3'))}}	

								</label>

								<label for="note4">

									{{Form::radio('note','4',array('id'=>'note4'))}}	

								</label>

								<label for="note5">

									{{Form::radio('note','5',array('id'=>'note5'))}}	

								</label>

							</div>
						</div>

						<label for="text">{{trans('form.comment')}}</label>
						<textarea name="text" id="text"></textarea>

						{{Form::submit(trans('form.commenting'))}}
						{{Form::close()}}
					</div>
					@endif
					@else

					<p>{{trans('locations.connect_comment')}} <a href="{{route('connection')}}">{{trans('locations.connection')}}</a>.</p>

					@endif

				</div>
				@endif
			</div>		
		</div>
		<sidebar class="advert-sidebar">
			<div class="infos-master">

				<span class="price">{{round($location->price)}}€</span>
				<span class="perMonth">{{trans('general.perMonth')}}</span>
				<span class="charge">{{trans('locations.charge')}} {{Config::get('var.charges')[$location->charge_type]}} {{$location->charge_price > 0 ? '&nbsp;('.round($location->charge_price) .'€)' : ''}}</span>
				@if($location->charge_type == 1)
				<span class="chargePrice">{{$location->charge_price}}€</span>
				@endif
				<span class="typeLocation"><i class="icon icon-longa"></i>{{$typeLocation}}	<span class="section">{{trans('locations.typeLocation',array('name'=>$typeLocation))}}</span></span>
				<span class="nb_seat"><i class="icon icon-user3"></i>{{trans('locations.nb_seat',array('number'=>$location->remaining_room))}}</span>

				@if(!Helpers::dateEmpty($location->start_date) && !Helpers::dateEmpty($location->end_date))
				<div class="date">
					<span class="dt"><span class="dt-d">{{trans('locations.start_at')}} </span></span>
					<span class="start fdate">{{Helpers::beTime(Helpers::createCarbonDate($location->start_date), '$d $nd $M $y')}}</span>
					<span class="dt"><span class="to">{{trans('general.to_date')}}</span></span>
					<span class="start fdate">{{Helpers::beTime(Helpers::createCarbonDate($location->end_date), '$d $nd $M $y')}}</span>
				</div>
				@endif
				<span class="caution"><i class="icon icon-piggy1"></i>	{{trans('locations.garantee', array('number'=>round($location->garantee)))}}</span>
				<p class="remaining_location">
					@if($location->advert_specific == 0)
					{{trans('locations.remaining_location',array('number'=>$location->remaining_location,'type'=>$typeLocation))}}
					@endif
				</p>

				@if(isset($location->start_date) && isset($location->end_date))
				<span class="total-month">{{trans('locations.contrat_during',array('time'=>Helpers::createCarbonDate($location->start_date)->diffInMonths(Helpers::createCarbonDate($location->end_date))))}} <b></b></span>
				@endif
				@if(Auth::check() && $location->user()->whereUserId(Auth::user()->id)->whereStatus(1)->count() > 0)
				
				<a href="" class="icon icon-key105 reserved">{{trans('locations.activeTenant')}}</a>

				@else
				<a href="{{route('reserved', array($translations['slug']))}}" class="icon icon-key105 reserved {{Auth::check() && Helpers::isOk($location->user()->whereUserId(Auth::user()->id)->whereRequest(1)->first()) ?  $location->user()->whereUserId(Auth::user()->id)->whereRequest(1)->first()->count() ? 'waiting': '': ''}}">{{Auth::check() && Helpers::isOk($location->user()->whereUserId(Auth::user()->id)->whereRequest(1)->first()) ? $location->user()->whereUserId(Auth::user()->id)->whereRequest(1)->first()->count() ? trans('locations.waiting_reserved'):trans('locations.reserved') : trans('locations.reserved')}}</a>
				@endif
				@if(Auth::guest())
				<div class="informations">{{trans('general.required_connected')}}</div>
				@endif
				<a href="{{route('contact_owner', array($user->slug, $location->id))}}" class="contact-form btn lightbox">{{trans('locations.contacted')}}</a>
				
				
			</div>
			<div class="rating">
				<div class="icons rating tooltip-ui-w" title="{{Helpers::getRating($location->rating)}} {{Lang::get('locations.stars')}} {{trans('general.on')}} {{trans('locations.nb_vote',array('number'=>$location->nb_rate))}}">
					<span class="section">{{Helpers::getRating($location->rating)}} {{Lang::get('locations.stars')}}</span>
					<span class="icon {{Helpers::isStar( 1, $location->rating )}} " aria-hidden="true"></span>
					<span class="icon {{Helpers::isStar( 2, $location->rating )}}" aria-hidden="true"></span>
					<span class="icon {{Helpers::isStar( 3, $location->rating )}}" aria-hidden="true"></span>
					<span class="icon {{Helpers::isStar( 4, $location->rating )}}" aria-hidden="true"></span>
					<span class="icon {{Helpers::isStar( 5, $location->rating )}}" aria-hidden="true"></span>
				</div>

				<span class="number_rate">{{trans('locations.nb_rate',array('number'=>$location->nb_rate))}} </span>
			</div>
			@if(Helpers::isOk($favoris) && $favoris->count())
			<div class="favoris"><a href="{{route('removeFavoris', $location->id)}}" class="icon icon-big61 tooltip-ui-s" title="{{trans('locations.removeFavoris')}}"></a></div>
			@else
			<div class="favoris"><a href="{{route('addFavoris', $location->id)}}" class="icon icon-big61 tooltip-ui-s" title="{{trans('locations.favoris')}}"></a></div>
			@endif
			@if(Helpers::isNotOk($agence))
			<div class="user vcard" id="hcard-{{$user->first_name}}-{{$user->name}}">
				<div class="user-picture">
					@if(Helpers::isOk($user->photo))
					<img class="thumbnail photo" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').$user->id.'/'.Config::get('var.profile_dir').$user->photo}}" alt="{{$user->name}}">
					@else
					@if(Auth::user()->civility == 0)

					<img class="thumbnail photo" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserM')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">

					@else 

					<img class="thumbnail photo" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserF')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
					@endif
					@endif
				</div>
				<div class="user-info">
					<span class="fn n name"><span class="given-name">{{$user->first_name}}</span> <span class="family-name">{{$user->name}}</span></span>
					<a class="email section" href="mailto:{{$user->email}}">{{$user->email}}</a>
					<div class="adr section">
						<div class="street-address">{{$user->address}}</div>
						<a class="url fn section" href="{{$user->web}}">{{$user->first_name}} {{$user->name}}</a>
						<span class="locality">{{$user->locality->name}}</span>

						<span class="region">{{$user->region->translation[0]->value}}</span>

						<span class="postal-code">{{$user->postal}}</span>

					</div>
					<p>
						{{trans('locations.tenant_since', array('date'=>$user->created_at->year))}}
					</p>
					<p>
						{{trans('locations.profile_check')}}
					</p>
				</div>
			</div>
			@else
			<div class="user">

				<a href="{{route('showAgence', $agence->slug)}}" class="tooltip-ui-e" title="{{trans('locations.see_agence')}}">
					<div class="user-picture">
						<img class="thumbnail" src="/{{Config::get('var.images_dir')}}{{Config::get('var.agences_dir')}}{{$agence->id}}/{{Config::get('var.logoAgence_dir')}}{{$agence->logo}}" width="{{Config::get('var.agence_logo_width')}}" height="{{Config::get('var.agence_logo_height')}}" alt="{{trans('general.logo_of_agency', array('name'=>$agence->name))}}">
					</div>
					<div class="user-info">
						<span class="name">{{$agence->name}}</span>
						<p>
							{{trans('locations.agence_since', array('date'=>$user->created_at->year))}}
						</p>
						<p>
							{{trans('locations.profile_check')}}
						</p>
					</div>
				</a>
			</div>
			@endif
		</sidebar>
	</div>
</div>

@stop