<div class="popup lang" data-type="lang">
  <div class="contentPopup">
    <a href="" class="closePopup" tabindex="4" title="Fermer la fénêtre"></a>
    <div class="wrapper">
      <h4 aria-level="4" role="heading" class="titlePopup">{{trans('title.lang')}}</h4>
      <div class="lang-choice french {{Helpers::isCurrentLanguage( 'fr' )}}">
        <a href="/fr" title="Changer vers le Français" tabindex="1"><!-- {{Route::current()->prefix('fr')->uri()}} -->
          <span class="country-french flag"></span>
          <span class="country-text btn-nav">Français</span>
        </a>
      </div> 
      <div class="lang-choice neederlands {{Helpers::isCurrentLanguage( 'nl' )}}">
        <a href="/nl" title="Changer vers le Français" tabindex="2">
          <span class="country-neederlands flag"></span>
          <span class="country-text btn-nav">Neederlands</span>
        </a>
      </div>
      <div class="lang-choice english {{Helpers::isCurrentLanguage( 'en' )}}">
        <a href="{{url('/en')}}" title="Changer vers le Français" tabindex="3">
          <span class="country-english flag"></span>
          <span class="country-text btn-nav">English</span>
        </a>
      </div>
    </div>
  </div>
</div>
