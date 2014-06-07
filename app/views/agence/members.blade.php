@extends('agence.layout')

@section('agence')

@include('agence.top')

<div class="members">
	
	@foreach($members as $member)

	<div class="member vcard {{$member->id == $boss->id ? 'boss':''}}" id="hcard-{{$member->first_name}}-{{$member->name}}" title={{$member->id == $boss->id ? trans('agence.boss') :''}}>
		<div class="user-picture">
			@if(Helpers::isOk($member->photo))
			<img class="member-photo photo" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').$member->id.'/'.Config::get('var.profile_dir').$member->photo}}" alt="{{$member->name}}">
			@else
			@if(Auth::user()->civility == 0)

			<img class="member-photo photo" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserM')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">

			@else 

			<img class="member-photo photo" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserF')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
			@endif
			@endif
		</div>

		<div class="user-info">
			<span class="fn n name"><span class="given-name">{{$member->first_name}}</span> <span class="family-name">{{$member->name}}</span></span>
			<a class="email section" href="mailto:{{$member->email}}">{{$member->email}}</a>
			<div class="adr section">
				<div class="street-address">{{$member->address}}</div>
				<a class="url fn section" href="{{$member->web}}">{{$member->first_name}} {{$member->name}}</a>
				<span class="locality">{{$member->locality->name}}</span>

				<span class="region">{{$member->region->translation[0]->value}}</span>

				<span class="postal-code">{{$member->postal}}</span>

			</div>
		</div>
		@if(Auth::user()->id == $agence->user_id)
		<div class="actions">
		<a onclick="alert({{trans('form.are_you_sure')}})" href="{{route('remove_member_agence', array(Auth::user()->slug, $agence->slug,$member->id))}}">{{trans('form.delete')}}</a>
		</div>
		@endif
	</div>

	@endforeach
</div>
</div>
@stop