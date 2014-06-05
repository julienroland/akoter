<div class="row">
	<div class="steps">

		@for($i=1; $i<=Config::get('var.steps');$i++)

		<div class="step ">

			<a role="button" title="{{Config::get('var.steps_names')[$i]}}" {{isset($building) && ($building->register_step >= $i || $building->register_step)  == $i-1 ? 'style=cursor:pointer' : ''}} class="tooltip-ui-n cnt {{isset($building) && Config::get('var.steps_routes')[$i] == Route::current()->getName() ? 'current' : (isset($building) && $building->register_step >= $i ? 'done' :(isset($building) && $building->register_step  == $i-1 && Config::get('var.steps_routes')[$i] == Route::current()->getName() ? 'current' : ''))}}" href="{{isset($building) && ($building->register_step >= $i || $building->register_step  == $i-1) ? route(Config::get('var.steps_routes')[$i],array(Auth::user()->slug, isset($building) ? $building->id:'')) :'javascript:void(0)'}}">
				{{$i}}
			</a>

		</div>

		@endfor
	</div>
</div>
