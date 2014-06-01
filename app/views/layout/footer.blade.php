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
		<h2 class="section" role="heading" aria-level="2">Trouvez les informations général, d'autres informations utiles aux développeur, ... et retrouvez-nous sur les réseaux sociaux !</h2>
		<a href="#main" class="reader">Remonter au contenu</a>
		<a href="#nav" class="reader">Revenir à la navigation</a>
		<div class="row">
			<section class="links">
				<h3 aria-level="3" role="heading" class="linkTitle">Informations</h3>

				<ul class="permalink">
					<li><a href="">Conditions général d'utilisation</a></li>
					<li><a href="{{route('contact')}}">Contact</a></li>
					<li><a href="{{route('contact')}}">Qui sommes-nous</a></li>
					<li><a href="{{route('contact')}}">Plan du site</a></li>
					@if(Auth::check())
					<li><a href="{{route('how_be_tenant', Auth::user()->slug)}}">Devenir locataraire</a></li>
					<li><a href="{{route('how_be_owner', Auth::user()->slug)}}">Devenir proprietaire</a></li>
					@endif
				</ul>
			
		</section>	
		<section class="links">
			<h3 aria-level="3" role="heading" class="linkTitle">Autres</h3>

			<ul class="permalink">
				<li><a href="{{route('api')}}">API</a></li>
				<li><a href="{{route('api')}}">Blog</a></li>
				<li><a href="">Ajout logement</a></li>
				<li><a href="">Ajout école</a></li>
				
				
			</ul>
		</section>	
		<section class="links">
			<h3 aria-level="3" role="heading" class="linkTitle">Réseaux sociaux</h3>

			<ul class="permalink">
				<li class="icon icon-facebook"><a href="">Facebook</a></li>
				
			</ul>
		</section>	
		</div>
	</div>
	<div class="copyright">Copyright © 2014 www.akoter.julien-roland.be - Tous droits réservés.</div>
</div>
</footer>
