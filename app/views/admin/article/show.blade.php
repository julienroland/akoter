@extends('admin.layout.layout')

@section('container')

	<div class="row">
	{{Form::open(array('url'=>array('admin/articles/edit',$post->id)))}}
		<div class="col-lg-8">

			@if(Session::has('success'))
			<div class="alert alert-success">
				{{Session::get('success')}}
			</div>
			@endif

			

			<?php $translation = $post->translation->lists('value','key'); ?>

			{{Form::btext('title','Titre',isset($translation['title']) ? $translation['title']:'')}}
			
			{{Form::btext('slug','Url généré',isset($translation['slug']) ? $translation['slug']:'',array('disabled'))}}

			{{Form::btextarea('text','Contenu',isset($translation['content']) ? $translation['content']:'',array('class'=>'editor'))}}
			

		</div>
		<div class="col-lg-4">
			<p>Posté par : <a href="{{url('admin/user/show', $post->user->id)}}">{{$post->user->first_name.' '. $post->user->name}}</a></p>
			<p>Crée le : {{Helpers::beTime($post->created_at)}}</p>
			<p>Dernière modification le : {{Helpers::beTime($post->updated_at)}}</p>
			<p>Publié: <a href="{{$post->publish == 1 ? url('admin/articles/notpublish', $post->id) :url('admin/articles/publish', $post->id) }}" title="{{$post->publish == 1 ? 'Ne pas publier' : 'Le mettre en ligne'}}"><span class="glyphicon glyphicon-{{$post->publish == 1 ? 'ok alert-success' :'remove alert-danger' }}"></span></a></p>
			<p><label for="type">Type:</label> {{Form::select('type',$postTypes,$post->post_type_id)}}</p>
			<p>Page: <input type="text" name="page" value="{{$post->content_type}}"></p>
			<p>Position: <input type="text" name="position" value="{{$post->content_position}}"></p>
			<div>
				{{Form::submit('Modifier', array('class'=>'btn btn-primary'))}}
				{{Form::close()}}
			</div>
			<div>

				<h3>Photo à la une</h3>
				<a href="javascript:void(0)" onclick="$('#photo').click(); $('.photo').removeClass('hide');" title="Changer l'image">
					<img class="thumbnail" src="/{{Config::get('var.img_posts_dir').$post->img}}" width="{{$post->width}}" height="{{$post->height}}">
				</a>
				{{Form::open(array('url'=>array('admin/articles/addPhoto',$post->id),'files'=>true))}}
				<input type="file" style="display:none;" name="photo" id="photo">
				{{Form::submit('Changer la photo',array('class'=>'photo btn btn-primary hide'))}}
				{{Form::close()}}
			</div>
		</div>
	</div>
@stop