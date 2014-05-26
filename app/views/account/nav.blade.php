<div class="nav-account">
	<ul>
		<div class="profil">
			<div class="thumbnail">

				@if( Auth::user()->photo && Helpers::isOk(Auth::user()->photo) )
				<a href="{{route('account_home', Auth::user()->slug)}}" title="{{trans('account.show', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}">
					<img src="{{Config::get('var.path').Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.profile_dir').Auth::user()->photo}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
				</a>
				@else 
				@if(Auth::user()->civilty == 0)
				<a href="{{route('account_home', Auth::user()->slug)}}" title="{{trans('account.show', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}">
					<img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserM')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
				</a>
				@else 
				<a href="{{route('account_home', Auth::user()->slug)}}" title="{{trans('account.show', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}">
					<img src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserF')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
				</a>
				@endif
				@endif
			</div>
			<span class="name">{{Auth::user()->first_name}} {{Auth::user()->name}}</span>
			<a href="{{route('edit_photo', Auth::user()->slug)}}">{{trans('account.edit_photo')}}</a>
		</div>
		<!-- <div class="lastConnection">
			<span class="icon icon-clock4"></span>{{trans('account.connected_at', array('date'=>Helpers::beTime(Auth::user()->connected_at)))}}
		</div>	 -->
		<li><a href="{{route('account_home',Auth::user()->slug)}}" ><span class="icon icon-home63"></span><span>{{trans('account.home')}}</span></a></li>
		<li class="opGroup">{{trans('account.manage')}}</li>

		<li><a href="{{route('index_localisation_building', Auth::user()->slug)}}"><span class="icon icon-new16"></span><span>{{trans('inscription.add_location')}}</span></a></li>
		<li><a href=""><span class="icon icon-send5"></span><span>{{trans('account.mail')}}</span></a></li>

		@if(Auth::user()->pro == 1)

		<li><a href="{{route('index_agence',Auth::user()->slug)}}" ><span class="icon icon-close13"></span><span>{{trans('account.agence')}}</span></a></li>

		@endif

		<li><a href="" ><span class="icon icon-big61"></span><span>{{trans('account.bookmark')}}</span></a></li>
		<li><a href="" ><span class="icon icon-medal30"></span><span>{{trans('account.likes')}}</span></a></li>
		<li><a href="" ><span class="icon icon-gearwheels"></span><span>{{trans('account.manage_locations')}}</span></a></li>
		<li><a href="" ><span class="icon icon-gearwheels"></span><span>{{trans('account.manage_locations_propri')}}</span></a></li>
		<li class="opGroup">{{trans('account.configuration')}}</li>

		<li class="active">

			<a  title="{{trans('account.personnal_informations')}}" class="{{isset($personnalNotComplete) &&  Helpers::isOk($personnalNotComplete) && $personnalNotComplete->count > 0 ? 'hasInfo' : ''}}" href="{{route('account_personnal', Auth::user()->slug)}}" {{Helpers::isActive('account_personnal')}}>
				<span class="icon icon-user3"></span><span>{{trans('account.personnal_informations')}}</span>

				@if(isset($personnalNotComplete))
				@if( Helpers::isOk($personnalNotComplete) && $personnalNotComplete->count > 0)
				<span class="warning-tick icon-shield35" aria-hidden="true"></span>
				@endif
				@endif
				@if(isset($personnalNotComplete))
				@if( Helpers::isOk($personnalNotComplete) && $personnalNotComplete->count > 0)
				<div class="warning-tick-box">
					{{trans('account.required_percent', array('percent'=>Helpers::toPercent($personnalNotComplete->count,$personnalNotComplete->total,'diff')))}} 
				</div>
				@endif
				@endif
			</a>
		</li>
		<li>

			<a title="{{trans('account.settings')}}" href="{{route('account_params',Auth::user()->slug)}}" {{Helpers::isActive('account_params')}}>
				<span class="icon icon-tools6"></span><span>{{trans('account.settings')}}</span>
			</a>
			

		</li>
		
	</ul>
</div>