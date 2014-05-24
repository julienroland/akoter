@extends('admin.layout.layout')

@section('container')



<div class="container">
	<div class="row">
		<div class="col-lg-12">

			@if(Session::has('success'))
			<div class="alert alert-success">
				{{Session::get('success')}}
			</div>
			@endif
			Bâtiments en attente de validation
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Référence</th>
						<th>Adresse</th>
						<th>Etape d'inscription (max {{Config::get('var.steps')}})</th>
						<th>Utilisateur</th>
						<th>Crée le</th>
						<th>Mis à jour le</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($unverified as $building)
					<tr {{$building->register_step >= 8 ? 'class=success' :'class=error'}} >
						<td>{{$building->id}}</td>
						<td>{{$building->address}}</td>
						<td >{{$building->register_step}}</td>
						<td><a href="{{$building->user_id}}">{{$building->user->first_name.' '.$building->user->name}}</a></td>
						<td>{{Helpers::beTime($building->created_at)}}</td>
						<td>{{Helpers::beTime($building->updated_at)}}</td>
						<td>
						<a href="{{url('admin/building/validate', $building->id)}}" class="btn btn-success" title="Valider le building">✔</a href="{{url('admin/building/validate', $building->id)}}">
							<a href="{{url('admin/building/contact', $building->id)}}" class="btn btn-info" title="Envoyer un mail au l'utilisateur"><i class="glyphicon glyphicon-envelope"></i></a>
							<a class="btn btn-warning " ><i class="glyphicon glyphicon-pencil"></i></a>
							<a href="{{url('admin/building/delete', $building->id)}}" title="Supprimer le bâtiment" onclick="javascript:alert('êtes-vous sur de vouloir supprimer le bâtiment ?');" class="btn btn-danger" >X</a>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
</div>
@stop