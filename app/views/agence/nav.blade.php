<div class="menu-agence account-submenu">
	<ul>

		<li {{Helpers::isActive( 'index_agence' )}}>
			<a href="{{route('index_agence',Auth::user()->slug)}}">
				{{trans('agence.home')}}
			</a>
		</li>
		<li {{Helpers::isActive( 'add_agence' )}}>
			<a href="{{route('add_agence',Auth::user()->slug)}}">
				{{trans('agence.add')}}
			</a>
		</li>
		@if(isset($agence) && Helpers::isOk($agence) && $agence->user_id == Auth::user()->id)
		<li {{Helpers::isActive( 'edit_agence' )}}>
			<a href="{{route('edit_agence', array(Auth::user()->slug, $agence->slug))}}">
				{{trans('agence.edit')}}
			</a>
		</li>
		@endif
		<li {{Helpers::isActive( 'join_agence' )}}>
			<a href="{{route('join_agence',Auth::user()->slug)}}">
				{{trans('agence.join_agence')}}
			</a>
		</li>
	</ul>
</div>