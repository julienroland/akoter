@extends('layout')

@section('container')

<ul>
	<li>{{('etape1')}}</li>
	<li>{{('etape1')}}</li>
	<li>{{('etape1')}}</li>
	<li>{{('etape1')}}</li>
	<li>{{('etape1')}}</li>
</ul>
<fieldset>
	<legend>{{('Informations personnels')}}</legend>
	{{Form::open(array('url'=>'inscription/proprietaire/etape1'))}}
	{{Form::submit('Etape 2')}}
	{{Form::close()}}
</fieldset>

@stop