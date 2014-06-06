@extends('account.layout')

@section('container')

<div class="hero">
	<div class="wrapper">

		<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.description_building')}}</h2>
		<div class="intro">
			{{trans('inscription.description_building_intro')}}
		</div>
	</div>
</div>
<div class="formContainer large">

	@include('includes.steps')
	
	@include('includes.errors')

	@include('includes.success')
	<div class="tabs">
		<ul>
			@foreach($locations as $location)
			@if(Helpers::isOK($currentLocation) && $currentLocation->id == $location->id)
			<li><a href="#{{$location->id}}-advert">{{$location->typeLocation->translation[0]->value}} {{$location->id}}</a></li>
			@endif
			@endforeach
		</ul>

		@foreach($locations as $location)
		@if(Helpers::isOK($currentLocation) && $currentLocation->id == $location->id)
		@if($location->nb_locations > 1)
		<div class="informations">{{trans('inscription.groupAdvert',array('number'=>$location->nb_locations,'type'=>strtolower($location->typeLocation->translation[0]->value)))}} </div>
		@endif

		<div id="{{$location->id}}-advert">
			<div class="images_category">
				@if($location->nb_locations > 1)
				<h3 aria-level="3" role="heading" class="image_cat_title">{{trans('inscription.photoSomeAdverts')}}</h3>
				@else
				<h3 aria-level="3" role="heading" class="image_cat_title">{{trans('inscription.photoOneAdvert')}}</h3>
				@endif
				<div class="informations">{{trans('inscription.buildingAdvert_intro')}}</div>
				{{Form::open(array('url'=>array('ajax/uploadLocationImage','location',$location->id),'files'=>true,'data-type'=>$location->id.'-advert','data-locationId'=> $location->id,'data-userId'=>Auth::user()->id))}}
				<div class="mulitpleLocationfileuploader">{{trans('form.upload')}}</div>

				{{Form::hidden('preview_image','',array('id'=>'preview_image'))}}

				{{Form::close()}}

				{{Form::open(array('url'=>array('ajax/uploadLocationImage', 'location', $location->id),'files'=>true,'data-type'=>$location->id.'-advert','data-locationId'=>$location->id,'data-userId'=>Auth::user()->id,'id'=>'baseForm'))}}
				{{Form::file('file', array('class'=>'baseFile'))}}
				{{Form::submit(trans('form.click'), array('class'=>'baseFile'))}}
				{{Form::close()}}


				@if(isset($photos) && Helpers::isOk( $photos))
				<div class="informations">
					{{trans('inscription.about_image_sort')}}
				</div>
				<div id="images" data-type="{{$location->id}}-advert" >
					<ul id="sortable" data-type="{{$location->id}}-advert">

						@foreach( $photos[$location->id][0]->photo as $photo)

						<li data-type="{{$location->id}}-advert">
							<span class="handle icon icon-move6"></span>		
							<a href="" class="deleteAdvertImage icon icon-remove11" data-id="{{$photo->id}}" data-locationId="{{$photo->location_id}}"  title="{{trans('form.delete_image')}}">
								<div class="image">

									<img class="thumbnail" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.locations_dir').$photo->location_id.'/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_small'))}}" alt="{{$photo->alt}}">

								</div>
							</a>
						</li>

						@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
		@endif
		@endforeach



		{{Form::open(array('method'=>'get','route'=>array('index_inscription_contact', Auth::user()->slug, $building->id, Helpers::isOk($currentLocation) ? $currentLocation->id: ''),'class'=>'mainType '))}}

		<div class="field previous">

			<a href="{{route(Config::get('var.steps_routes.6'), array(Auth::user()->slug, $building->id , Helpers::isOk($currentLocation) ? $currentLocation->id: ''))}}" title="{{trans('account.back_previous_step')}}">{{trans('general.back')}}</a>

		</div>
		<div class="field next">

			{{Form::submit(trans('form.next'))}}

		</div>
		{{Form::close()}}
	</div>
	@stop