@extends('account.layout')

@section('container')

<div class="hero">
	<div class="wrapper">

		<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.infos_general')}}</h2>
		<div class="intro">
			{{trans('inscription.infos_general_intro')}}
		</div>
	</div>
</div>
<div class="formContainer large">

	@include('includes.steps')

	{{Form::open(array('route'=>array('save_inscription_general', Auth::user()->slug, $building->id ),'class'=>'mainType rules','data-rules'=>json_encode(Building::$infos_general_rules)))}}

	@include('includes.errors')

	@include('includes.success')
	
<!-- 	<div class="field charge-form checkbox">
	<input type="checkbox" name="charge" id="charge">
		<label for="charge">
			{{trans('form.charge_included')}}
		</label>

		<label for="chargePrice" style="display:none;">{{trans('form.price_charge')}}</label>
		<input type="number" name="chargePrice" placeholder="{{trans('form.price_charge')}}" id="chargePrice">
		<div class="informations">
			{{trans('inscription.blank_charge_price')}}
		</div>
	</div> -->

	@foreach($options as $option)
	<div class="field">
		<label for="garantee">{{trans('inscription.garantee')}}</label>
		<input type="number" value="{{Helpers::isOk($building->garantee) ? $building->garantee: ( Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input') :'') }}"name="garantee" id="garantee" placeholder="{{trans('inscription.garantee_placeholder')}}">
	</div>
	@endforeach

	@foreach($situations as $situation)

	@if($situation->language_id == 1)
	<?php $situation_fr = $situation->value; ?>
	@endif
	@if($situation->language_id == 2)
	<?php $situation_en = $situation->value; ?>
	@endif
	@if($situation->language_id == 3)
	<?php $situation_nl = $situation->value; ?>
	@endif
	@endforeach

	@foreach($adverts as $advert)

	@if($advert->language_id == 1)
	<?php $advert_fr = $advert->value; ?>
	@endif
	@if($advert->language_id == 2)
	<?php $advert_en = $advert->value; ?>
	@endif
	@if($advert->language_id == 3)
	<?php $advert_nl = $advert->value; ?>
	@endif
	@endforeach

	<div class="tabs">
		<ul>
			<li><a href="#fr-situation">{{trans('general.lang.fr')}}</a></li>
			<li><a href="#nl-situation">{{trans('general.lang.nl')}}</a></li>
			<li><a href="#en-situation">{{trans('general.lang.en')}}</a></li>
		</ul>
		<div id="fr-situation">
			<div class="field">
				<label for="situations[fr]">{{trans('inscription.situations',array('lang'=>trans('general.lang.fr')))}}</label>
				<textarea name="situations[fr]"  placeholder="{{trans('inscription.situations_placeholder')}}" id="situations[fr]">{{Helpers::isOk($situation_fr) ? $situation_fr :''}}</textarea>
				<div class="informations">
					{{trans('inscription.situations_tuto')}}
				</div>
			</div>
		</div>
		<div id="nl-situation">
			<div class="field">
				<label for="situations[nl]">{{trans('inscription.situations',array('lang'=>trans('general.lang.nl')))}}</label>
				<textarea name="situations[nl]" placeholder="{{trans('inscription.situations_placeholder')}}" id="situations[nl]">{{Helpers::isOk($situation_nl) ? $situation_nl :''}}</textarea>
				<div class="informations">
					{{trans('inscription.situations_tuto')}}
				</div>
			</div>
		</div>
		<div id="en-situation">
			<div class="field">
				<label for="situations[en]">{{trans('inscription.situations',array('lang'=>trans('general.lang.en')))}}</label>
				<textarea name="situations[en]"  placeholder="{{trans('inscription.situations_placeholder')}}" id="situations[en]">{{Helpers::isOk($situation_en) ? $situation_en :''}}</textarea>
				<div class="informations">
					{{trans('inscription.situations_tuto')}}
				</div>
			</div>
		</div>
	</div>		
	
	
	<div class="tabs">
		<ul>
			<li><a href="#fr-advert">{{trans('general.lang.fr')}}</a></li>
			<li><a href="#nl-advert">{{trans('general.lang.nl')}}</a></li>
			<li><a href="#en-advert">{{trans('general.lang.en')}}</a></li>
		</ul>
		<div id="fr-advert">
			<div class="field">
				<label for="advert[fr]">{{trans('inscription.write_advert',array('lang'=>trans('general.lang.fr')))}}</label>
				<textarea name="advert[fr]" data-validator="false" id="advert[fr]">{{Helpers::isOk($advert_fr) ? $advert_fr :''}}</textarea>
				<div class="informations">
					{{trans('inscription.write_advert_tuto')}}
				</div>
			</div>
		</div>
		<div id="nl-advert">
			<div class="field">
				<label for="advert[nl]">{{trans('inscription.write_advert',array('lang'=>trans('general.lang.nl')))}}</label>
				<textarea name="advert[nl]" data-validator="false" id="advert[nl]">{{Helpers::isOk($advert_nl) ? $advert_nl :''}}</textarea>
				<div class="informations">
					{{trans('inscription.write_advert_tuto')}}
				</div>
			</div>
		</div>
		<div id="en-advert">
			<div class="field">
				<label for="advert[en]">{{trans('inscription.write_advert',array('lang'=>trans('general.lang.en')))}}</label>
				<textarea name="advert[en]" data-validator="false" id="advert[en]">{{Helpers::isOk($advert_en) ? $advert_en :''}}</textarea>
				<div class="informations">
					{{trans('inscription.write_advert_tuto')}}
				</div>
			</div>
		</div>
	</div>

	<div class="field previous">

		<a href="{{route(Config::get('var.steps_routes.3'), array(Auth::user()->slug, $building->id))}}" title="{{trans('account.back_previous_step')}}">{{trans('general.back')}}</a>

	</div>

	<div class="field next">

		{{Form::submit(trans('form.next'))}}

	</div>
	{{Form::close()}}
</div>
@stop