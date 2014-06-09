@extends('layout.layout')
@section('container')

<div class="post">
	<article itemscope itemtype="http://schema.org/BlogPosting">
		<?php $translation = $post->translation->lists('value','key'); ?>
		<div class="hero">
			<div class="wrapper">
				<h3 aria-level="3" itemprop="headline" role="heading" class="heading">{{$translation['title']}}</h3>
				<time itemprop="datePublished" datetime="{{$post->created_at->toDateTimeString()}}" class="date_publish">
					{{trans('posts.publish_at',array('date'=>Helpers::betime($post->created_at)))}}
				</time>
			</div>
		</div>
		<div class="wrapper">
			<div itemprop="text" class="content">
				{{html_entity_decode($translation['content'])}}
			</div>
		</div>
	</article>
	@if($otherPosts->count())
	<div class="wrapper">
		<div class="otherPosts">
			<h4 aria-level="4" itemprop="headline" role="heading" class="titleOtherPost">{{trans('posts.morePost')}}</h4>
			<div class="row">
				@foreach($otherPosts as $post)
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
	@endif
</div>

@stop