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