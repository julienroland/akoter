   <section class="banner" role="banner">
    <div class="wrapper">
      <h2 class="section" role="heading" aria-level="2">{{trans('title.nav')}}</h2> 
      <nav class="nav" id="nav" role="navigation">
      <h3 class="section" role="heading" aria-level="3">{{trans('title.navigation')}}</h3>
        <a href="#main" tabindex="2" class="reader">{{trans('general.goContent')}}</a>
        <h4 aria-level="4" class="logo elem">
          <a tabindex="1" href="{{url(trans('routes.home'))}}"><span class="logo-img"><i class="section">Akoter</i></span></a>
        </h4>
        <span class="whatWeDo">{{trans('title.whatWeDo')}}</span>
        <div class="profilItem">
          <ul class="menu elem">

          @if(!Auth::check())
            <li class="register">
              <a class="" role="button" href="{{route('inscription_index')}}" tabindex="3">
                <span class="icon icon-create1"></span>{{trans('general.register')}} 
              </a>
            </li>
            @else
             <li class="profil">
              <a class="" role="button" href="{{route('account_home',Auth::user()->slug)}}" tabindex="3">
                <span class="icon icon-create1"></span>{{ucfirst(trans('routes.account'))}} 
              </a>
            </li>
            @endif
            @if(!Auth::check())
            <li class="connection">
              <a class="" role="button" href="{{route('connection')}}" data-type="connection" tabindex="4">
                <span class="icon icon-lock24"></span>
                {{ucfirst(trans('routes.connection'))}}
              </a>
            </li>
            @else
            <li class="disconnect">
              <a class="" role="button" href="{{route('disconnect',Auth::user()->slug)}}" tabindex="4">
                <span class="icon icon-lock24"></span>{{ucfirst(trans('routes.disconnect'))}}
              </a>
            </li>
            @endif

          </ul>
        </div>
        <div class="language">
           <a href="javascript:void(0)" tabindex="5" role="button" class="lang toPopup tooltip-ui-s" data-type="lang" role="button" title="{{trans('title.lang-choose')}}"><span class="flag flag-{{App::getLocale()}}"></span>{{trans('general.lang')[App::getLocale()]}}</a>
        </div>
      </nav>
    </div>
  </section>