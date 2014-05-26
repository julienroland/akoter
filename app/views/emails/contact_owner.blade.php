@extends('layout.email')

@section('content')
{{App::setLocale(Config::get('var.lang')[$user->language_id])}}
<h1 aria-level="1" role="heading">Akoter</h1>
<p>Bonjour {{$user->first_name}} {{$user->name}}, veuillez retrouver ci-dessous un message provenant de votre logement <a href="{{route('showLocation', $slug)}}" title="Aller sur l'annonce">n°: {{$location->id}}</a> </p>
<p>Nom de la personne: {{$input['name']}}</p>
<p>Email de la personne: {{$input['email']}}</p>
<p>Voici le message envoyé</p>
<p>
	{{$input['text']}}
</p>

@stop