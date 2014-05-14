@include('layout.head')

<h1 class="section" role="heading" aria-level="1">{{trans('seo.h1_base')}}</h1>

@if(isset($page) && ($page !== 'connection' && $page !== 'contact'))

@include('layout.nav')

@endif

@if(Auth::guest())

@if(isset($page) && ($page !== 'connection' ))

@include('popup.connection')

@endif

@endif

@include('popup.lang')

<div class="container">
	@yield('container')
</div>

<div class="overlay" aria-hidden="true"></div>

@include('layout.footer')

@include('layout.bottom')