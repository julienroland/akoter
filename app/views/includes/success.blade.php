@if(Session::has('success'))

<div class="success">

	{{Session::get('success')}}
	
</div>

@endif