<div class="row">
	<div class="steps">

		@for($i=1; $i<=Config::get('var.steps');$i++)

		<div class="step ">

			<a title="{{Config::get('var.steps_names')[$i]}}" class="cnt {{isset($building) && $building->register_step >= $i ? 'done' :(isset($building) && $building->register_step  == $i-1 ? 'current' : '')}}" href="{{isset($building) && ($building->register_step >= $i || $building->register_step  == $i-1) ? route(Config::get('var.steps_routes')[$i],array(Auth::user()->slug, isset($building) ? $building->id:'')) :'javascript:void(0)'}}">
				{{Config::get('var.steps_names')[$i]}}
			</a>

		</div>

		@endfor
	</div>
</div>
