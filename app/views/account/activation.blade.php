@extends('layout.layout')

@section('container')
<div class="wrapper">
	<div class="validation-email">
		@if($validation)
		@if(isset($user))
		<p>{{trans('general.ty')}} {{$user->first_name .' ' . $user->name}},</p> 
		<p>{{trans('validation.custom.valid')}}</p>


		@else
		<p>{{trans('validation.custom.valid')}}</p>
		@endif
		@else
		@if(isset($message))
		<p>{{$message}}</p>
		@else
		<p>{{trans('validation.custom.invalid')}}</p>
		@endif
		@endif
		{{link_to('/',trans('general.home'))}}
	</div>
</div>	
@stop