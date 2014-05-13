@extends('layout')

@section('container')

<ul>
	<li>{{link_to_route('inscriptionProprietaire','etape1')}}</li>
	<li>{{link_to_route('inscriptionProprietaireAccount','etape2')}}</li>
	<li>{{link_to_route('inscriptionProprietaireImage','etape3')}}</li>
	<li>{{('etape4')}}</li>
	<li>{{('etape5')}}</li>

</ul>
<fieldset>
	<legend>{{('Informations personnels')}}</legend>
	{{Form::open(array('url'=>'inscription/proprietaire/etape5'))}}
	{{Form::submit('Etape 5')}}
	{{Form::close()}}
</fieldset>

@stop