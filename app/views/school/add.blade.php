@extends('layout.layout')

@section('container')
<div class="wrapper">
	<div class="addSchool">
		<div class="form-add">
			@include('includes.errors')
			@include('includes.success')
			<div id="sMap">

			</div>
			{{Form::open(array('route'=>'addSchools','class'=>'mainType school-form rules','data-rules'=>json_encode(School::$rules)))}}
			
			<fieldset>

				<div class="field">
					<label for="address">{{trans('form.address')}}</label>
					<input type="text" class="autocomplete" name="address" id="address">	
				</div>
				<div class="field">
					<label for="region">{{trans('form.region').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
					{{Form::select('region',$regions->data,'',array('id'=>'region','class'=>'select autocomplete','data-placeholder'=>trans('form.region'),'data-validator'=>'false','autofocus'))}}
				</div>

				<div class="field">
					<label for="locality">{{trans('form.locality').trans('form.required')}} <span class="icon-required" aria-hidden="true"></span></label>
					{{Form::select('locality',$localities->data,'',array('id'=>'locality','class'=>'select autocomplete','data-placeholder'=>trans('form.locality'),'data-validator'=>'false'))}}
				</div>

				<div class="field">
					<label for="postal">{{trans('form.postal')}}</label>
					<input type="text"  name="postal" id="postal">	
				</div>
				<div class="field">
					<button class="searchMap btn">{{trans('form.search')}}</button>
				</div>

			</fieldset>	
			<div class="field">
				<label for="name">{{trans('form.name')}}</label>
				<input type="text" name="name" id="name">		
			</div>

			<div class="field">
				<label for="shortname">{{trans('form.shortname')}}</label>
				<input type="text" name="shortname" id="shortname">		
			</div>

			<div class="field">
				<label for="web">{{trans('form.web')}}</label>
				<input type="url" data-validator="false" name="web" id="web">		
			</div>
			<div class="field">
				{{Form::submit(trans('form.add'))}}
			</div>
			{{Form::hidden('latlng','', array('id'=>'latlng'))}}
			{{Form::close()}}
		</div>
	</div>	
</div>
@stop