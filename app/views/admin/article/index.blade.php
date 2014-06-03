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
				{{$articles->appends(Input::get())->links()}}
			</div>
			<div class="col-lg-4 right">
				@include('admin.includes.sort')
			</div>
			<a href="{{url('admin/articles/add')}}">Ajouter un article</a>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Référence</th>
						<th>Titre</th>
						<th>Page</th>
						<th>Position dans la page</th>
						<th>Auteur</th>
						<th>Crée le</th>
						<th>Mis à jour le</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $post)
					
					<tr >
						<td>{{$post->id}}</td>
						<td>{{$post->translation[0]->value}}</td>
						<td>{{$post->content_type}}</td>
						<td>{{$post->content_position}}</td>
						<td><a href="">{{$post->user->first_name.' '.$post->user->name}}</a></td>
						<td>{{Helpers::beTime($post->created_at)}}</td>
						<td>{{Helpers::beTime($post->updated_at)}}</td>
						<td>
							<a href="{{url('admin/articles/edit', $post->id)}}" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
							<a href="{{$post->publish == 0 ? url('admin/articles/publish', $post->id) : url('admin/articles/depublish', $post->id) }}" class="btn {{$post->publish == 0 ? 'btn-success' : 'btn-danger'}}"><i class="glyphicon glyphicon-eye-{{$post->publish == 0 ? 'open' : 'close'}}"></i></a>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$articles->links()}}
		</div>
	</div>
</div>
@stop