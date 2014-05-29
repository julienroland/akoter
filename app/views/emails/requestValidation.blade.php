@extends('layout.email')

@section('content')


<h1 aria-level="1" role="heading">Akoter</h1>
<p>L'utilisateur {{$user->first_name.' '.$user->name}} aimerait que son compte (<a href="{{url('admin/users',$user->id)}}">{{$user->slug}}</a>) soit rapidement validé</p>


@stop