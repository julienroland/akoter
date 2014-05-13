@extends('layout')

@section('container')
@if($kot->count())

@foreach($kot as $monKot)
	<p>{{('Le numéro de votre chambre est le n°: ').$monKot->numero}}</p>
	<p>{{('L\'adresse du logement est: ').$monKot->adresse}}</p>
	<p>{{('Il se trouve dans la région de ').ucWords($monKot->region)}}</p>
	<p>{{('le code postal est le n°: ').$monKot->postal}}</p>
	<img src="http://maps.googleapis.com/maps/api/staticmap?center={{$monKot->lat}},{{$monKot->lng}}&zoom=13&size=200x200&maptype=roadmap
	&markers=color:blue%7Clabel:S%7C{{$monKot->lat}},{{$monKot->lng}}&sensor=false" alt="position du logement	">
	<p>{{('Le prix du logement s\'élève à ').$monKot->prix.('€')}}</p>
	
@endforeach
@else
<div class="informations">
<span>{{('Vous n\'êtes locataire d\'aucun kot !')}}</span>
</div>
@endif
@stop