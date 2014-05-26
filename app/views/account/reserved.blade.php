@extends('layout.layout')

@section('container')
<div class="contact">
	<div class="hero">
		<div class="wrapper">

			<h2 aria-level="2" role="heading" class="mainTitle">{{trans('general.reservation_owner',array('first_name'=>Auth::user()->first_name,'name'=>Auth::user()->name))}}</h2>
			<div class="intro">
				{{trans('general.reservation_owner_intro')}}
			</div>
		</div>
	</div>
	<div class="contactForm formContainer">
		
		@include('includes.success')
		@include('includes.errors')
		<?php User::$reserved_rules['seat'] = 'required|numeric|min:1|max:'.$location->remaining_room ;?>
		<?php User::$reserved_rules['nb_locations'] = 'required|numeric|min:1|max:'.$location->remaining_location ;?>
		{{Form::open(array('route'=>array('reserved_location', Route::current()->parameter('location_slug')->translation()->whereKey('slug')->pluck('value')),'class'=>'mainType rules','data-rules'=>json_encode(User::$reserved_rules)))}}
		
		<div class="field">

			<label for="seat">{{trans('form.nb_seat')}} *</label>
			<input type="number" min="1" max="{{$location->remaining_room}}" name="seat" id="seat" required value="" placeholder="{{trans('form.nb_max',array('number'=>$location->remaining_room))}}">
			<div class="informations">{{trans('form.info_nb_seat')}}</div>
		</div>

		<div class="field">
			
			<label for="nb_locations">{{trans('form.nb_locations')}} *</label>
			<input type="number" min="1" max="{{$location->remaining_location}}" name="nb_locations" id="nb_locations" required value="1" placeholder="{{trans('form.nb_max',array('number'=>$location->remaining_location))}}">
			<div class="informations">{{trans('form.info_nb_location')}}</div>
		</div>
		
		<div class="field">
			<label for="start_date">{{trans('form.change_start_date')}} *</label>
			<input type="text" class="datepicker" name="start_date"  id="start_date" required  value="{{Helpers::dateNaForm($location->start_date)}}"/>
		</div>
		<div class="field">
			<label for="text">{{trans('form.message')}} *</label>
			<textarea  name="text"  id="start_date" required></textarea>
			<div class="informations">{{trans('form.info_message_location')}}</div>
		</div>
		<div class="form-group">
			<label for="translate">{{trans('form.translate_language')}}</label>
			<input type="checkbox" name="translate" checked id="translate">
		</div>
		<div class="field choice-2">

			{{Form::submit(trans('form.send'))}}
			<a href="{{route('showLocation', Route::current()->parameter('location_slug')->translation()->whereKey('slug')->pluck('value') )}}">{{trans('form.back')}}</a>
		</div>
		{{Form::close()}}
	</div>

</div>

@stop