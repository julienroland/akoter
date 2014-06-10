@extends('account.layout')

@section('account')

@include('includes.errors')
<div class="requests">
	@foreach( $requests as $building)

	@foreach($building->location as $location)

	@if($location->request->count())

	@foreach($location->request as $req)

	<div class="request">
		<div class="infos">
			<span class="title-location">{{$location->translation[0]->value}}</span>

			<span class="user-name">{{$req->first_name.' '.$req->name}}</span>
			<div class="infos-locations">
				<span class="seat">{{trans('account.nb_seat',array('number'=>$req->pivot->seat))}}</span>
				<span class="nb_locations">{{trans('account.nb_locations',array('number'=>$req->pivot->nb_locations))}}</span>
			</div>			
		</div>
		<div class="actions">
			<a href="{{route('validRequest',array(Auth::user()->slug,$req->pivot->id))}}" class="accept tooltip-ui-e icon icon-approve" title="{{trans('account.accept')}}"></a>
			<a href="{{route('refuseRequest',array(Auth::user()->slug,$req->pivot->id))}}" class="refuse tooltip-ui-e icon icon-remove11" title="{{trans('account.refuse')}}"></a>

		</div>
	</div>
	@endforeach
	@else
	<p class="informations">{{trans('account.no_request_location', array('number'=>$location->id))}}</p>
	@endif
	@endforeach

	@endforeach
</div>
@stop