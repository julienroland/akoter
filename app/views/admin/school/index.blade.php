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
			{{$schools->appends(Input::all())->links()}}
			</div>
			<div class="col-lg-4">
				@include('admin.includes.sort')
			</div>

			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Référence</th>
						<th>Nom</th>
						<th>Nom court</th>
						<th>Adresse</th>
						<th>Site web</th>
						<th>Validaté</th>
						<th>Crée le</th>
						<th>Mis à jour le</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>

					@foreach($schools as $school)
					
					<tr >
						<td>{{$school->id}}</td>
						<td>{{$school->name}}</td>
						<td>{{$school->short}}</td>
						<td>{{$school->street}}</td>
						<td><a href="{{$school->web}}">{{$school->web}}</a></td>
						<td><i class="glyphicon glyphicon-{{$school->status_type == 1 ? 'ok' : 'remove'}}"></i></td>
						<td>{{Helpers::dateNaForm($school->created_at)}}</td>
						<td>{{Helpers::dateNaForm($school->updated_at)}}</td>
						<td>

							<a href="{{$school->status_type == 1 ? url('admin/schools/devalidate', $school->id) : url('admin/schools/validate', $school->id)}}" class="btn {{$school->status_type == 1 ? 'btn-success' : 'btn-danger'}}"><i class="glyphicon glyphicon-{{$school->status_type == 1 ? 'ok' : 'remove'}}"></i></a>

							<a href="{{url('admin/schools/delete', $school->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$schools->appends(Input::all())->links()}}

		</div>
	</div>
</div>
@stop