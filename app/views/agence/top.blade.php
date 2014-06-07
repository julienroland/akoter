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
			<li {{Helpers::isActive('show_agence') ? 'class="active"' :''}}>
				<a  href="{{route('show_agence',  $agence->slug)}}">{{trans('agence.locations')}}</a>
			</li>
			<li {{Helpers::isActive('agence_members') ? 'class="active"' :''}}>
				<a  href="{{route('agence_members',  $agence->slug)}}">{{trans('agence.members')}}</a>
			</li>
			@if(Auth::check())
			<li {{Helpers::isActive('edit_agence') ? 'class="active"' :''}}>
				<a  href="{{route('edit_agence', array(Auth::user()->slug, $agence->slug))}}">{{trans('agence.informations')}}</a>
			</li>
			@endif
		</ul>
	</nav>
	<div class="clear" aria-hidden="true"></div>