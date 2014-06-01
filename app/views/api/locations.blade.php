@extends('api.layout')

@section('doc')
<div class="jumbotron">
<h1 aria-level="1" role="heading">Locations method</h1>
</div>

<h2 id="all">Get all valid locations</h2>
<p>
	Method all will retrieve all locations, here is how to use with jQuery $.ajax
</p>
<div class="bs-example">
<pre class="prettyprint">
	<code>

		$.ajax({
			url:"http://akoter/api/location/all",
			dataType: "json",
			type:"get",
			success:function(oData){
				console.log(oData);
			}
		});

	</code>
</pre>
</div>

<h2 id="in">Get locations from array of id</h2>
<p>
	Method in will retrieve locations of spécifique id (reference)
</p>
<div class="bs-example">
<pre class="prettyprint">
	<code>
		var jsonData = [1,3,4,423,432];
			$.ajax({
				url:"http://akoter/api/location/in",
				dataType: "json",
				data:{locationsArray : jsonData},
				type:"get",
				success:function(oData){
					console.log(oData);
				}
			});

	</code>
</pre>
</div>

<h2 id="in">Get locations with limit </h2>
<p>
	Method in will retrieve a defined number of locations 
</p>
<div class="bs-example">
<pre class="prettyprint">
	<code>
		/**
		 *
		 * @param integer
		 *
		 **/

		$.ajax({
			url:"http://akoter/api/location/get/20",
			dataType: "json",
			type:"get",
			success:function(oData){
				console.log(oData);
			}
		});

	</code>
</pre>
</div>

@stop