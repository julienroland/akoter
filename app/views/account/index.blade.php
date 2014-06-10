@extends('account.layout')

@section('account')

@if(Auth::user()->isOwner == 1 || (Auth::user()->isOwner == 1 && Auth::user()->isTenant == 1))

@include('account.owner.index')

@elseif( Auth::user()->isTenant == 1 )

@include('account.tenant.index')

@else

@include('account.intro')

@endif

@stop