@extends('account.layout')

@section('container')
<div class="hero">
	<div class="wrapper">

		<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.type_location')}}</h2>
		<div class="intro large">
			{{trans('inscription.type_location_intro')}}
		</div>
	</div>
</div>
<div class="formContainer large">

	@include('includes.steps')

	{{Form::open(array('route'=>array('save_types_locations',Auth::user()->slug, $building->id),'class'=>'mainType'))}}

	@include('includes.errors')
	@include('includes.success')

	<div class="informations">
		{{trans('inscription.types_data_present')}}
	</div>

	<div class="field type_location col">
		<div class="th-1" title="Quel type de logement disposez-vous ? Choissisez aucune pour ne pas en définir"> {{trans('inscription.type_location')}}</div>
		<div class="th-2" title="Définissez le nombre de logement de ce type que contient votre bien"> {{trans('inscription.number_location')}}</div>
		<div class="th-3" title="Chaque annonce aura sa propre annonce"> {{trans('inscription.spe_advert')}}</div>
	</div>

	@for($i = 1; $i < count($typeLocation); $i++ )

	<div class="field type_location col">
		{{Form::select('type_location['.$i.']',$typeLocation,
		$typesLocations[$i]['id'],array('class'=>'select'))}}

		<input type="number" class="number" placeholder="{{trans('form.numberLocations')}}" value="{{$typesLocations[$i]['number']}}" name="number[{{$i}}]">
		<input type="checkbox" class="yesornot" {{$typesLocations[$i]['advert'] == 1 ? 'checked' : '' }} id="global" name="global[{{$i}}]" class="global" id="">
		<label for="global"><span class="ui" data-yes="{{trans('general.yes')}}" data-not="{{trans('general.no')}}"></span></label>
	</div>

	@endfor
	<div class="field previous">
		<a href="{{route(Config::get('var.steps_routes.1'), array(Auth::user()->slug, $building->id))}}" title="{{trans('account.back_previous_step')}}">{{trans('general.back')}}</a>
	</div>

	<div class="field next">
		{{Form::submit(trans('form.next'))}}
	</div>

	{{Form::close()}}
</div>
@stop