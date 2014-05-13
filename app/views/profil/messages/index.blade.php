@extends('layout')

@section('container')
@if($messages->count())
	@foreach($messages as $message)
	<?php var_dump($message); ?>
	<span>{{$message->nom}}{{(' à écrit')}}</span>
	<span>{{$message->message}}</span>
	@endforeach
@else
<span>{{('Vous n\'avez aucun message.')}}</span>
@endif
@stop