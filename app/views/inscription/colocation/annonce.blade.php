@extends('layout')

@section('container')

<ul>
	<li>{{link_to_route('inscriptionColocation','etape1')}}</li>
	<li>{{link_to_route('inscriptionColocationAccount','etape2')}}</li>
	<li>{{link_to_route('inscriptionColocationImage','etape3')}}</li>
	<li>{{link_to_route('inscriptionColocationBatiment','etape4')}}</li>
	<li>{{link_to_route('inscriptionColocationAutre','etape5')}}</li>
</ul>
<fieldset>
	<legend>{{('Informations personnels')}}</legend>
	{{Form::open(array('url'=>'inscription/colocation/comfirmer'))}}
	{{Form::submit('Valider l\'annonce')}}
	{{('Ne pas valider l\'annonce')}}
	{{Form::close()}}
</fieldset>

@stop