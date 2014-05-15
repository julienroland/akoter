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
<div class="formContainer">

	@if(Session::has('inscription.building_id'))

	{{Form::open(array('route'=>array('update_localisation_building', Auth::user()->slug),'method'=>'put','class'=>'mainType rules','data-rules'=>json_encode(Building::$inscription_rules)))}}

	@else

	{{Form::open(array('route'=>array('save_localisation_building', Auth::user()->slug),'class'=>'mainType rules','data-rules'=>json_encode(Building::$inscription_rules)))}}

	@endif

	@include('includes.errors')

	<div class="requiredField"><span class="icon-required" aria-hidden="true"></span> Champs obligatoire</div>
	<div class="field">
		<label for="region">{{trans('form.region')}} <span class="icon-required" aria-hidden="true"></span></label>
		{{Form::select('region',$regions->data,Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['region'] : '',array('class'=>'select autocomplete','data-placeholder'=>trans('form.region'),'data-validator'=>'false','autofocus'))}}
	</div>

	<div class="field">
		<label for="locality">{{trans('form.Locality')}} <span class="icon-required" aria-hidden="true"></span></label>
		{{Form::select('locality',$localities->data, Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['locality'] : '',array('class'=>'select autocomplete','data-placeholder'=>trans('form.locality'),'data-validator'=>'false'))}}
	</div>

	<div class="field">
		<label for="address">{{trans('form.street')}} <span class="icon-required" aria-hidden="true"></span></label>
		<input type="text" name="address" class="autocomplete" required id="address" value="{{Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['address'] : ''}}" placeholder="{{trans('form.street')}}">
	</div>

	<div class="field">
		<label for="postal">{{trans('form.postal')}} <span class="icon-required" aria-hidden="true"></span></label>
		<input type="number" name="postal" required id="postal" value="{{Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['postal'] : ''}}" placeholder="{{trans('form.postal')}}">
	</div>

	<div class="field">
		<label for="number">{{trans('form.number')}} <span class="icon-required" aria-hidden="true"></span></label>
		<input type="number" name="number" required id="number" value="{{Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['number'] : ''}}" placeholder="{{trans('form.number')}}">
	</div>

	<a href="javascript:void(0)" class="btn" id="rechercheMap">{{trans('inscription.locate_map_btn')}}</a>

	<div class="localisation_map">
		<div class="informations">
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
		<div id="gmapLocalisation">
			
		</div>
		
	</div>

	<div class="field">
		{{Form::submit(trans('form.next'))}}
	</div>
	{{Form::hidden('latlng', Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['latlng'] : '', array('id'=>'latlng'))}}
	{{Form::close()}}
</div>
@stop