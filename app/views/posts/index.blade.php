@extends('layout.layout')
@section('container')

<div class="post">
<div class="hero">
	<div class="wrapper">

		<h2 aria-level="2" role="heading" class="mainTitle">{{trans('posts.title_article')}}</h2>
		<div class="intro">
			{{trans('posts.intro_article')}}
		</div>
	</div>
</div>
	<div class="wrapper">
		<div class="otherPosts">
			@foreach($posts as $post)
			<article itemscope itemtype="http://schema.org/BlogPosting" class="otherPost">

				<?php $translation = $post->translation->lists('value','key'); ?>

				<a role="button" itemprop="url" title="{{trans('general.post.title',array('name'=>$translation['title']))}}" href="{{route('showPost',$translation['slug'])}}"><img src="/{{Config::get('var.img_posts_dir').$post->img}}" width="{{$post->width}}" height="{{$post->height}}" class="imgIntro" aria-hidden="true"></a>
				<h3 aria-level="3" itemprop="headline" role="heading" class="titleText">{{$translation['title']}}</h3>
				<div itemprop="text">
					{{$translation['content']}}
				</div>
				<a itemprop="url" role="button" href="{{route('showPost',$translation['slug'])}}" class="learnMore">{{trans('general.post.more')}}</a>

			</article>
			@endforeach
		</div>
	</div>
</div>

@stop