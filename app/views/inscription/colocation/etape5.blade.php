@extends('layout')

@section('container')

<ul>
	<li>{{link_to_route('inscriptionColocation','etape1')}}</li>
	<li>{{link_to_route('inscriptionColocationAccount','etape2')}}</li>
	<li>{{link_to_route('inscriptionColocationImage','etape3')}}</li>
	<li>{{link_to_route('inscriptionColocationBatiment','etape4')}}</li>
	<li>{{('etape5')}}</li>
</ul>
<fieldset>
	<legend>{{('Informations personnels')}}</legend>
	{{Form::open(array('url'=>'inscription/colocation/annonce'))}}
	{{Form::submit('Aperçus de l\'annonce')}}
	{{Form::close()}}
</fieldset>

@stop