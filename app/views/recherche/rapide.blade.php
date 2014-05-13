@extends('layout')

@section('container')

<fieldset>
	<legend>Recherche rapide</legend>
	@if(Session::has('kotFromGoogle'))
	<?php var_dump(Session::get('kotFromGoogle')); ?>
	@endif
	<p>{{'Rapide'}}</p>

	<p>{{link_to_route('showDetaillee','Détaillée')}}</p>

	<p>{{('Localiser : Une école, une ville, un kot')}}</p>

	{{ Form::open(array('url' => 'recherche/rapide/ecole' )) }}

	{{ Form::label('loyer_max','Loyer MAX') }}

	{{ Form::select('loyer_max', array(
		'200',
		'3OO'
		));

	}}

	{{ Form::label('loyer_min','Loyer MIN') }}

	{{ Form::select('loyer_min', array(
		'200',
		'3OO'
		));

	}}

	{{ Form::label('charge','Charges') }}

	{{ Form::select('charge', array(
		'Comprise',
		'fuck off'
		));

	}}

	{{ Form::submit('Chercher') }}

	{{Form::close()}}

	{{ $errors->first('url','<div class="error">:message</div>') }} 


</fieldset>

@stop