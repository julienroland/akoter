@extends('layout.email')

@section('content')

<?php $translation = $location->translation->lists('value','key'); ?>
Bonjour {{$user->first_name.' '.$user->name}},

Vous me seriez d'une grande aide si vous vouliez bien donner une appréciation à mon <a style="color:#F1842C;" href="{{route('showLocation', $translation['slug'])}}#comment-tab">logement nommée : {{$translation['title']}}</a>

D'avance je vous remercie et vous souhaite une bonne journée. 
<br>
<br>
{{Auth::user()->first_name.' '.Auth::user()->name}}

@stop