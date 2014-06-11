<div class="back-to-top"><a class="icon icon-arrow198 tooltip-ui-s" title="{{trans('general.backTop')}}" href="#main"></a></div>
<section class="newsletter">
	<h2 aria-level="2" role="heading" class="section">{{trans('title.newsletter')}}</h2>
	<div class="wrapper">
		<div class="row">
			<p>{{trans('general.newsletter')}}</p>
			@if(isset($success_newsletter))
			{{$success_newsletter}}
			@endif

			{{Form::open(array('route'=>'newsletter','class'=>'inlineType  newsletter-form'))}}
			<input type="email" name="newsletter" required class="{{isset($fields->newsletter) ? 'form-error':''}}" id="newsletter" placeholder="{{$errors->first('newsletter')? $errors->first('newsletter') :'email@email.com'}}">
			{{Form::submit(trans('form.add'))}}
			{{Form::close()}}
		</div>
	</div>
</section>
<footer class="foot" role="contentinfo">
	<div class="contentBehind" aria-hidden="true"></div>
	<div class="wrapper">
		<h2 class="section" role="heading" aria-level="2">{{trans('title.footer')}}</h2>
		<a href="#main" class="reader">{{trans('general.goTop')}}</a>
		<a href="#nav" class="reader">{{trans('general.goNav')}}</a>
		<div class="row">
			<section class="links">
				<h3 aria-level="3" role="heading" class="linkTitle">{{trans('footer.infos')}}</h3>

				<ul class="permalink">
					@foreach(Helpers::footer() as $post)
					<?php $data = $post->translation->lists('value','key'); ?>
					@if(isset($data['slug']))
					<li><a href="{{route('showPost', $data['slug'])}}">{{$data['title']}}</a></li>
					@endif
					@endforeach
					<li><a href="{{route('contact')}}">{{trans('footer.contact-us')}}</a></li>
					<li><a href="{{route('contact')}}">{{trans('footer.mapSite')}}</a></li>
					@if(Auth::check())
					<li><a href="{{route('how_be_tenant', Auth::user()->slug)}}">{{trans('footer.become_tenant')}}</a></li>
					<li><a href="{{route('how_be_owner', Auth::user()->slug)}}">{{trans('footer.become_owner')}}</a></li>
					@endif
				</ul>

			</section>	
			<section class="links">
				<h3 aria-level="3" role="heading" class="linkTitle">{{trans('footer.other')}}</h3>

				<ul class="permalink">
					<li><a href="{{route('indexPost')}}">{{trans('footer.actu')}}</a></li>
					<li><a href="{{route('indexPostOwner')}}">{{trans('footer.helpOwner')}}</a></li>
					<li><a href="{{Auth::check() ? route('index_localisation_building', Auth::user()->slug) : route('connection')}}">{{trans('footer.add_location')}}</a></li>
					<li><a href="{{route('addSchools')}}">{{trans('footer.add_schools')}}</a></li>
					<li><a href="{{route('api')}}">{{trans('footer.api')}}</a></li>
					@if(Auth::check() && Auth::user()->role_id < 3)
					<li><a href="{{url('admin')}}">{{trans('footer.admin')}}</a></li>
					@endif


				</ul>
			</section>	
			<section class="links">
				<h3 aria-level="3" role="heading" class="linkTitle">{{trans('footer.social')}}</h3>
				<ul class="permalink">
					<li ><a class="icon icon-facebook24" href="">Facebook</a></li>
					<li ><a class="icon icon-google23" href="">Google plus</a></li>
					<li ><a class="icon icon-social19" href="">Twitter</a></li>

				</ul>
			</section>	
		</div>
	</div>
	<div class="copyright">{{trans('footer.copyright')}}</div>
</div>
</footer>
