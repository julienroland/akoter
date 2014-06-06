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
		<li {{Helpers::isActive( 'edit_agence' )}}>
			<a href="{{route('edit_agence',Auth::user()->slug)}}">
			{{trans('agence.edit')}}
			</a>
		</li>
	</ul>
</div>