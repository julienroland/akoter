@extends('admin.layout.layout')

@section('container')

<div class="row">
	{{Form::open(array('url'=>array('admin/articles/store')))}}
	<div class="col-lg-8">

		@if(Session::has('success'))
		<div class="alert alert-success">
			{{Session::get('success')}}
		</div>
		@endif
		@include('admin.includes.errors')

		{{Form::btext('title','Titre','')}}

		{{Form::btext('slug','Url généré','',array('disabled'))}}

		{{Form::btextarea('text','Contenu','',array('class'=>'editor'))}}


	</div>
	<div class="col-lg-4">

		<p><label for="publish">Publié:</label> <input type="checkbox" name="publish" id="publish">	</p>
		<p><label for="type">Type:</label> {{Form::select('type',$postTypes)}}</p>
		<p><label for="page">Page:</label> <input type="text" name="page" value=""></p>
		<p><label for="position">Position:</label> <input type="text" name="position" value=""></p>
		<div>
			{{Form::submit('Ajouter', array('class'=>'btn btn-primary'))}}

		</div>
		<div>

			<h3>Photo à la une</h3>
			<input type="file" name="photo" id="photo">

		</div>
	</div>
	{{Form::close()}}
</div>
@stop