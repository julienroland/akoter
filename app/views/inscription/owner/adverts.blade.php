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

	{{Form::open(array('route'=>array('save_inscription_adverts', Auth::user()->slug, $building->id),'class'=>'mainType'))}}


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
			@else
			<div class="informations">{{trans('inscription.specificAdvert',array('type'=>strtolower($location->typeLocation->translation[0]->value)))}} </div>
			@endif
			
			@if(count($agency) > 0)
			<div class="field">
				<label for="location_{{$location->id}}[agency]">{{trans('inscription.location_of_agency')}}</label>
				{{Form::select('location_'.$location->id.'[agency]', $agency,'', array('data-placeholder'=>trans('inscription.choose_agence'),'class'=>'select'))}}
			</div>
			@else
			<div class="informations">{{trans('inscription.you_have_no_agence')}} <a href="{{route('add_agence', Auth::user()->slug)}}">{{trans('inscription.register_agency_advert')}}</a></div>
			@endif
			<div class="tabs">
				<ul>
					@foreach(Config::get('var.langId') as $lang => $langId)

					<li><a class="{{$lang}}" href="#{{$lang}}-title">{{trans('general.lang')[$lang]}}</a></li>
					@endforeach
				</ul>
				<?php $titleData = $locationsData[$location->id][0]->translations->reverse()->lists('value','language_id'); ?>

				@foreach(Config::get('var.langId') as $lang => $langId)

				<div id="{{$lang}}-title">
					<div class="field">
						<label for="location_{{$location->id}}[title][{{$lang}}]">{{trans('form.titleAdvert',array('lang'=>trans('general.lang')[$lang])).trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
						<input type="text" value="{{isset($titleData[$langId]) ? $titleData[$langId]:( isset(Session::get('adverts')['location_'.$location->id]) ? Session::get('adverts')['location_'.$location->id]['title'][$lang]:'')}}"  name="location_{{$location->id}}[title][{{$lang}}]" id="location_{{$location->id}}[title][{{$lang}}]" placeholder="{{trans('form.titleAdvert',array('lang'=>trans('general.lang')[$lang]))}}">
					</div>
				</div>
				@endforeach
			</div>

			<div class="field">

				<label for="location_{{$location->id}}[price]">{{trans('form.price')}} {{trans('general.perMonth').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
				<div class="input-price">
					<input type="number" min="0" value="{{isset(Session::get('adverts')['location_'.$location->id]) ? Session::get('adverts')['location_'.$location->id]['price'] : (isset($locationsData) ? $locationsData[$location->id][0]->price : '')}}" required name="location_{{$location->id}}[price]" id="location_{{$location->id}}[price]" placeholder="{{trans('form.price')}}">
				</div>
			</div>

			<div class="field">
				<label for="location_{{$location->id}}[size]">{{trans('form.size')}} (m<sup>2</sup>){{trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
				<div class="input-size icon-meter2">
					<input type="number" value="{{isset(Session::get('adverts')['location_'.$location->id]) ? Session::get('adverts')['location_'.$location->id]['size'] : (isset($locationsData) ? $locationsData[$location->id][0]->size : '')}}" min="0" required name="location_{{$location->id}}[size]" id="location_{{$location->id}}[size]" placeholder="{{trans('form.size')}}">
				</div>
			</div>

			<div class="field">
				<label aria-describedby="info_floor" for="location_{{$location->id}}[floor]">{{trans('form.floor').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
				<input type="number" value="{{isset(Session::get('adverts')['location_'.$location->id]) ? Session::get('adverts')['location_'.$location->id]['floor'] : (isset($locationsData) ? $locationsData[$location->id][0]->floor : '')}}"  min="0" name="location_{{$location->id}}[floor]" id="location_{{$location->id}}[floor]" required placeholder="{{trans('form.floor')}}">
				<div id="info_floor" class="informations">{{trans('inscription.floor_help')}}</div>
			</div>

			<div class="field">
				<label aria-describedby="info_room" for="location_{{$location->id}}[room]">{{trans('form.room').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
				<input type="number" value="{{isset(Session::get('adverts')['location_'.$location->id]) ? Session::get('adverts')['location_'.$location->id]['room'] : (isset($locationsData) ? $locationsData[$location->id][0]->nb_room : '')}}" min="0" name="location_{{$location->id}}[room]" id="location_{{$location->id}}[room]" required placeholder="{{trans('form.room')}}">
				<div id="info_room" class="informations">
					{{trans('inscription.room_available_help')}}
				</div>
			</div>

			<fieldset class="field charge-form checkbox">
				<!-- <input type="checkbox" {{isset($locationsData) && $locationsData[$location->id][0]->charge_type == 0 ? 'checked' :(isset(Session::get('adverts')['location_'.$location->id]['charge']) ? 'checked': '')}}  name="location_{{$location->id}}[charge]" id="location_{{$location->id}}[charge]">
				<label for="location_{{$location->id}}[charge]">
					{{trans('form.charge_included')}}
				</label> -->
				<div class="field radio">

					<input type="radio" {{isset(Session::get('adverts')['location_'.$location->id]['charge']) && Session::get('adverts')['location_'.$location->id]['charge'] == 0 ? 'checked': (isset($locationsData) && $locationsData[$location->id][0]->charge_type == 0 ? 'checked':'')}} name="location_{{$location->id}}[charge]" value="0" id="location_{{$location->id}}[charge1]">
					<label for="location_{{$location->id}}[charge1]">
						{{trans('form.charge_included')}}
					</label>


				</div>
				<div class="field radio">
					<input type="radio" {{isset(Session::get('adverts')['location_'.$location->id]['charge']) && Session::get('adverts')['location_'.$location->id]['charge'] == 1 ? 'checked': (isset($locationsData) && $locationsData[$location->id][0]->charge_type == 1 ? 'checked':'')}} name="location_{{$location->id}}[charge]" value="1" id="location_{{$location->id}}[charge2]">
					<label for="location_{{$location->id}}[charge2]">
						{{trans('form.charge_inclusive')}}
					</label>
					
				</div>
				<div class="field radio">
					<input type="radio" {{isset(Session::get('adverts')['location_'.$location->id]['charge']) && Session::get('adverts')['location_'.$location->id]['charge'] == 2 ? 'checked': (isset($locationsData) && $locationsData[$location->id][0]->charge_type == 2 ? 'checked':'')}} name="location_{{$location->id}}[charge]" value="2" id="location_{{$location->id}}[charge3]">
					<label for="location_{{$location->id}}[charge3]">
						{{trans('form.charge_consumption')}}
					</label>


				</div>
				
				<label aria-describedby="info_charge" for="location_{{$location->id}}[chargePrice]">{{trans('form.price_charge')}}</label>
				<input type="number" class="tooltip-ui-e" value="{{isset(Session::get('adverts')['location_'.$location->id]) ? Session::get('adverts')['location_'.$location->id]['chargePrice'] : (isset($locationsData) ? $locationsData[$location->id][0]->charge_price : '')}}"  min="0" name="location_{{$location->id}}[chargePrice]" title="{{trans('form.price_charge')}} / {{trans('general.perMonth')}}" placeholder="{{trans('form.price_charge')}} / {{trans('general.perMonth')}}" id="location_{{$location->id}}[chargePrice]">
				<div id="info_charge" class="informations">
					{{trans('inscription.blank_charge_price')}}
				</div>


			</fieldset> 
			<div class="field">
				<label for="location_{{$location->id}}[garantee]">{{trans('inscription.garantee').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
				<input type="number" value="{{isset(Session::get('adverts')['location_'.$location->id]) ? Session::get('adverts')['location_'.$location->id]['garantee'] : (isset($locationsData) ? $locationsData[$location->id][0]->garantee : '')}}" name="location_{{$location->id}}[garantee]" id="location_{{$location->id}}[garantee]" placeholder="{{trans('inscription.garantee_placeholder')}}">
			</div>
			<div class="field checkbox" {{isset(Session::get('adverts')['location_'.$location->id]['available']) ? 'checked' : (isset($locationsData) && $locationsData[$location->id][0]->available == 1 ? 'checked' : '')}}  name="location_{{$location->id}}[available]" id="location_{{$location->id}}[available]">
				<label for="location_{{$location->id}}[available]">{{trans('form.isAvailableLocation')}}</label>

			</div>

			<div class="group date">
				<div class="field">
					<label for="location_{{$location->id}}[start_date]">{{trans('form.start_date').trans('form.required')}}<span class="icon-required" aria-hidden="true"></span></label>
					<div class="input-date icon-calendar68">
						{{Form::text('location_'.$location->id.'[start_date]',isset(Session::get('adverts')['location_'.$location->id]) ? Session::get('adverts')['location_'.$location->id]['start_date'] : (isset($locationsData) ? $locationsData[$location->id][0]->start_date : '') ,array('class'=>'datepicker','title'=>trans('form.start_date'),'placeholder'=>trans('form.start_date2')))}}
					</div>
				</div>
				<div class="field">
					<label for="location_{{$location->id}}[end_date]">{{trans('form.end_date').trans('form.required')}}<span class="icon-required" aria-hidden="true"></span></label>
					<div class="input-date icon-calendar68">
						{{Form::text('location_'.$location->id.'[end_date]', isset(Session::get('adverts')['location_'.$location->id]) ? Session::get('adverts')['location_'.$location->id]['end_date'] : (isset($locationsData) ? $locationsData[$location->id][0]->end_date : '') ,array('class'=>'datepicker','title'=>trans('form.end_date'),'placeholder'=>trans('form.end_date2')))}}
					</div>
				</div>
			</div>

			<div class="field checkbox">
				<input type="checkbox" {{isset(Session::get('adverts')['location_'.$location->id]['comments']) ? 'checked' : (isset($locationsData) && $locationsData[$location->id][0]->comments_status == 1 ? 'checked' : '')}}  name="location_{{$location->id}}[comments]" id="location_{{$location->id}}[comments]">
				<label for="location_{{$location->id}}[comments]">{{trans('form.allowingComments')}}</label>
				<div class="informations">
					{{trans('inscription.allow_comments_infos')}}
				</div>

			</div>

			<div class="field checkbox">
				<input type="checkbox" {{isset(Session::get('adverts')['location_'.$location->id]['accessible']) ? 'checked' : (isset($locationsData) && $locationsData[$location->id][0]->accessible == 1 ? 'checked' : '')}}  name="location_{{$location->id}}[accessible]" id="location_{{$location->id}}[accessible]">
				<label for="location_{{$location->id}}[accessible]">{{trans('form.accessible')}}</label>
				<div class="informations">
					{{trans('inscription.accessible_infos')}}
				</div>

			</div>
			@if($options->count())
			<div class="group">
				<div class="label">{{trans('form.options')}}:</div>
				<div class="row">

					@foreach($options as $option)
					<div class="field listCheckbox">
						<input type="checkbox" {{isset(Session::get('adverts')['location_'.$location->id]['option'][$option->id]) ? 'checked' :
						(isset($locationsData) && isset($locationsData[$location->id][0]->option[$option->id]) ? 'checked' : '')}}  name="location_{{$location->id}}[option][{{$option->id}}]" id="location_{{$location->id}}[option][{{$option->id}}]">
						@if(isset($option->translation[0]))

						<label for="location_{{$location->id}}[option][{{$option->id}}]">{{$option->translation[0]->value}}</label>

						@endif

					</div>

					@endforeach
				</div>
			</div>
			@endif

			@if($particularities->count())
			<div class="group">
				<div class="label">{{trans('form.particularities')}}:</div>
				<div class="row">

					@foreach($particularities as $particularity)

					<div class="field listCheckbox">
						<input type="checkbox" {{isset($locationsData) && isset($locationsData[$location->id][0]->particularity[$particularity->id]) ? 'checked' :(isset(Session::get('adverts')['location_'.$location->id]['particularity'][$particularity->id]) ? 'checked' : '')}}  name="location_{{$location->id}}[particularity][{{$particularity->id}}]" id="location_{{$location->id}}[particularity][{{$particularity->id}}]">
						@if(isset($particularity->translation[0]))

						<label for="location_{{$location->id}}[particularity][{{$particularity->id}}]">{{$particularity->translation[0]->value}}</label>

						@endif

					</div>

					@endforeach
				</div>
			</div>
			@endif
			<div class="tabs">
				<ul>
					@foreach(Config::get('var.langId') as $lang => $langId)

					<li><a class="{{$lang}}" href="#{{$lang}}-advert">{{trans('general.lang')[$lang]}}</a></li>
					@endforeach
				</ul>
				<?php $advertData = $locationsData[$location->id][0]->translations->lists('value','language_id'); ?>
				@foreach(Config::get('var.langId') as $lang => $langId)

				<div id="{{$lang}}-advert">
					<div class="field">
						<label for="location_{{$location->id}}[advert][{{$lang}}]">{{trans('inscription.advert_in',array('lang'=>trans('general.lang')[$lang])).trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
						<textarea name="location_{{$location->id}}[advert][{{$lang}}]" id="location_{{$location->id}}[advert][{{$lang}}]" class="editor">{{isset($advertData[$langId]) ? $advertData[$langId] :( isset(Session::get('adverts')['location_'.$location->id]['advert']) ? Session::get('adverts')['location_'.$location->id]['advert'][$lang]:'')}}</textarea>
					</div>
				</div>
				@endforeach
			</div>
			
		</div>
		@endforeach
		<div class="field previous">
			<a href="{{route('account_home', Auth::user()->slug)}}" title="{{trans('account.back_home')}}">{{trans('general.back')}}</a>
		</div>
		<div class="field next">
			{{Form::submit(trans('form.next'))}}
		</div>
		{{Form::close()}}
	</div>
	@stop