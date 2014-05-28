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
					@foreach($articles as $article)
					
					<tr >
						<td>{{$article->id}}</td>
						<td>{{$article->translation[0]->value}}</td>
						<td>{{$article->content_type}}</td>
						<td>{{$article->content_position}}</td>
						<td><a href="">{{$article->user->first_name.' '.$article->user->name}}</a></td>
						<td>{{Helpers::beTime($article->created_at)}}</td>
						<td>{{Helpers::beTime($article->updated_at)}}</td>
						<td>
							<a href="{{url('admin/articles/voir', $article->id)}}" class="btn btn-info">Voir</a>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
</div>
@stop