@extends('layout.layout')

@section('container')

@if($validation)
@if(isset($user))
<p>Merci {{$user->first_name .' ' . $user->name}}, {{trans('validation.custom.valid')}}</p>


@else
<p>{{trans('validation.custom.valid')}}</p>
@endif
@else
@if(isset($message))
<p>{{$message}}</p>
@else
<p>{{trans('validation.custom.invalid')}}</p>
@endif
@endif
{{link_to(Lang::get('routes.index'),'Revenir à l\'accueil')}}

@stop