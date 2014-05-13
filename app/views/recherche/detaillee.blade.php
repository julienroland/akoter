@extends('layout')

@section('container')

<fieldset>
	<legend>{{('Recherche détaillée')}}</legend>

	<p>{{link_to_route('showRapide','Rapide')}}</p>

	<p>{{'Détaillée'}}</p>

	<p>{{('Localiser : Une école, une ville, un kot')}}</p>

	{{ Form::open(array('detaillee' => 'recherche/detaillee' )) }}

	<fieldset>
	<legend>{{('Base')}}</legend>
	{{ Form::label('loyer_max','Loyer MAX') }}

	{{ Form::select('loyer_max', array(
		'200',
		'3OO'
		));

	}}
	</fieldset>

		<fieldset>
	<legend>{{('Supplémentaire')}}</legend>
	{{ Form::label('loyer_max','Loyer MAX') }}

	{{ Form::select('loyer_max', array(
		'200',
		'3OO'
		));

	}}
	</fieldset>

		<fieldset>
	<legend>{{('Bâtiment')}}</legend>
	{{ Form::label('loyer_max','Loyer MAX') }}

	{{ Form::select('loyer_max', array(
		'200',
		'3OO'
		));

	}}
	</fieldset>

		<fieldset>
	<legend>{{{('Carte')}}}</legend>
	{{ Form::label('loyer_max','Loyer MAX') }}

	{{ Form::select('loyer_max', array(
		'200',
		'3OO'
		));

	}}
	</fieldset>

	{{ Form::submit('Chercher') }}

	{{Form::close()}}

	{{ $errors->first('url','<div class="error">:message</div>') }} 


</fieldset>

@stop