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
		<input type="number" name="garantee" id="garantee" placeholder="{{trans('inscription.garantee_placeholder')}}">
	</div>
	@endforeach
	<div class="tabs">
		<ul>
			<li><a href="#fr-situation">{{trans('general.lang.fr')}}</a></li>
			<li><a href="#nl-situation">{{trans('general.lang.nl')}}</a></li>
			<li><a href="#en-situation">{{trans('general.lang.en')}}</a></li>
		</ul>
		<div id="fr-situation">
			<div class="field">
				<label for="situations">{{trans('inscription.situations')}}</label>
				<textarea name="situations" placeholder="{{trans('inscription.situations_placeholder')}}" id="situations"></textarea>
				<div class="informations">
					{{trans('inscription.situations_tuto')}}
				</div>
			</div>
		</div>
		<div id="nl-situation">
			
		</div>
		<div id="en-situation">
			
		</div>
	</div>		
	
	

	<div class="field">
		<label for="advert">{{trans('inscription.write_advert')}}</label>
		<textarea name="advert" data-validator="false" class="editor" id="advert"></textarea>
		<div class="informations">
			{{trans('inscription.write_advert_tuto')}}
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