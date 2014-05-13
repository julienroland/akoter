@extends('layouts.scaffold')

@section('main')

<h1>All InformationsPersos</h1>

<p>{{ link_to_route('informationsPersos.create', 'Add new informationsPerso') }}</p>

@if ($informationsPersos->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Votre Nom</th>
				<th>Votre Prenom</th>
				<th>Type De Compte</th>
				<th>Votre Email</th>
			</tr>
		</thead>

		<tbody>
		<?php var_dump($informationspersos); ?>
			@foreach ($informationsPersos as $informationsPerso)
				<tr>
					<td>{{{ $informationsPerso->Votre nom }}}</td>
					<td>{{{ $informationsPerso->Votre prenom }}}</td>
					<td>{{{ $informationsPerso->type de compte }}}</td>
					<td>{{{ $informationsPerso->votre email }}}</td>
                    <td>{{ link_to_route('informationsPersos.edit', 'Edit', array($informationsPerso->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('informationsPersos.destroy', $informationsPerso->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no informationsPersos
@endif

@stop
