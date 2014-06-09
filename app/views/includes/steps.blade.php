<div class="row">
	<div class="steps">
		
		@for($i=1; $i<=Config::get('var.steps');$i++)

		<div class="step">

			<a role="button" title="{{Config::get('var.steps_names')[$i]}}" {{isset($building) && ($building->register_step >= $i || $building->register_step  == $i-1) ? 'style=cursor:pointer' : ''}} class="tooltip-ui-n cnt {{isset($building) && Config::get('var.steps_routes')[$i] == Route::current()->getName() ? 'current' : (isset($building) && $building->register_step >= $i ? 'done' :(isset($building) && $building->register_step  == $i-1 && Config::get('var.steps_routes')[$i] == Route::current()->getName() ? 'current' : ''))}}" href="{{isset($building) && ($building->register_step >= $i || $building->register_step  == $i-1) ? route(Config::get('var.steps_routes')[$i],array(Auth::user()->slug, isset($building) ? $building->id:'', isset($currentLocation) && Helpers::isOk($currentLocation)  ? $currentLocation->id :'')) :'javascript:void(0)'}}">
				{{$i}}
			</a>

		</div>

		@endfor
<!--@if(!isset($currentLocation) || Helpers::isNotOk($currentLocation))-->
		<!--@else

		@for($i=1; $i<=Config::get('var.stepsAdvert');$i++)

		<div class="step">

			<a role="button" {{isset($currentLocation) && ($currentLocation->register_step >= $i+5 || $currentLocation->register_step  == $i+4) ? 'style=cursor:pointer' : ''}} title="{{Config::get('var.stepsOwner_names')[$i]}}" class="tooltip-ui-n cnt  {{isset($currentLocation) && Config::get('var.stepsOwner_routes')[$i] == Route::current()->getName() ? 'current':(isset($currentLocation) && $currentLocation->register_step >= $i+5 ? 'done' :(isset($currentLocation) && $currentLocation->register_step  == $i-4 && Config::get('var.stepsOwner_routes')[$i] == Route::current()->getName() ? 'current' : ''))}}" href="{{isset($currentLocation) && ($currentLocation->register_step >= $i+5 || $currentLocation->register_step  == $i+4) ? route(Config::get('var.stepsOwner_routes')[$i], array(Auth::user()->slug, isset($building) ? $building->id:'', isset($currentLocation) && Helpers::isOk($currentLocation)  ? $currentLocation->id :'')) :'javascript:void(0)'}}">
				{{$i}}
			</a>

		</div>
		@endfor-->

		<!--@endif-->
	</div>
</div>
