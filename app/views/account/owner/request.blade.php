@extends('account.layout')

@section('account')

@foreach( $requests as $building)

	@foreach($building->location as $location)

	@foreach($location->request as $req)

	<div class="request">
	<div class="infos">
		<span class="title-location">{{$location->translation[0]->value}}</span>
		
		<span class="user-name">{{$req->first_name.' '.$req->name}}</span>
		</div>
	</div>
	<div class="actions">
		
	</div>
	@endforeach
	@endforeach

@endforeach

@stop