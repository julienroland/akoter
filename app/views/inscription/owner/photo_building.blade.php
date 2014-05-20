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

	<div class="images_category">
		<h3 aria-level="3" role="heading" class="image_cat_title">{{trans('inscription.photoBuilding')}}</h3>
		<div class="informations">{{trans('inscription.buildingPhoto_intro')}}</div>
		{{Form::open(array('url'=>array('ajax/uploadBuildingImage','building',$building->id),'files'=>true,'data-type'=>'building','data-proprieteId'=> $building->id,'data-userId'=>Auth::user()->id))}}
		<div class="mulitplefileuploader">{{trans('form.upload')}}</div>

		{{Form::hidden('preview_image','',array('id'=>'preview_image'))}}

		{{Form::close()}}

		{{Form::open(array('url'=>array('ajax/uploadBuildingImage', 'building', $building->id),'files'=>true,'data-type'=>'building','data-proprieteId'=>$building->id,'data-userId'=>Auth::user()->id,'id'=>'baseForm'))}}
		{{Form::file('file', array('class'=>'baseFile'))}}
		{{Form::submit('envoyer', array('class'=>'baseFile'))}}
		{{Form::close()}}


		@if(isset($photos['building']) && Helpers::isOk( $photos['building']))
		<div class="informations">
			{{trans('inscription.about_image_sort')}}
		</div>
		<div id="images" data-type="building" >
			<ul id="sortable">
				@foreach( $photos['building'] as $photo)

				<li >
					<span class="handle icon icon-move6"></span>		
					<a href="" class="deleteImage icon icon-remove11" data-id="{{$photo->id}}" data-proprieteId="{{$photo->building_id}}" data-type="{{$photo->type}}" title="{{trans('form.delete_image')}}">
						<div class="image">

							<img class="thumbnail" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.buildings_dir').$photo->building_id.'/building/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_small'))}}" alt="{{$photo->alt}}">

						</div>
					</a>
				</li>

				@endforeach
			</ul>
		</div>
		@endif
	</div>

	<div class="images_category">
		<h3 aria-level="3" role="heading" class="image_cat_title">{{trans('inscription.photoBuildingCommon')}}</h3>
		<div class="informations">{{trans('inscription.buildingPhotoCommon_intro')}}</div>
		{{Form::open(array('url'=>array('ajax/uploadBuildingImage','common',$building->id),'files'=>true,'data-type'=>'common','data-proprieteId'=> $building->id,'data-userId'=>Auth::user()->id))}}
		<div class="mulitplefileuploader">{{trans('form.upload')}}</div>

		{{Form::hidden('preview_image','',array('id'=>'preview_image'))}}

		{{Form::close()}}

		{{Form::open(array('url'=>array('ajax/uploadBuildingImage', 'common', $building->id),'files'=>true,'data-type'=>'common','data-proprieteId'=>$building->id,'data-userId'=>Auth::user()->id,'id'=>'baseForm'))}}
		{{Form::file('file', array('class'=>'baseFile'))}}
		{{Form::submit('envoyer', array('class'=>'baseFile'))}}
		{{Form::close()}}


		@if(isset($photos['common']) && Helpers::isOk( $photos['common']))
		<div class="informations">
			{{trans('inscription.about_image_sort')}}
		</div>
		<div id="images" data-type="common" >
			<ul id="sortable">
				@foreach( $photos['common'] as $photo)

				<li >
					<span class="handle icon icon-move6"></span>		
					<a href="" class="deleteImage icon icon-remove11" data-id="{{$photo->id}}" data-proprieteId="{{$photo->building_id}}" data-type="{{$photo->type}}" title="{{trans('form.delete_image')}}">
						<div class="image">

							<img class="thumbnail" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.buildings_dir').$photo->building_id.'/common/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_small'))}}" alt="{{$photo->alt}}">

						</div>
					</a>
				</li>

				@endforeach
			</ul>
		</div>
		@endif
	</div>

	<div class="images_category" data-type="more">
		<h3 aria-level="3" role="heading" class="image_cat_title">{{trans('inscription.photoOther')}}</h3>
		<div class="informations">{{trans('inscription.buildingPhotoMore_intro')}}</div>
		{{Form::open(array('url'=>array('ajax/uploadBuildingImage',Config::get('var.moreBuildingPhotos'),$building->id),'files'=>true,'data-type'=>'more','data-proprieteId'=> $building->id,'data-userId'=>Auth::user()->id))}}
		<div class="mulitplefileuploader">{{trans('form.upload')}}</div>

		{{Form::hidden('preview_image','',array('id'=>'preview_image'))}}

		{{Form::close()}}

		{{Form::open(array('url'=>array('ajax/uploadBuildingImage', Config::get('var.moreBuildingPhotos'), $building->id),'files'=>true,'data-type'=>'more','data-proprieteId'=>$building->id,'data-userId'=>Auth::user()->id,'id'=>'baseForm'))}}
		{{Form::file('file', array('class'=>'baseFile'))}}
		{{Form::submit('envoyer', array('class'=>'baseFile'))}}
		{{Form::close()}}


		@if(isset($photos['more']) && Helpers::isOk( $photos['more']))
		<div class="informations">
			{{trans('inscription.about_image_sort')}}
		</div>
		<div id="images" >
			<ul id="sortable">
				@foreach( $photos['more'] as $photo)

				<li >
					<span class="handle icon icon-move6"></span>		
					<a href="" class="deleteImage icon icon-remove11" data-id="{{$photo->id}}" data-proprieteId="{{$photo->building_id}}" data-type="{{$photo->type}}" title="{{trans('form.delete_image')}}">
						<div class="image">

							<img class="thumbnail" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.buildings_dir').$photo->building_id.'/more/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_small'))}}" alt="{{$photo->alt}}">

						</div>
					</a>
				</li>

				@endforeach
			</ul>
		</div>
		@endif
	</div>
	

	{{Form::open(array('method'=>'get','route'=>array('index_inscription_adverts', Auth::user()->slug, $building->id),'class'=>'mainType '))}}

	<div class="field previous">

		<a href="{{route(Config::get('var.steps_routes.4'), array(Auth::user()->slug, $building->id))}}" title="{{trans('account.back_previous_step')}}">{{trans('general.back')}}</a>

	</div>
	<div class="field next">

		{{Form::submit(trans('form.next'))}}

	</div>
	{{Form::close()}}
</div>
@stop