
<div class="home-location">
	<div class="account-intro">
		<h2 aria-level="2" role="heading" class="title-account">{{trans('account.your_locations')}}</h2>
	</div>
	@if($locations->count())
	<div class="waitingLocation">	

		@foreach($locations as $location)
		<div class="date">
			<span class="dateDiff">{{$now->diffInDays(Helpers::createCarbonDate($location->pivot->begin))}}</span> <span>{{trans('account.daysBeforeLocation', array('ref'=>$location->id,'url'=>route('showLocation', array($location->translation[0]->value))))}}</span>
		</div>

		@endforeach

	</div>	
	@endif
	
	<div class="requests-tenant">

		@if($acceptedRequests > 0 || $waitingRequests > 0 || $refusedRequests > 0)
		<h3 aria-level="3" role="heading" class="titleTenant">{{trans('account.tenant_requests')}}</h3>

		@if($acceptedRequests > 0)
		<div class="request-tenant accepted">
			<span class="number">{{$acceptedRequests}}</span> <span>{{trans('account.request_tenants_accepted')}}</span>
		</div>
		@endif

		@if($waitingRequests > 0)
		<div class="request-tenant waiting">
			<span class="number">{{$waitingRequests}}</span> <span>{{trans('account.request_tenants_waiting')}}</span>
		</div>
		@endif
		
		@if($refusedRequests > 0)
		<div class="request-tenant refused">
			<span class="number">{{$refusedRequests}}</span> <span>{{trans('account.request_tenants_refused')}}</span>
		</div>
		@endif

		@else
		<p>{{trans('account.no_request_tenant')}}</p>
		@endif
	</div>
</div>