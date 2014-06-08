<div class="introOwner">

		<!-- reassure client -->
		<div class="mainPart">
			<div class="hero">


				<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.locate')}}</h2>
				<div class="intro">
					{{trans('inscription.create_account_owner_intro')}}
					<div aria-hidden="true" class="tutoUsage right-bottom-position">
					</div>
				</div>

			</div>
			<div class="secureUser">

				<ul>
					<li class="free">
						<span class="icon icon-piggy1"></span>
						<h3 aria-level="3" role="heading" class="titleCol">Gratuit</h3>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, velit, delectus, distinctio cum natus ex ducimus fuga adipisci numquam fugiat tenetur iusto nisi eaque dolorem minus repudiandae inventore pariatur molestias!
						</p>
					</li>
					<li class="index">
						<span class="icon icon-business9"></span>
						<h3 aria-level="3" role="heading" class="titleCol">Positionnement</h3>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, velit, delectus, distinctio cum natus ex ducimus fuga adipisci numquam fugiat tenetur iusto nisi eaque dolorem minus repudiandae inventore pariatur molestias!
						</p>

					</li>
					<li class="tools">
						<span class="icon icon-tools6"></span>
						<h3 aria-level="3" role="heading" class="titleCol">Outils</h3>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, velit, delectus, distinctio cum natus ex ducimus fuga adipisci numquam fugiat tenetur iusto nisi eaque dolorem minus repudiandae inventore pariatur molestias!
						</p>

					</li>
				</ul>

			</div>
		</div>

		<sidebar class="additionnalPart">
			<h3 aria-level="3" role="heading" class="section">{{trans('inscription.add_location_now')}}</h3>

			<div class="goInscription">
			<p><span class="icon icon-new16"></span>{{trans('inscription.start_inscription_intro')}}</p>

				<p><a class="btn-inscription" href="{{route('index_localisation_building', Auth::user()->slug)}}">{{trans('inscription.add_advert')}}</a></p>
			</div>
		</sidebar>
	<!-- Notice from owner -->
	<div class="wrapper">
		<div class="mainPart">
			<h2 aria-level="2" role="heading" class="mainTitle">{{trans('inscription.notice_owner')}}</h2>
			<div class="onePeople" itemscope itemtype="http://schema.org/Person">
				<div class="vcard">
					<div class="photo" >

						<img itemprop="image" src="{{Config::get('var.img_dir').Config::get('var.no_photoUserF')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">

					</div>
					<div class="infosPeople">

						<meta itemprop="nationality" content="Belgian">
						<span class="name" itemprop="name"> <span class="b">Annie Rosmant</span></span>
						<div itemscope class="address" itemtype="http://schema.org/PostalAddress" itemprop="address">
							<span itemprop="addressRegion">{{Lang::get('locations.from_locality')}} Namur</span>
							<meta itemprop="postalCode" content="">
						</div>
					</div>
				</div>
				<div class="text">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, rerum excepturi. Ad, reprehenderit, esse optio molestiae aliquam animi temporibus modi cupiditate laborum corporis labore magni veniam vero facilis voluptas tempora.
					</p>
				</div>
			</div> 
			<div class="onePeople" itemscope itemtype="http://schema.org/Person">
				<div class="vcard">
					<div class="photo" >

						<img itemprop="image" src="{{Config::get('var.img_dir').Config::get('var.no_photoUserF')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">

					</div>
					<div class="infosPeople">

						<meta itemprop="nationality" content="Belgian">
						<span class="name" itemprop="name"> <span class="b">Annie Rosmant</span></span>
						<div itemscope class="address" itemtype="http://schema.org/PostalAddress" itemprop="address">
							<span itemprop="addressRegion">{{Lang::get('locations.from_locality')}} Namur</span>
							<meta itemprop="postalCode" content="">
						</div>
					</div>
				</div>
				<div class="text">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, rerum excepturi. Ad, reprehenderit, esse optio molestiae aliquam animi temporibus modi cupiditate laborum corporis labore magni veniam vero facilis voluptas tempora.
					</p>
				</div>
			</div> 
		</div>

		<sidebar class="additionnalPart">
			<h3 aria-level="3" role="heading" class="section">{{trans('general.need_help_contact_us')}}</h3>
			
			<span class="icon-opened4 hero-icon"></span>
			<span class="titleContact">Besoin d'informations&nbsp;?</span>
			<p><a class="btn-inscription" href="{{route('contact_us')}}">Contactez-nous</a></p>
		</sidebar>

	</div>
</div>