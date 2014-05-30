@extends('layout.layout')
@section('container')

<div class="post">

	<?php $translation = $post->translation->lists('value','key'); ?>
	<div class="hero">
		<div class="wrapper">
			<h3 aria-level="3" role="heading" class="heading">{{$translation['title']}}</h3>
			<time datetime="{{$post->created_at}}" class="date_publish">
				{{trans('posts.publish_at',array('date'=>Helpers::betime($post->created_at)))}}
			</time>
		</div>
	</div>
	<div class="wrapper">
		<div class="content">
			{{$translation['content']}}
		</div>
		<div class="otherPosts">
			<h4 aria-level="4" role="heading" class="titleOtherPost">{{trans('posts.morePost')}}</h4>
			<div class="row">
				@foreach($otherPosts as $post)
				<div class="otherPost">

					<?php $translation = $post->translation->lists('value','key'); ?>

					<a role="button" title="{{trans('general.post.title',array('name'=>$translation['title']))}}" href="{{route('showPost',$translation['slug'])}}"><img src="/{{Config::get('var.img_posts_dir').$post->img}}" width="{{$post->width}}" height="{{$post->height}}" class="imgIntro" aria-hidden="true"></a>
					<h3 aria-level="3" role="heading" class="titleText">{{$translation['title']}}</h3>
					{{$translation['content']}}

					<a href="{{route('showPost',$translation['slug'])}}" class="learnMore">{{trans('general.post.more')}}</a>

				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

@stop