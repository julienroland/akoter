@extends('agence.layout')

@section('agence')

<div class="wrapper">
 <h3 aria-level="3" role="heading" class="titlePopup">{{trans('agence.agence')}}</h3>
 <p class="intro">
  {{trans('agence.intro')}}
</p>
{{Form::open(array('route'=>array('store_agence',Auth::user()->slug),'files'=>true,'method'=>'post','class'=>'inlineType rules agenceAjax', 'data-rules'=>json_encode(Agence::$rules)))}}

  <div class="field">
    {{Form::label('name',trans('agence.name'))}}
    {{Form::text('name','',array('placeholder'=>trans('agence.name'),'required', 'class'=>isset(Session::get('field')['name']) ? 'form-error':''))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('nb_employe',trans('agence.nb_employe'))}}
    {{Form::input('numeric','nb_employer','',array('placeholder'=>trans('agence.nb_employe'),'required', 'class'=>isset(Session::get('field')['nb_employe']) ? 'form-error':''))}}
  </div>

  <div class="field">
    {{Form::label('logo',trans('agence.logo').' (200 x 130)')}}
    {{Form::file('logo',array('placeholder'=>trans('agence.logo'),'required', 'class'=>isset(Session::get('field')['logo']) ? 'form-error':''))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div> 

  <div class="field">
    {{Form::label('login',trans('agence.login'))}}
    {{Form::text('login','',array('placeholder'=>trans('agence.login'),'required', 'class'=>isset(Session::get('field')['login']) ? 'form-error':''))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('password',trans('agence.password'))}}
    {{Form::password('password','',array('placeholder'=>trans('agence.password'),'required', 'class'=>isset(Session::get('field')['password']) ? 'form-error':''))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('password_ck',trans('agence.password_ck'))}}
    {{Form::password('password_ck','',array('placeholder'=>trans('agence.password_ck'),'required', 'class'=>isset(Session::get('field')['password_ck']) ? 'form-error':''))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field born">
    <span class="label">{{trans('agence.created')}}:</span>
    {{Form::input('number','day','',array('required','placeholder'=>trans('inscription.born_day'),'min'=>1,'max'=>31,'id'=>'day','data-validator'=>'false'))}}

    {{Form::select('month',trans('general.month_select'),'',array('class'=>'select','data-placeholder'=>trans('inscription.born_month'),'id'=>'month','data-validator'=>'false'))}}

    {{Form::input('number','year','',array('required','placeholder'=>trans('inscription.born_year'),'min'=>1500,'max'=>date('Y'),'id'=>'year'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('language',trans('agence.language'))}}
    {{Form::select('language',trans('general.lang'),'',array('class'=>'select','required'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('address',trans('agence.address'))}}
    {{Form::text('address','',array('class'=>'autocomplete','placeholder'=>'Basse-Montagne','required'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('locality',ucfirst(trans('agence.city')))}}
    {{Form::text('locality','',array('class'=>'autocomplete','placeholder'=>'Ciney','required'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('region',trans('agence.region'))}}
    {{Form::text('region','',array('class'=>'autocomplete','placeholder'=>'Namur','required'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('postal',trans('agence.postal'))}}
    {{Form::text('postal','', array('class'=>'autocomplete','placeholder'=>'5100','required'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>
  <div class="field">
    {{Form::submit(trans('form.add'))}}
  </div>
  {{Form::close()}}

</div>


@stop