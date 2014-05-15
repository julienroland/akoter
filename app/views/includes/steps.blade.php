<div class="row">
	<div class="steps">

		@for($i=1; $i<=Config::get('var.steps');$i++)

		<div class="step ">

			<a class="cnt {{Session::get('inscription.current') >= $i ? 'done' :''}}" href="{{Session::get('inscription.current') >= $i ? route(Config::get('var.steps_routes')[$i],array(Auth::user()->slug, isset($building) ? $building->id:'')) :'javascript:void(0)'}}">
				{{Config::get('var.steps_names')[$i]}}
			</a>

		</div>

		@endfor
	</div>
</div>
