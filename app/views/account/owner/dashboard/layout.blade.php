@extends('account.layout')

@section('account')
<div class="dashboard">
    @include('account.owner.dashboard.menu')
    @yield('dashboard')
</div>
@stop