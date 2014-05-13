@extends('layout')

@section('container')

@if(isset($rechercheEnregistre))

@foreach($rechercheEnregistre as $recherche)

 <?php $rechercheForm = json_decode($recherche->rechercheEnregistre,true);?>
<table>
	<tr>
		<th>
			{{('Nom de la recherche')}}
		</th>
		<th>
			{{$recherche->nom}}
		</th>
	</tr>
	<tr>
		<td>
			{{('Le type de recherche')}}
		</td>
		<td>
			{{$rechercheForm['type']}}
		</td>
	</tr>
	<tr>
		<td>
			{{('Le loyer maximun')}}
		</td>
		<td>
			{{$rechercheForm['loyer_max'].' €'}}
		</td>
	</tr>
	<tr>
		<td>
			{{('Le loyer minimun')}}
		</td>
		<td>
			{{$rechercheForm['loyer_min'].' €'}}
		</td>
	</tr>
	<tr>
		<td>
			{{('Les charges')}}
		</td>
		<td>
			{{$rechercheForm['charges']}}
		</td>
	</tr>
	<tr>
		<td>
			{{('La region ciblé')}}
		</td>
		<td>
			{{$rechercheForm['zone']}}
		</td>
	</tr>
	<tr>
		{{('Le rayon de recherche')}}
		<td>
			{{$rechercheForm['distance'].' m'}}
		</td>
		
		
	</tr>
</table>


@endforeach
@endif

@stop