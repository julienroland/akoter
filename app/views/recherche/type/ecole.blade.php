@extends('layout')

@section('container')
@if(isset($message))
{{$message}}
@endif
@if(isset($listeKot))
	@if(!empty($listeKot))
		@foreach($listeKot as $kot)
		<fieldset>
		<a href="{{route('showAnnonce')}}"><img src="http://placehold.it/150x150" alt=""></a>
		<p>{{link_to_route('showAnnonce',$kot->region)}}</p>
		<p>{{$kot->prix}}</p>
		<p>{{$kot->disponible}}</p>
		</fieldset>
		@endforeach
	@endif
@endif
@stop