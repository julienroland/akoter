@extends('layout')

@section('container')

{{('Félicitation, vous avez été validé pour la chambre n°:'.$chambre)}}
{{link_to_route('showMonKot','Voir mon kot !')}}

@stop