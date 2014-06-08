@extends('agence.layout')

@section('agence')

@if( $agences->count() )
<div class="row">
	@foreach( $agences as $agence)


	<div class="agence">
		<a class="thumbnail" title="{{trans('agence.show')}}" href="{{route('show_agence', array(Auth::user()->slug, $agence->slug))}}">
			@if(Helpers::isOk($agence->logo))
			<img src="/{{Config::get('var.images_dir')}}{{Config::get('var.agences_dir')}}{{$agence->id}}/{{Config::get('var.logoAgence_dir')}}{{$agence->logo}}" width="{{Config::get('var.agence_logo_width')}}" height="{{Config::get('var.agence_logo_height')}}" alt="{{$agence->name}}" title="{{trans('general.logo_of_agency', array('name'=>$agence->name))}} ">
			@else 

			<img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_logoAgence')}}" width="{{Config::get('var.agence_logo_width')}}" height="{{Config::get('var.agence_logo_height')}}" alt="{{$agence->name}}" title="{{trans('general.logo_of_agency', array('name'=>$agence->name))}}">

			@endif
		</a>
	</div>

	@endforeach
</div>
@else

<div class="bigInfo">
	<span class="main-title">
		{{trans('agence.no_agence')}}
	</span>
	<div class="links">

		<a href="{{route('add_agence', Auth::user()->slug )}}"> {{trans('agence.create_agence')}} </a>

		<a href="{{route('join_agence', Auth::user()->slug )}}"> {{trans('agence.join_agence')}} </a>

	</div>
</div>

@endif
@stop