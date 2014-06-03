@extends('account.layout')

@section('account')

@include('agence.nav')
<div class="agence-container">
	@yield('agence')
</div>

@stop