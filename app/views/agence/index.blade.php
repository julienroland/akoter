@extends('agence.layout')

@section('agence')

@if( $agences->count() )

@foreach( $agences as $agence)
<div class="row">
<div class="agence">
	<a class="thumbnail" title="{{trans('agence.show')}}" href="{{route('show_agence', array(Auth::user()->slug, $agence->slug))}}">
		@if(Helpers::isOk($agence->logo))
		<img src="/{{Config::get('var.images_dir')}}{{Config::get('var.agences_dir')}}{{$agence->id}}/{{Config::get('var.logoAgence_dir')}}{{$agence->logo}}" width="{{Config::get('var.agence_logo_width')}}" height="{{Config::get('var.agence_logo_height')}}" alt="{{$agence->name}}" title="{{trans('general.logo_of_agency', array('name'=>$agence->name))}} ">
		@else 

		<img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_logoAgence')}}" width="{{Config::get('var.agence_logo_width')}}" height="{{Config::get('var.agence_logo_height')}}" alt="{{$agence->name}}" title="{{trans('general.logo_of_agency', array('name'=>$agence->name))}}">

		@endif
	</a>
</div>
</div>
@endforeach

@else
<p class="bigInfo">
	{{trans('agence.no_agence')}}
	<a href="{{route('add_agence', Auth::user()->slug )}}"> {{trans('agence.create_agence')}} </a>
</p>
@endif
@stop