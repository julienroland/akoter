@extends('layout.email')

@section('content')


<p>Bonjour , nous sommes content de vous avoir parmis nous !</p>

<p>Voici votre informations de connexion :</p>
<ul>
	<li>Email : {{$user->email}}</li>
	<li>Mot de passe : Vous seul le connaissez !</li>
</ul>


@stop