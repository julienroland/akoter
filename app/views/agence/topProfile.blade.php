<div class="agence-profile">

	<div class="header">
		<div class="wrapper">
			<div class="image thumbnail">
				<img src="/{{Config::get('var.images_dir')}}{{Config::get('var.agences_dir')}}{{$agence->id}}/{{Config::get('var.logoAgence_dir')}}{{$agence->logo}}" alt="{{$agence->name}}">
			</div>
			<span class="name">
				{{$agence->name}}
			</span>	
		</div>
	</div>
	<div class="wrapper">
		<nav class="menu-agence-profile">

			<ul>
				<li {{Helpers::isActive('show_agenceProfile') ? 'class="active"' :''}}>
					<a  href="{{route('show_agenceProfile',  array($agence->slug))}}">{{trans('agence.locations')}}</a>
				</li>
				<li {{Helpers::isActive('member_agenceProfile') ? 'class="active"' :''}}>
					<a  href="{{route('member_agenceProfile',  array( $agence->slug))}}">{{trans('agence.members')}}</a>
				</li>


				<li {{Helpers::isActive('info_agence') ? 'class="active"' :''}}>
					<a  href="{{route('info_agence', array( $agence->slug))}}">{{trans('agence.informations')}}</a>
				</li>

			</ul>
		</nav>
		<div class="clear" aria-hidden="true"></div>