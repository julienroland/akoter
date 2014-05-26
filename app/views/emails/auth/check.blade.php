@extends('layout.email')

@section('content')
	{{App::setLocale(Config::get('var.lang')[$user->language_id])}}
		<h1>Akoter</h1>
        <p>Bonjour {{$user->first_name}}</p>
        <p>Validatez votre email en cliquant sur ce lien: <a href="{{url('activation/'.$key)}}">{{url('activation/'.$key)}}</a></p>
@stop