@extends('account.layout')

@section('container')
<div class="hero">
	<div class="wrapper">

		<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.advert')}}</h2>
		<div class="intro">
			{{trans('inscription.advert_intro')}}
		</div>
	</div>
</div>
<div class="formContainer large">
	
	@include('includes.steps')

	{{Form::open(array('route'=>array('save_localisation_building', Auth::user()->slug),'class'=>'mainType rules','data-rules'=>json_encode(Building::$inscription_rules)))}}


	<div class="requiredField"><span class="icon-required" aria-hidden="true"></span>{{trans('form.required_field')}}</div>

	@include('includes.errors')

	@include('includes.success')

	<div class="tabs">
		<ul>
			@foreach($locations as $location)
			
			<li><a href="#{{$location->id}}-advert">{{$location->typeLocation->translation[0]->value}} {{$location->id}}</a></li>
			@endforeach
		</ul>

		@foreach($locations as $location)
		<div id="{{$location->id}}-advert">
			
			@if($location->nb_locations > 1)
			<div class="informations">{{trans('inscription.groupAdvert',array('number'=>$location->nb_locations,'type'=>strtolower($location->typeLocation->translation[0]->value)))}} </div>
			@endif
			<div class="field">
				<label for="{{$location->id}}[title]">{{trans('form.titleAdvert')}}</label>
				<input type="text" name="{{$location->id}}[title]" id="{{$location->id}}[title]" placeholder="{{trans('form.titleAdvert')}}">
			</div>

			<div class="field">
				<label for="{{$location->id}}[price]">{{trans('form.price')}} / {{trans('general.perMonth')}}</label>
				<div class="input-price">
					<input type="number" name="{{$location->id}}[price]" id="{{$location->id}}[price]" placeholder="{{trans('form.price')}}">
				</div>
			</div>

			<div class="field">
				<label for="{{$location->id}}[size]">{{trans('form.size')}} (m<sup>2</sup>)</label>
				<div class="input-size icon-meter2">
					<input type="number" name="{{$location->id}}[size]" id="{{$location->id}}[size]" placeholder="{{trans('form.size')}}">
				</div>
			</div>

			<div class="field">
				<label for="{{$location->id}}[floor]">{{trans('form.floor')}} </label>
				<input type="number" name="{{$location->id}}[floor]" id="{{$location->id}}[floor]" placeholder="{{trans('form.floor')}}">
			</div>

			<div class="field">
				<label for="{{$location->id}}[room]">{{trans('form.room')}} </label>
				<input type="number" name="{{$location->id}}[room]" id="{{$location->id}}[room]" value="{{$location->type_location_id == 1 ? '1' :''}}" placeholder="{{trans('form.room')}}">
			</div>

			<div class="field charge-form checkbox">
				<input type="checkbox" name="{{$location->id}}[charge]" id="{{$location->id}}[charge]">
				<label for="{{$location->id}}[charge]">
					{{trans('form.charge_included')}}
				</label>

				<label for="{{$location->id}}[chargePrice]" style="display:none;">{{trans('form.price_charge')}}</label>
				<input type="number" name="{{$location->id}}[chargePrice]" placeholder="{{trans('form.price_charge')}}" id="{{$location->id}}[chargePrice]">
				<div class="informations">
					{{trans('inscription.blank_charge_price')}}
				</div>


			</div> 
			<div class="field checkbox">
				<input type="checkbox" name="{{$location->id}}[available]" id="{{$location->id}}[available]">
				<label for="{{$location->id}}[available]">{{trans('form.isAvailable')}}</label>
				
			</div>
			<div class="group date">
				<div class="field">
					{{Form::label($location->id.'[start_date]', trans('form.start_date'),array('aria-hidden'=>'false'))}}
					<div class="input-date icon-calendar68">
						{{Form::text($location->id.'[start_date]','' ,array('class'=>'datepicker','title'=>trans('form.start_date'),'placeholder'=>trans('form.start_date2')))}}
					</div>
				</div>
				<div class="field">
					{{Form::label($location->id.'[end_date]', trans('form.end_date'),array('aria-hidden'=>'false'))}}
					<div class="input-date icon-calendar68">
						{{Form::text($location->id.'[end_date]', '',array('class'=>'datepicker','title'=>trans('form.end_date'),'placeholder'=>trans('form.end_date2')))}}
					</div>
				</div>
			</div>

			<div class="field checkbox">
				<input type="checkbox" name="{{$location->id}}[comments]" id="{{$location->id}}[comments]">
				<label for="{{$location->id}}[comments]">{{trans('form.allowingComments')}}</label>
				
			</div>

			<div class="field">
			<label for="{{$location->id}}[advert]">{{trans('inscription.advert')}}</label>
				<textarea name="{{$location->id}}[advert]" id="{{$location->id}}[advert]" class="editor"></textarea>
			</div>
		</div>
		@endforeach
	</div>

	<div class="field previous">
		<a href="{{route('account_home', Auth::user()->slug)}}" title="{{trans('account.back_home')}}">{{trans('general.back')}}</a>
	</div>
	<div class="field next">
		{{Form::submit(trans('form.next'))}}
	</div>
	{{Form::hidden('latlng', isset($building->latlng) ? $building->latlng : (Session::has('inscription.localisation_input') ? Session::get('inscription.localisation_input')['latlng'] : ''), array('id'=>'latlng'))}}
	{{Form::close()}}
</div>
@stop