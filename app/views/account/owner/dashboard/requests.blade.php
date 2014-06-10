@extends('account.owner.dashboard.layout')

@section('dashboard')
<div class="requests">
	@if($location->request->count())

	@foreach($location->request as $req)

	<div class="request">
		<div class="infos">
			<span class="title-location">{{$location->translation[0]->value}}</span>
			<div class="user">
				<div class="image">
					@if(Helpers::isOk($req->photo))
					<img class="thumbnail photo" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').$req->id.'/'.Config::get('var.profile_dir').$req->photo}}" alt="{{$req->name}}">
					@else
					@if(Auth::user()->civility == 0)

					<img class="thumbnail photo" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserM')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">

					@else 

					<img class="thumbnail photo" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoUserF')}}" alt="{{trans('account.imageProfile', array('name'=>Auth::user()->first_name. ' ' .Auth::user()->name))}}" width="{{Config::get('var.user_photo_width')}}" height="{{Config::get('var.user_photo_height')}}">
					@endif
					@endif
				</div>
				<span class="user-name">{{$req->first_name.' '.$req->name}}</span>
			</div>
			<div class="infos-locations">
				<span class="seat">{{trans('account.nb_seat',array('number'=>$req->pivot->seat))}}</span>
				<span class="nb_locations">{{trans('account.nb_locations',array('number'=>$req->pivot->nb_locations))}}</span>
				<div class="date">
					<span class="begin">{{$req->begin}}</span>
					<span class="end">{{$req->end}}</span>
				</div>
				<p>{{$req->text}}</p>
				<p class="created">{{$req->created_at}}</p>
			</div>			
		</div>
		<div class="actions">
		<a href="{{route('validRequest',array(Auth::user()->slug,$req->pivot->id))}}" class="accept tooltip-ui-e icon icon-approve" title="{{trans('account.accept')}}"></a>
		<a href="{{route('refuseRequest',array(Auth::user()->slug,$req->pivot->id))}}" class="refuse tooltip-ui-e icon icon-remove11" title="{{trans('account.refuse')}}"></a>

	</div>
	</div>
	
	@endforeach
	@else
	<p class="informations">{{trans('account.no_request_location',array('number'=>$location->id))}}</p>
	@endif
</div>
@stop