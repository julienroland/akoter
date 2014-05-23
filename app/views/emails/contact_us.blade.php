@extends('layout.email')

@section('content')

<h1 aria-level="1" role="heading">Akoter</h1>
<p>Bonjour {{$input['name']}}, nous avons bien reçus votre email, nous reviendrons vers vous à cette adresse: {{$input['email']}} le plus rapidement possible !</p>

<p>Voici le message envoyé</p>
<p>
	{{$input['text']}}
</p>

@stop