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
			<div class="col-lg-8">
				{{$unverified->appends(Input::get())->links()}}
			</div>
			<div class="col-lg-4 right">
				@include('admin.includes.sort')
			</div>
			Locations en attente de validation
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Référence</th>
						<th>Adresse</th>
						<th>Prix</th>
						<th>Nombre places</th>
						<th>Nombre d'annonces</th>
						<th>Utilisateur</th>
						<th>Crée le</th>
						<th>Mis à jour le</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($unverified as $location)
					<tr>
						<td>{{$location->id}}</td>
						<td>{{$location->building->address}}</td>
						<td >{{$location->price}}</td>
						<td >{{$location->nb_room}}</td>
						<td >{{$location->nb_locations}}</td>
						<td><a href="{{$location->building->user_id}}">{{$location->building->user->first_name.' '.$location->building->user->name}}</a></td>
						<td>{{Helpers::beTime($location->created_at)}}</td>
						<td>{{Helpers::beTime($location->updated_at)}}</td>
						<td>
						<a href="{{url('admin/location/validate', $location->id)}}" class="btn btn-success" title="Valider le building">✔</a href="{{url('admin/location/validate', $location->id)}}">
							<a href="{{url('admin/location/contact', $location->id)}}" class="btn btn-info" title="Envoyer un mail au l'utilisateur"><i class="glyphicon glyphicon-envelope"></i></a>
							<a class="btn btn-warning " ><i class="glyphicon glyphicon-pencil"></i></a>
							<a href="{{url('admin/location/delete', $location->id)}}" title="Supprimer le bâtiment" onclick="javascript:alert('êtes-vous sur de vouloir supprimer le bâtiment ?');" class="btn btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$unverified->links()}}

		</div>
	</div>
</div>
@stop