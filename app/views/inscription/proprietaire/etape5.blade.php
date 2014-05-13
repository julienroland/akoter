@extends('layout')

@section('container')

<ul>
	<li>{{link_to_route('inscriptionProprietaire','etape1')}}</li>
	<li>{{link_to_route('inscriptionProprietaireAccount','etape2')}}</li>
	<li>{{link_to_route('inscriptionProprietaireImage','etape3')}}</li>
	<li>{{link_to_route('inscriptionProprietaireBatiment','etape4')}}</li>
	<li>{{('etape5')}}</li>
</ul>
<fieldset>
	<legend>{{('Informations personnels')}}</legend>
	{{Form::open(array('url'=>'inscription/proprietaire/annonce'))}}
	{{Form::submit('Aperçus de l\'annonce')}}
	{{Form::close()}}
</fieldset>

@stop