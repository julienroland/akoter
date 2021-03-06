@extends('account.layout')

@section('container')
<div class="hero">
	<div class="wrapper">

		<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.localisation')}}</h2>
		<div class="intro">
			{{trans('inscription.localisation_intro')}}
		</div>
	</div>
</div>
<div class="formContainer large">
	
	@include('includes.steps')
	

	<div class="requiredField"><span class="icon-required" aria-hidden="true"></span>{{trans('form.required_field')}}</div>


	@if($buildings->count() > 1)

	@if( !isset($building) || Helpers::isNotOk($building) )

	{{Form::open(array('route'=>array('save_localisation_building', Auth::user()->slug, Helpers::isOk($currentLocation) ? $currentLocation->id:''),'class'=>'mainType'))}}

	<div class="informations">{{trans('inscription.reuse_building')}}</div>
	<fieldset>
		<div class="field">

			<label for="building">{{trans('inscription.building_created')}}</label>
			{{Form::select('building', $buildings,'',array('data-placeholder'=>trans('inscription.choose_building'),'class'=>'select'))}}
		</div>

		<div class="typeLocation-building">

			<div class="field type_location col">
				<div class="th-1 tooltip-ui-s" title="{{trans('inscription.type_location1')}}"> {{trans('inscription.type_location')}}</div>
				<div class="th-2 tooltip-ui-s" title="{{trans('inscription.type_location2')}}"> {{trans('inscription.number_location')}}</div>
				<div class="th-3 tooltip-ui-s" title="{{trans('inscription.type_location3')}}"> {{trans('inscription.spe_advert')}}</div>
			</div>

			@for($i = 1; $i < count($typeLocation); $i++ )

			<div class="field type_location col">
				{{Form::select('type_location['.$i.']',$typeLocation,
				'',array('class'=>'select','title'=>trans('inscription.type_location')))}}

				<input type="number_location" min="0" class="number" title="{{trans('inscription.number_location')}}" placeholder="{{trans('form.numberLocations')}}" value="" name="number_location[{{$i}}]">
				<input type="checkbox" class="yesornot"  id="global" name="global[{{$i}}]" class="global" id="">
				<label for="global"><span class="ui" data-yes="{{trans('general.yes')}}" data-not="{{trans('general.no')}}"></span><span class="section">{{trans('inscription.spe_advert')}}</span></label>
			</div>

			@endfor
		</div>
	</fieldset>
	{{Form::submit(trans('form.next'))}}
	{{Form::close()}}
	<span class="or">{{strtolower(trans('connections.or'))}}</span>

	@endif
	@endif
	
	@if( isset($building) && Helpers::isOk($building) )

	{{Form::open(array('route'=>array('update_localisation_building', Auth::user()->slug, $building->id, Helpers::isOK($currentLocation) ? $currentLocation->id : '') ,'method'=>'put','class'=>'mainType rules','data-rules'=>json_encode(Building::$inscription_rules)))}}

	@else

	{{Form::open(array('route'=>array('save_localisation_building', Auth::user()->slug, Helpers::isOk($currentLocation) ? $currentLocation->id:''),'class'=>'mainType rules','data-rules'=>json_encode(Building::$inscription_rules)))}}

	@endif
	
	@include('includes.errors')

	@include('includes.success')
	<div id="part2">
		<div class="field">
			<label for="region">{{trans('form.region').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
			{{Form::select('region',$regions->data,isset($building->region_id) ? $building->region_id : (Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['region'] : ''),array('class'=>'select autocomplete','data-placeholder'=>trans('form.region'),'data-validator'=>'false','autofocus'))}}
		</div>

		<div class="field">
			<label for="locality">{{trans('form.locality').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
			{{Form::select('locality',$localities->data, isset($building->locality_id) ? $building->locality_id : (Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['locality'] : ''),array('class'=>'select autocomplete','data-placeholder'=>trans('form.locality'),'data-validator'=>'false'))}}
		</div>

		<div class="field">
			<label for="address">{{trans('form.street').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
			<input type="text" name="address" class="autocomplete" required id="address" value="{{isset($building->address) ? $building->address : (Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['address'] : '')}}" placeholder="{{trans('form.street')}}">
		</div>

		<div class="field">
			<label for="postal">{{trans('form.postal').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
			<input type="number" name="postal" required id="postal" value="{{isset($building->postal) ? $building->postal : (Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['postal'] : '')}}" placeholder="{{trans('form.postal')}}">
		</div>

		<div class="field">
			<label for="number">{{trans('form.number').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
			<input type="number" name="number" required id="number" value="{{isset($building->number) ? $building->number : (Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['number'] : '')}}" placeholder="{{trans('form.number')}}">
		</div>


		<div class="localisation_map">
			<div class="informations" id="info_map">
				<ol>
					<li>
						{{trans('inscription.locate_map_infos.1')}}
					</li>
					<li>
						{{trans('inscription.locate_map_infos.2')}}
					</li>
					<li>
						{{trans('inscription.locate_map_infos.3')}}
					</li>
				</ol>
			</div>
			<a href="javascript:void(0)" aria-describedny="info_map" class="btn" role="button" id="rechercheMap">{{trans('inscription.locate_map_btn')}}</a>
			<div id="gmapLocalisation">

			</div>

		</div>
	</div>
	<div class="field previous">
		<a href="{{route('account_home', Auth::user()->slug)}}" role="button" title="{{trans('account.back_home')}}">{{trans('general.back')}}</a>
	</div>
	<div class="field next">
		{{Form::submit(trans('form.next'))}}
	</div>
	{{Form::hidden('latlng', isset($building->latlng) ? $building->latlng : (Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['latlng'] : ''), array('id'=>'latlng'))}}
	{{Form::close()}}
</div>
@stop