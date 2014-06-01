@include('layout.head')

@if(isset($page) && $page == 'advert')

<h2 class="section" role="heading" aria-level="2">{{trans('seo.h1_base')}}</h2>

@else

<h1 class="section" role="heading" aria-level="1">{{trans('seo.h1_base')}}</h1>

@endif

@if(isset($page))

@include('layout.nav')

@endif

@if(Auth::guest())

@if(isset($page) && ($page !== 'connection' ))

@include('popup.connection')

@endif

@endif

@include('popup.lang')

<main class="container" id="main">

	@yield('container')
	
</main>

<div class="overlay" aria-hidden="true"></div>

@include('layout.footer')

@include('layout.bottom')