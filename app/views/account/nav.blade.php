<nav role="navigation" class="nav-account">
	<h2 aria-level="2" role="heading" class="section">{{trans('account.nav')}}</h2>
	<ul>
		<div class="profil">

			@include('account.includes.photoProfile')

			<li><a href="{{route('account_home',Auth::user()->slug)}}" ><span class="icon icon-home63"></span>{{trans('account.home')}}</a></li>

			@if(Auth::user()->isOwner == 1)

			<li><a href="{{route('index_add_notice', Auth::user()->slug)}}" ><span class="icon icon-thumbs26"></span>{{trans('account.notice')}}</a></li>

			@endif

			<li class="opGroup">{{trans('account.manage')}}</li>


			<li><a href="{{route('index_localisation_building', Auth::user()->slug)}}"><span class="icon icon-new16"></span>{{trans('inscription.add_location')}}</a></li>



			<li><a href=""><span class="icon icon-send5"></span>{{trans('account.mail')}}</a></li>

			@if(Auth::user()->pro == 1)

			<li><a href="{{route('index_agence',Auth::user()->slug)}}" class="tooltip-ui-s" title="{{trans('account.check_agency')}}"><span class="icon icon-key105"></span>{{trans('account.agence')}}</a></li>

			@endif

			<li><a href="{{route('indexFavoris', array(Auth::user()->slug))}}" class="tooltip-ui-s" title="{{trans('account.check_bookmark')}}"><span class="icon icon-big61"></span>{{trans('account.bookmark')}}</a></li>

			<li><a href="" ><span class="icon icon-medal30"></span>{{trans('account.likes')}}</a></li>

			<li><a href="" title="{{trans('account.check_locations')}}" class="tooltip-ui-s"><span class="icon icon-address14"></span>{{trans('account.manage_locations')}}</a></li>

			@if(Auth::user()->isOwner == 1)

			<li><a href="{{route('seeRequest', Auth::user()->slug)}}" title="{{trans('account.number_request')}}" class="tooltip-ui-s"><span class="icon icon-gearwheels"></span>{{trans('account.request')}}
				@if($request > 0 )<span class="nb_request">{{$request}}</span>
				@endif
			</a></li>

			<li><a href="{{route('indexAdverts',Auth::user()->slug)}}" title="{{trans('account.check_advert')}}" class="tooltip-ui-s"><span class="icon icon-gearwheels"></span>{{trans('account.manage_locations_propri')}}</a></li>

			@endif

			<li class="opGroup">{{trans('account.configuration')}}</li>

			<li class="active">

				<a  title="{{trans('account.check_personnal_informations')}}" class="tooltip-ui-s {{isset($personnalNotComplete) &&  Helpers::isOk($personnalNotComplete) && $personnalNotComplete->count > 0 ? 'hasInfo' : ''}}" href="{{route('account_personnal', Auth::user()->slug)}}" {{Helpers::isActive('account_personnal')}}>
					<span class="icon icon-user3"></span>{{trans('account.personnal_informations')}}

					@if(isset($personnal))
					@if( Helpers::isOk($personnal) && $personnal->count > 0)
					<span class="warning-tick icon-shield35" aria-hidden="true"></span>
					@endif
					@endif
					@if(isset($personnal))
					@if( Helpers::isOk($personnal) && $personnal->count > 0)
					<div class="warning-tick-box">
						{{trans('account.required_percent', array('percent'=>Helpers::toPercent($personnal->count,$personnal->total,'diff')))}} 
					</div>
					@endif
					@endif
				</a>
			</li>
			<li>

				<a title="{{trans('account.check_settings')}}" class="tooltip-ui-s" href="{{route('account_params',Auth::user()->slug)}}" {{Helpers::isActive('account_params')}}>
					<span class="icon icon-tools6"></span>{{trans('account.settings')}}
					@if(Auth::user()->email_comfirm == 0)
					<span class="warning-tick icon-shield35" aria-hidden="true"></span>
					<div class="warning-tick-box">
						{{trans('account.email_not_comfirm')}} 
					</div>
					@endif
				</a>


			</li>

		</ul>
	</nav>