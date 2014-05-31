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
				{{$notices->appends(Input::get())->links()}}
			</div>
			<div class="col-lg-4 right">
				@include('admin.includes.sort')
			</div>

			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Référence</th>
						<th>Nom</th>
						<th>Texte</th>
						<th>Crée le</th>
						<th>Mis à jour le</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>

					@foreach($notices as $notice)

					<?php $translation = $notice->translation->lists('value','key'); ?>

					<tr >
						<td>{{$notice->id}}</td>
						<td><a href="{{url('admin/users', $notice->user->id)}}">{{$notice->user->first_name.' '.$notice->user->first_name}}</a></td>
						<td>{{$translation['text']}}</td>
						<td>{{Helpers::betime($notice->created_at)}}</td>
						<td>{{Helpers::betime($notice->updated_at)}}</td>
						<td>
							<a href="{{$notice->validate == 0 ? url('admin/notices/validate', $notice->id) : url('admin/notices/devalidate', $notice->id)}}" class="btn {{$notice->validate == 1 ? 'btn-success' : 'btn-danger'}}"><i class="glyphicon glyphicon-{{$notice->validate == 1 ? 'ok' : 'remove'}}"></i></a>
							<a href="{{url('admin/notices/edit', $notice->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
							<a href="{{url('admin/notices/delete', $notice->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
						</td>
						
					</tr>
					@endforeach

				</tbody>
			</table>

			{{$notices->appends(Input::all())->links()}}

		</div>
	</div>
</div>
@stop