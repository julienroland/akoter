@extends('layout')

@section('container')
@if(isset($message))
{{$message}}
@endif
{{HTML::link('recherche/rapide/prix','Prix',array('title'=>'Trier en fonction du prix'))}}
{{HTML::link('recherche/rapide/charge_id','Charges',array('title'=>'Trier en fonction des charges'))}}
@if(isset($listeKot))
@if(!empty($listeKot))
@foreach($listeKot as $kot)
<fieldset>
{{HTML::link('annonce/'.$kot->id.'','Voir l\'annonce',array('title'=>'Aller sur l\'annonce'))}}
	{{HTML::image('http://placehold.it/150x150','image présentant le kot')}}
	<p>{{$kot->region}}</p>
	<p>{{('Prix')}} {{$kot->prix}}</p>
	<p>{{$kot->excerpt}}</p>
	
	<img src="http://maps.googleapis.com/maps/api/staticmap?center={{$kot->lat}},{{$kot->lng}}&zoom=13&size=200x200&maptype=roadmap
	&markers=color:blue%7Clabel:S%7C{{$kot->lat}},{{$kot->lng}}&sensor=false" alt="position du logement	">
	<p>{{$kot->adresse}}</p>
</fieldset>
@endforeach
@endif
@endif
@stop