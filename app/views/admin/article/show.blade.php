@extends('admin.layout.layout')

@section('container')



<div class="container">
	<div class="row">
		<div class="col-lg-8">

			@if(Session::has('success'))
			<div class="alert alert-success">
				{{Session::get('success')}}
			</div>
			@endif

			{{Form::open(array('url'))}}
			<?php $translation = $post->translation->lists('value','key'); ?>
			{{Form::btext('title','Titre',isset($translation['title']) ? $translation['title']:'')}}
			
			{{Form::btext('slug','Url généré',isset($translation['slug']) ? $translation['slug']:'',array('disabled'))}}

			{{Form::btextarea('text','Contenu',isset($translation['content']) ? $translation['content']:'',array('class'=>'editor'))}}
			{{Form::close()}}

		</div>
		<div class="col-lg-4">
		Posté par : <a href="">{{$post->user->first_name.' '. $post->user->name}}</a>
		Crée le : {{Helpers::beTime($post->created_at)}}
		Dernière modification le : {{Helpers::beTime($post->updated_at)}}
		</div>
	</div>
</div>
@stop