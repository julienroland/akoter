@extends('layout')

@section('container')
<fieldset>
	<legend>{{('Profil de '.Session::get('user')['prenom'].' '.Session::get('user')['nom'])}}</legend>
	<span>{{HTML::linkRoute('profil.informations.index','Mes informations personnel',Session::get('user')['id'])}}</span>
	@if(Session::get('user')['accountType'] ==='locataire')

		<span>{{link_to_route('rechercheEnregistreProfil','Voir mes recherches enregistrées')}}</span>
		<span>{{link_to_route('showKotProfil','Voir mon kot')}}</span>
		<span>{{link_to_route('profil.messages.index','Voir mes messages',Session::get('user')['id'])}}</span>
	@endif
	
	{{Session::get('user')['nom']}}
</fieldset>
@stop