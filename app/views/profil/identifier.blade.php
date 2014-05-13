@extends('layout')

@section('container')
@if(isset($errorMessages))
<div class="error">
@foreach($errorMessages->all() as $message)
<span>{{$message}}</span>
@endforeach
</div>
@endif
{{Form::open(array('url'=>'identifier'))}}

{{Form::label('email','Entrez votre email')}}
{{Form::text('email','',array('placeholder'=>'email@gmail.com'))}}

{{Form::label('password','Entrez votre mot de passe')}}
{{Form::password('password','')}}

{{Form::submit('Se connecter')}}

{{Form::close()}}
{{link_to_route('showInscription','Pas encore de compte ? Inscrivez-vous')}}

@stop