@extends('account.layout')

@section('account')

@if($user->isOwner == 1)

@include('account.owner.index')

@else

@include('account.intro')

@endif

@stop