@extends('account.layout')

@section('account')

@include('includes.errors')
<div class="requests">
	@if($requests->count())

	@foreach( $requests as $requestTenant)

	<div class="request {{$requestTenant->pivot->status == 0 && $requestTenant->pivot->request == 0 ? 'refuse' :''}}">

		<span>
			{{trans('account.request_tenants_text',array('number'=>$requestTenant->id,'url'=>route('showLocation', $requestTenant->translation[0]->value)))}}
		</span>
		<div class="actions">
			<a href="{{route('removeRequest', array(Auth::user()->slug, $requestTenant->pivot->id))}}" class="icon icon-remove11 tooltip-ui " title="{{trans('account.remove_request')}}"></a>
		</div>

	</div>


	@endforeach

	@else
	<p class="informations">{{trans('account.no_request_tenant')}}</p>
	@endif

</div>
@stop