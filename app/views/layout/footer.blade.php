<section class="newsletter">
		<h2 aria-level="2" role="heading" class="section">{{trans('title.newsletter')}}</h2>
	<div class="wrapper">
			<p>{{trans('general.newsletter')}}</p>
			@if(isset($success_newsletter))
			{{$success_newsletter}}
			@endif

			{{Form::open(array('route'=>'newsletter','class'=>'inlineType  newsletter-form'))}}
				<input type="email" name="newsletter" required class="{{isset($fields->newsletter) ? 'form-error':''}}" id="newsletter" placeholder="{{$errors->first('newsletter')? $errors->first('newsletter') :'email@email.com'}}">
				{{Form::submit(trans('form.add'))}}
			{{Form::close()}}
	</div>
</section>
<footer class="foot" role="contentinfo">
<div class="contentBehind" aria-hidden="true"></div>
	<div class="wrapper">
		<h2 class="section" role="heading" aria-level="2">Informations additionelles à la page</h2>
		<a href="#main" class="reader">Remonter au contenu</a>
		<a href="#nav" class="reader">Revenir à la navigation</a>
		<ul class="permalink">
			<li><a href="">Conditions général d'utilisation</a></li>
			<li><a href="{{route('contact')}}">Contact</a></li>
			<li><a href="{{route('api')}}">API</a></li>
			<li><a href="{{route('how_be_tenant')}}">Devenir locataraire</a></li>
			<li><a href="{{route('how_be_owner')}}">Devenir proprietaire</a></li>
		</ul>
		<div class="copyright">Copyright © 2014 www.akoter.julien-roland.be - Tous droits réservés.</div>
	</div>
</footer>
