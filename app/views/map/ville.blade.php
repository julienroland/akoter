@extends('layout')

@section('container')
<div id="gmap"></div>
{{Form::label('map','Indiquez l\'addresse')}}
{{Form::text('zone','',array('id'=>'map','placeholder'=>'Rue code postal,ville'))}}
{{Form::label('distance','Indiquez le rayon du filtre (celui-ci est en mètre)')}}
{{Form::text('distance','',array('id'=>'distance','placeholder'=>'ex : 1000 pour 1km'))}}

{{ Form::button('Filtrer',array('id'=>'filtrer')) }}
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDHJ3p-sn1Y5tJGrzH9MF5cbR5sdsDmhfg&sensor=false&libraries=places"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/map.js"></script>
@stop