@extends('layout')

@section('container')

@if(isset($userData))
	@foreach($userData as $user)
		<ul>
	<li>{{('Votre nom: ')}}{{$user->nom}}</li>
	<li>{{('Votre prénom: ')}}{{$user->prenom}}</li>
	<li>{{('Type de compte: ')}}{{$user->accountType}}</li>
	<li>{{('Votre email: ')}}{{$user->email}}</li>
</ul> 
	@endforeach
@endif

@stop