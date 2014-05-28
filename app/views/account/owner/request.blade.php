@extends('account.layout')

@section('account')

@foreach( $requests as $req)
	
	@foreach($req->request as $r)
	{{dd($r)}}
	<div class="request">
	<div class="infos">
		<span class="title-location">{{$req->translation[0]->value}}</span>
		<span class="user-name">{{$r->first_name.' '.$r->name}}</span>
		</div>
	</div>
	@endforeach

@endforeach

@stop