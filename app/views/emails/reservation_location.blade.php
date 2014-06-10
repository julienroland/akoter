@extends('layout.email')

@section('content')

{{App::setLocale(Config::get('var.lang')[$user->language_id])}}

<h1 aria-level="1" role="heading">Akoter</h1>
<p>Bonjour {{$user->first_name}} {{$user->name}}, vous avez reçus une demande de réservation pour votre location <a href="{{route('showLocation', $location->translation()->whereKey('slug')->pluck('value'))}}" title="Aller sur l'annonce">n°: {{$location->id}} ayant comme titre: {{$location->translation()->whereKey('title')->pluck('value')}}</a> </p>
<p>Informations de coordonnées :</p>
<p>Nom de la personne: {{$sender->first_name}} {{$sender->name}}</p>
<p>Email de la personne: {{$sender->email}}</p>
<p>Age: {{Helpers::beTime(Helpers::createCarbonDate($sender->born),'$nd $M $y', 'true')}}</p>	
<p>Civilité: {{trans('general.civility')[$sender->civility]}}</p>
<br>
<p>Informations concernant la demande:</p>
<p>Nombre de place: {{$input['seat']}}</p>
<p>Nombre de logements: {{$input['nb_locations']}}</p>
<p>Date d'arrivé: {{Helpers::beTime(Helpers::createCarbonDate(Helpers::dateNaForm($input['start_date'])),'$d $nd $M $y' )}} {{$input['start_date'] == $location->start_date ? '(date d\'arrivé non changée)' :'(Le client vous demande si c\'est possible d\'arriver à cette date, n\'oubliez pas de lui répondre)'}}</p>
<p>Message lié à la demande:</p>
<p>
	{{$input['text']}}
</p>
<br>

<a href="{{route('seeOwnerRequest',$user->slug)}}">Voir la demande sur votre compte Akoter</a>
@stop