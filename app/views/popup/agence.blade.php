<div class="popup agence" data-type="agence">
  <div class="contentPopup">
    <a href="" class="closePopup icon-remove11" tabindex="4" title="{{trans('connections.close')}}"></a>
    <div class="wrapper">
     <h3 aria-level="3" role="heading" class="titlePopup">{{trans('agence.agence')}}</h3>
     <p class="intro">
      {{trans('agence.intro')}}
    </p>
    <div class="agence">
      {{Form::open(array('route'=>array('store_agence',Auth::user()->slug),'file'=>'true','method'=>'post','class'=>'inlineType rules agenceAjax', 'data-rules'=>json_encode(Agence::$rules)))}}

      <div class="field">
        {{Form::label('agence[name]',trans('agence.name'))}}
        {{Form::text('agence[name]','',array('placeholder'=>trans('agence.name'),'required', 'class'=>isset(Session::get('field')['name']) ? 'form-error':''))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div>

      <div class="field">
        {{Form::label('agence[nb_employe]',trans('agence.nb_employe'))}}
        {{Form::input('numeric','agence[nb_employer]','',array('placeholder'=>trans('agence.nb_employe'),'required', 'class'=>isset(Session::get('field')['nb_employe']) ? 'form-error':''))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div>

     <!--  <div class="field">
        {{Form::label('agence[logo]',trans('agence.logo'))}}
        {{Form::file('agence[logo]',array('placeholder'=>trans('agence.logo'),'required', 'class'=>isset(Session::get('field')['logo']) ? 'form-error':''))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div> -->

      <div class="field">
        {{Form::label('agence[login]',trans('agence.login'))}}
        {{Form::text('agence[login]','',array('placeholder'=>trans('agence.login'),'required', 'class'=>isset(Session::get('field')['login']) ? 'form-error':''))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div>

      <div class="field">
        {{Form::label('agence[password]',trans('agence.password'))}}
        {{Form::password('agence[password]','',array('placeholder'=>trans('agence.password'),'required', 'class'=>isset(Session::get('field')['password']) ? 'form-error':''))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div>

      <div class="field">
        {{Form::label('agence[password_ck]',trans('agence.password_ck'))}}
        {{Form::password('agence[password_ck]','',array('placeholder'=>trans('agence.password_ck'),'required', 'class'=>isset(Session::get('field')['password_ck']) ? 'form-error':''))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div>
      
      <div class="field born">
      <span class="label">{{trans('agence.created')}}:</span>
        {{Form::input('number','agence[day]',isset(Helpers::createCarbonDate($user->born)->day) ? Helpers::createCarbonDate($user->born)->day : (Session::has('account_personnal') ? Session::get('account_personnal')['day']:''),array('required','placeholder'=>trans('inscription.born_day'),'min'=>1,'max'=>31,'id'=>'day','data-validator'=>'false'))}}

        {{Form::select('agence[month]',trans('general.month_select'),isset(Helpers::createCarbonDate($user->born)->month) ? Helpers::createCarbonDate($user->born)->month : (Session::has('account_personnal') ? Session::get('account_personnal')['month']:''),array('class'=>'select','data-placeholder'=>trans('inscription.born_month'),'id'=>'month','data-validator'=>'false'))}}

        {{Form::input('number','agence[year]',isset(Helpers::createCarbonDate($user->born)->year) ? Helpers::createCarbonDate($user->born)->year : (Session::has('account_personnal') ? Session::get('account_personnal')['year']:''),array('required','placeholder'=>trans('inscription.born_year'),'min'=>1500,'max'=>date('Y'),'id'=>'year'))}}
      </div>

      <div class="field">
        {{Form::label('agence[language]',trans('agence.language'))}}
        {{Form::select('agence[language]',trans('general.lang'),'',array('class'=>'select','required'))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div>

      <div class="field">
        {{Form::label('agence[address]',trans('agence.address'))}}
        {{Form::text('agence[address]',isset($user->address) && !empty($user->address) ? $user->address :(Session::has('account_personnal') ? Session::get('account_personnal')['address'] :''),array('class'=>'autocomplete','placeholder'=>'Basse-Montagne','required'))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div>

      <div class="field">
        {{Form::label('agence[locality]',ucfirst(trans('agence.city')))}}
        {{Form::text('agence[locality]',isset($user->locality->name) && !empty($user->locality->name) ? $user->locality->name :(Session::has('account_personnal') ? Session::get('account_personnal')['locality'] :''),array('class'=>'autocomplete','placeholder'=>'Ciney','required'))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div>

      <div class="field">
        {{Form::label('agence[region]',trans('agence.region'))}}
        {{Form::text('agence[region]',isset($user->region->translation[0]->value) && !empty($user->region->translation[0]->value) ? $user->region->translation[0]->value :(Session::has('account-personnal') ? Session::get('account-personnal')['region'] :''),array('class'=>'autocomplete','placeholder'=>'Namur','required'))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div>

      <div class="field">
        {{Form::label('agence[postal]',trans('agence.postal'))}}
        {{Form::text('agence[postal]',isset($user->postal) && !empty($user->postal) ? $user->postal :(Session::has('account-personnal') ? Session::get('account-personnal')['postal'] :''), array('class'=>'autocomplete','placeholder'=>'5100','required'))}}
        <i class="icon-required" aria-hidden="true"></i>
      </div>
      {{Form::close()}}
    </div>
    
  </div>
</div>
</div>