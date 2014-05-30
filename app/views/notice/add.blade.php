@extends('layout.layout')

@section('container')

<div class="notice-form">
	<div class="hero">
		<div class="wrapper">

			<h2 aria-level="2" role="heading" class="mainTitle">{{trans('notices.add_title')}}</h2>
			<div class="intro">
				{{trans('notices.add_intro')}}
			</div>
		</div>
	</div>
	<div class="wrapper formContainer">

		@include('includes.success')
		@include('includes.errors')

		{{Form::open(array('route'=>array('add_notice', Auth::user()->slug),'class'=>'mainType rules','data-rules'=>json_encode(Notice::$rules)))}}

		<div class="field">
			<label for="notice">{{trans('notices.write_notice')}}</label>
			<textarea name="notice" id="notice"></textarea>
		</div>
		<div class="field">
			{{Form::submit(trans('form.add'))}}
		</div>

		{{Form::close()}}

	</div>
</div>

@stop