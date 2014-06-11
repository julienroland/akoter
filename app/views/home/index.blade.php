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
								<img width="64" height="64" src="{{Config::get('var.path').Config::get('var.images_dir').Config::get('var.users_dir').$notice->user_id.'/'.Config::get('var.profile_dir').$notice->photo}}" alt="{{trans('account.imageProfile', array('name'=>$notice->firstname. ' ' .$notice->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
								@else
								@if($notice->civility == 0)
								<img width="64" height="64" itemprop="image" src="{{Config::get('var.img_dir').Config::get('var.no_photoUserM')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">
								@else
								<img width="64" height="64" itemprop="image" src="{{Config::get('var.img_dir').Config::get('var.no_photoUserF')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">
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
						{{trans('locations.accroche_title', array('number'=>$nb_locations))}}
					</span>
					<p>
						{{trans('locations.accroche_content')}}
					</p>
					<a href="{{route('listLocation')}}" class="btn-img">{{trans('general.list_locations2')}}</a>
				</div>
			</div>
		</div>	

		@if(Helpers::isOk( $posts ) )
		<article itemscope itemtype="http://schema.org/BlogPosting" class="informationsSupp" role="article">
			<div class="wrapper">
				<div class="row">
					<h2 aria-level="2" role="heading" class="section">{{Lang::get('posts.mod5_title')}}</h2>

					@foreach( $posts->data->mod5 as $post )

					<div class="infos">
						<a role="button" itemprop="url" title="{{trans('general.post.title',array('name'=>$post->title))}}" href="{{route('showPost',$post->slug)}}"><img src="/{{Config::get('var.img_posts_dir').$post->img->url}}" width="{{$post->img->width}}" height="{{$post->img->height}}" class="imgIntro" aria-hidden="true"></a>
						<h3 itemprop="headline" aria-level="3" role="heading" class="titleText">{{$post->title}}</h3>
						<div itemprop="text">
							{{$post->content}}
						</div>

						<a href="{{route('showPost',$post->slug)}}" itemprop="url" role="button" class="learnMore icon-plus12">{{trans('general.post.more')}}</a>
					</div>

					@endforeach
				</div>
			</div>
		</article>
		@endif
	</div>
</section>

<div class="overlay" aria-hidden="true">

</div>
@if(!Cookie::has('map') && !Cookie::has('tuto'))

@include('includes.tutoMap')

@endif
@stop