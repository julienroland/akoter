@extends('agence.layout')

@section('agence')

<div class="wrapper">
 <h3 aria-level="3" role="heading" class="titlePopup">{{trans('agence.edit')}}</h3>

<div class="formContainer large">
@include('includes.errors')
@include('includes.success')
{{Form::open(array('route'=>array('update_agence', Auth::user()->slug, $agence->slug),'files'=>true,'class'=>'inlineType rules', 'data-rules'=>json_encode(Agence::$rules_update)))}}

  <div class="field">
    {{Form::label('name',trans('agence.name'))}}
    {{Form::text('name',isset($agence->name) ? $agence->name : '',array('placeholder'=>trans('agence.name'),'required', 'class'=>isset(Session::get('field')['name']) ? 'form-error':''))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('logo',trans('agence.logo'))}}
    {{Form::file('logo',array('placeholder'=>trans('agence.logo'), 'class'=>isset(Session::get('field')['logo']) ? 'form-error':''))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div> 

  <div class="field">
    {{Form::label('login',trans('agence.login'))}}
    {{Form::text('login',isset($agence->login) ? $agence->login : '',array('placeholder'=>trans('agence.login'),'required', 'class'=>isset(Session::get('field')['login']) ? 'form-error':''))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('password',trans('agence.password'))}}
    {{Form::password('password','',array('placeholder'=>trans('agence.password'), 'class'=>isset(Session::get('field')['password']) ? 'form-error':''))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('password_ck',trans('agence.password_ck'))}}
    {{Form::password('password_ck','',array('placeholder'=>trans('agence.password_ck'), 'class'=>isset(Session::get('field')['password_ck']) ? 'form-error':''))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field born">
    <span class="label">{{trans('agence.created')}}:</span>
    {{Form::input('number','day',isset($agence->created) ? explode('-',$agence->created)[2] : '',array('required','placeholder'=>trans('inscription.born_day'),'min'=>1,'max'=>31,'id'=>'day','data-validator'=>'false'))}}

    {{Form::select('month',trans('general.month_select'), isset($agence->created) ? explode('-',$agence->created)[1] : '',array('class'=>'select','data-placeholder'=>trans('inscription.born_month'),'id'=>'month','data-validator'=>'false'))}}

    {{Form::input('number','year',isset($agence->created) ? explode('-',$agence->created)[0] : '',array('required','placeholder'=>trans('inscription.born_year'),'min'=>1500,'max'=>date('Y'),'id'=>'year'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('language',trans('agence.language'))}}
    {{Form::select('language',trans('general.lang'),isset($agence->language_id) ? $agence->language_id : '',array('class'=>'select','required'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('address',trans('agence.address'))}}
    {{Form::text('address',isset($agence->address) ? $agence->address : '',array('class'=>'autocomplete','placeholder'=>'Basse-Montagne','required'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('locality',ucfirst(trans('agence.city')))}}
    {{Form::text('locality',isset($locality)  ?  $locality :'',array('class'=>'autocomplete','placeholder'=>'Ciney','required'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('region',trans('agence.region'))}}
    {{Form::text('region',isset($region)  ?  $region :'',array('class'=>'autocomplete','placeholder'=>'Namur','required'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>

  <div class="field">
    {{Form::label('postal',trans('agence.postal'))}}
    {{Form::text('postal',isset($agence->postal) ? $agence->postal : '', array('class'=>'autocomplete','placeholder'=>'5100','required'))}}
    <i class="icon-required" aria-hidden="true"></i>
  </div>
  <div class="field">
    {{Form::submit(trans('form.add'))}}
  </div>
  {{Form::close()}}

</div>
</div>

@stop