@extends('layout')

@section('container')

<?php var_dump($annonce); ?>
<p>{{$annonce->titre}}</p>
<p>{{$annonce->description}}</p>	
{{('Ajouter aux favoris')}}
{{('Contacter')}}
{{Form::open(array('url'=>'annonce/'.$annonce->id.'/valider'))}}
{{Form::label('chambre','Se porte candidat pour la chambre')}}
@for($i=1;$i<=$annonce->nb_chambre;$i++)

{{Form::label('chambre'.$i.'','n°:'.$i.'')}}
{{Form::radio('chambre',$i,false,array('id'=>'chambre'.$i))}}

@endfor
{{Form::hidden('id',$annonce->id)}}
{{Form::submit('Valider')}}


{{Form::close()}}

@stop