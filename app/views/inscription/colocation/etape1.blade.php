@extends('layout')

@section('container')

<ul>
	<li>{{('etape1')}}</li>
	<li>{{('etape2')}}</li>
	<li>{{('etape3')}}</li>
	<li>{{('etape4')}}</li>
	<li>{{('etape5')}}</li>
</ul>
<fieldset>
	<legend>{{('Informations personnels')}}</legend>
	{{Form::open(array('url'=>'inscription/colocation/etape2'))}}
	{{Form::submit('Etape 2')}}
	{{Form::close()}}
</fieldset>

@stop