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
	

	{{Form::open(array('route'=>array('save_types_locations',Auth::user()->slug, $building->id, Helpers::isOk($currentLocation) ? $currentLocation->id:''),'class'=>'mainType'))}}

	@include('includes.errors')
	
	@include('includes.success')

	<div class="informations">
		{{trans('inscription.types_data_present')}}
	</div>

	<div class="field type_location col">
		<div class="th-1 tooltip-ui-s" title="{{trans('inscription.type_location1')}}"> {{trans('inscription.type_location')}}</div>
		<div class="th-2 tooltip-ui-s" title="{{trans('inscription.type_location2')}}"> {{trans('inscription.number_location')}}</div>
		<div class="th-3 tooltip-ui-s" title="{{trans('inscription.type_location3')}}"> {{trans('inscription.spe_advert')}}</div>
	</div>

	@for($i = 1; $i < count($typeLocation); $i++ )

	<div class="field type_location col">
		{{Form::select('type_location['.$i.']',$typeLocation,
		$typesLocations[$i]['id'],array('class'=>'select','title'=>trans('inscription.type_location')))}}

		<input type="number" min="0" class="number" title="{{trans('inscription.number_location')}}" placeholder="{{trans('form.numberLocations')}}" value="{{$typesLocations[$i]['number']}}" name="number[{{$i}}]">
		<input type="checkbox" class="yesornot" {{$typesLocations[$i]['advert'] == 1 ? 'checked' : '' }} id="global[{{$i}}]" name="global[{{$i}}]" class="global" id="">
		<label for="global[{{$i}}]"><span class="ui" data-yes="{{trans('general.yes')}}" data-not="{{trans('general.no')}}"></span><span class="section">{{trans('inscription.spe_advert')}}</span></label>
	</div>

	@endfor
	<div class="field previous">
		<a role="button" href="{{route(Config::get('var.steps_routes.1'), array(Auth::user()->slug, $building->id))}}" title="{{trans('account.back_previous_step')}}">{{trans('general.back')}}</a>
	</div>

	<div class="field next">
		{{Form::submit(trans('form.next'))}}
	</div>

	{{Form::close()}}
</div>
@stop