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
			{{$users->appends(Input::all())->links()}}
			</div>
			<div class="col-lg-4">
				@include('admin.includes.sort')
			</div>

			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Référence</th>
						<th>Nom</th>
						<th>Email</th>
						<th>Role</th>
						<th>Langue</th>
						<th>Email-Comfirm</th>
						<th>Validaté</th>
						<th>Propriétaire</th>
						<th>Supprimé</th>
						<th>Dernière connexion</th>
						<th>Crée le</th>
						<th>Mis à jour le</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>

					@foreach($users as $user)
					
					<tr >
						<td>{{$user->id}}</td>
						<td>{{$user->first_name. ' ' .$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->role->name}}</td>
						<td>{{$user->language->name}}</td>
						<td><i class="glyphicon glyphicon-{{$user->email_comfirm == 1 ? 'ok' : 'remove'}}"></i> </td>
						<td><i class="glyphicon glyphicon-{{$user->validate == 1 ? 'ok' : 'remove'}}"></i></td>
						<td><i class="glyphicon glyphicon-{{$user->isOwner == 1 ? 'ok' : 'remove'}}"></i></td>
						<td><i class="glyphicon glyphicon-{{$user->delete == 1 ? 'ok' : 'remove'}}"></i></td>
						<td>{{$user->connected_at->diffForHumans()}}</td>
						<td>{{Helpers::dateNaForm($user->created_at)}}</td>
						<td>{{Helpers::dateNaForm($user->updated_at)}}</td>
						<td>
							<a href="{{url('admin/users/validate', $user->id)}}" class="btn {{$user->validate == 1 ? 'btn-success' : 'btn-danger'}}"><i class="glyphicon glyphicon-{{$user->validate == 1 ? 'ok' : 'remove'}}"></i></a>
							<a href="{{url('admin/users/voir', $user->id)}}" class="btn btn-info"><i class="glyphicon glyphicon-eye-open"></i></a>
							<a href="{{url('admin/users/edit', $user->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
							<a href="{{url('admin/users/delete', $user->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$users->appends(Input::all())->links()}}

		</div>
	</div>
</div>
@stop