   <section class="banner" role="banner">
    <div class="wrapper">
      <h2 class="section" role="heading" aria-level="2">{{trans('title.nav')}}</h2> 
      <nav class="nav" id="nav" role="navigation">
        <a href="#main" class="reader">{{trans('general.goContent')}}</a>
        <h3 class="section" role="heading" aria-level="3">{{trans('title.navigation')}}</h3>
        <h3 aria-level="3" class="logo elem">
          <a href="{{url(trans('routes.home'))}}"><i class="logo-img"></i></a>
        </h3>
        <span class="whatWeDo">{{trans('title.whatWeDo')}}</span>
        <div class="profilItem">
          <ul class="menu elem">

          @if(!Auth::check())
            <li class="register">
              <a class="" href="{{route('inscription_index')}}" tabindex="1">
                <span class="icon icon-create1"></span>{{trans('general.register')}} 
              </a>
            </li>
            @else
             <li class="profil">
              <a class="" href="{{route('account_home',Auth::user()->slug)}}" tabindex="1">
                <span class="icon icon-create1"></span>{{ucfirst(trans('routes.account'))}} 
              </a>
            </li>
            @endif
            @if(!Auth::check())
            <li class="connection">
              <a class="" href="{{route('connection')}}" data-type="connection" tabindex="2">
                <span class="icon icon-lock24"></span>
                {{ucfirst(trans('routes.connection'))}}
              </a>
            </li>
            @else
            <li class="disconnect">
              <a class="" href="{{route('disconnect',Auth::user()->slug)}}" tabindex="2">
                <span class="icon icon-lock24"></span>{{ucfirst(trans('routes.disconnect'))}}
              </a>
            </li>
            @endif

          </ul>
        </div>
        <div class="language">
           <a href="" class="lang toPopup" data-type="lang" title="Changer de langue"><span class="flag flag-{{App::getLocale()}}"></span>{{trans('general.lang')[App::getLocale()]}}</a>
        </div>
      </nav>
    </div>
  </section>