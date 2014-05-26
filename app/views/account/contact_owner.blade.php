@extends('layout.layout')

@section('container')
<div class="contact">
	<div class="hero">
		<div class="wrapper">

			<h2 aria-level="2" role="heading" class="mainTitle">{{trans('general.contact_owner',array('first_name'=>$user->first_name,'name'=>$user->name))}}</h2>
			<div class="intro">
				{{trans('general.contact_owner_intro')}}
			</div>
		</div>
	</div>
	<div class="contactForm formContainer">
		
		@include('includes.success')
		@include('includes.errors')

		{{Form::open(array('route'=>array('contact_owner', $user->slug, $location->id),'class'=>'mainType rules','data-rules'=>json_encode(array('name'=>'required | alpha', 'email'=>'email | required','text'=>'required'))))}}
		
		<div class="field">

			<label for="name">{{trans('form.name')}} *</label>
			<input type="text" name="name" id="name" required value="{{Session::has('contact_us') ? Session::get('contact_us')['name'] :( Auth::check() ? Auth::user()->name : '')}}" placeholder="{{trans('form.name')}}">
		</div>

		<div class="field">
			
			<label for="email">{{trans('form.email')}} *</label>
			<input type="email" name="email" id="email" required value="{{Session::has('contact_us') ? Session::get('contact_us')['email'] :(Auth::check() ? Auth::user()->email : '')}}" placeholder="{{trans('form.email')}}">
		</div>
		
		<div class="field">
			<label for="text">{{trans('form.message')}} *</label>
			<textarea name="text"  id="text" required placeholder="{{trans('form.message')}}"></textarea>
		</div>
		<div class="form-group">
			<label for="translate">{{trans('form.translate_language')}}</label>
			<input type="checkbox" name="translate" checked id="translate">
		</div>
		<div class="field choice-2">

			{{Form::submit(trans('form.send'))}}
			<a href="{{route('showLocation', Route::current()->parameter('location_id')->translation()->whereId('slug')->pluck('value') )}}">{{trans('form.back')}}</a>
		</div>
		{{Form::close()}}
	</div>

</div>

@stop