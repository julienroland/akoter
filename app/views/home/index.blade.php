@extends('layout.layout')
@section('container')
@include('popup.lang')
@include('notifications.index')
<section class="main">
	<h2 class="section" role="heading" aria-level="2">{{trans('title.home')}}</h2>

	@include('map.index')

	<div class="home">
		<a href="#informations" class="goTo" title="Aller à la suite du contenu"><span class="icon icon-chevron11"></span></a>
		@if(Helpers::isOk($locations))
		<div class="residence" id="residence">
			<div class="wrapper">
				<section class="kots" id="main">
					<h2 aria-level="2" role="heading" class="mainTitle">{{trans('general.last_adverts')}}</h2>
					<div id="container" class="wrapper">
						<div class="row">

							@foreach($locations as  $location)

							@include('locations-list')
							
							@endforeach
							
						</div>
					</div>
				</section>

			</div>
		</div>
		<!-- end locations -->
		@endif 

		@if(Helpers::isOk($notices))
		<div class="callback">
			<div class="wrapper">
				<div class="row">
					<h2 aria-level="2" role="heading" class="mainTitle">{{Lang::get('title.notice')}}</h2>
					@foreach( $notices->data as $notice)
					<div class="onePeople" itemscope itemtype="http://schema.org/Person">
						<div class="vcard">
							<div class="photo" >

								@if(Helpers::isOk($notice->photo))
								<img itemprop="image" src="{{Config::get('var.img_users_dir').$notice->photo}}" alt="{{Lang::get('notices.alt_photoOf')}} {{$notice->first-name}} {{$notice->name}}">
								@else
								@if($notice->civility == 0)
								<img itemprop="image" src="{{Config::get('var.img_dir').Config::get('var.no_photoUserM')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">
								@else
								<img itemprop="image" src="{{Config::get('var.img_dir').Config::get('var.no_photoUserF')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">
								@endif
								@endif
							</div>
							<div class="infosPeople">

								<meta itemprop="nationality" content="Belgian">
								<span class="name" itemprop="name">{{$notice->firstname}} <span class="b">{{$notice->name}}</span></span>
								<div itemscope class="address" itemtype="http://schema.org/PostalAddress" itemprop="address">
									<span itemprop="addressRegion">{{Lang::get('locations.from_locality')}} {{$notice->locality}}</span>
									<meta itemprop="postalCode" content="{{$notice->postal}}">
								</div>
							</div>
						</div>
						<div class="text">
							<p>
								{{$notice->text}}
							</p>
						</div>
					</div> 
					@endforeach
				</div>
			</div>
		</div>
		<!-- end notices -->
		@endif
		<div class="howMuchLocations" style="background:url(/img/posts/howMuchLocations.jpg); background-position: center bottom; background-repeat: no-repeat; background-size: cover;">
			<div class="wrapper">
				<div class="content">
					<span class="accroche">
						<span class="b">Akoter</span> c'est <span class="nb_locations">{{$nb_locations}}</span> locations
					</span>
					<p>
						dans toute la Belgique.
						Trouvez le logement de vos rêves grâce à notre système de recherche !
					</p>
					<a href="{{route('listLocation')}}" class="btn-img">{{trans('general.list_locations2')}}</a>
				</div>
			</div>
		</div>	
		@if(Helpers::isOk( $posts ) )
		<section class="informationsSupp" role="article">
			<div class="wrapper">
				<div class="row">
					<h2 aria-level="2" role="heading" class="section">{{Lang::get('posts.mod5_title')}}</h2>

					@foreach( $posts->data->mod5 as $post )

					<div class="infos">
						<a aria-hidden="true" href="{{url(trans('routes.posts').'/'.$post->slug)}}"><img src="{{Config::get('var.img_posts_dir')}}{{$post->img->url}}" width="{{$post->img->width}}" height="{{$post->img->height}}" class="imgIntro" aria-hidden="true"></a>
						<h3 aria-level="3" role="heading" class="titleText">{{$post->title}}</h3>
						{{$post->content}}

						<a href="{{url(trans('routes.posts').'/'.$post->slug)}}" class="learnMore icon-plus12">En savoir plus</a>
					</div>

					@endforeach
				</div>
			</div>
		</section>
		@endif
	</div>
</section>

<div class="overlay" aria-hidden="true">

</div>
@if(!Cookie::has('map') && !Cookie::has('tuto'))

@include('includes.tutoMap')

@endif
@stop