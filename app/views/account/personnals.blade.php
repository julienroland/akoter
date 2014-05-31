@extends('account.layout')

@section('account')

@if($user->count())

@include('includes.errors')
<div class="account-container">
	{{Form::open(array('route'=>array('save_personnal',Auth::user()->slug),'method'=>'put','class'=>'inlineType rules', 'data-rules'=>json_encode(User::$personnals_rules)))}}
	<fieldset>
		<legend>{{trans('acccount.infos_contact')}}</legend>


		<div class="field">
			{{Form::label('first_name',trans('form.first_name'))}}
			{{Form::text('first_name',isset($user->first_name) && !empty($user->first_name) ? $user->first_name :(Session::has('account_personnal')['first_name'] ? Session::get('account_personnal')['first_name']: ''),array('placeholder'=>trans('form.first_name'),'required', 'class'=>isset(Session::get('field')['first_name']) ? 'form-error':''))}}
			<i class="icon-required" aria-hidden="true"></i>
		</div>

		<div class="field">
			{{Form::label('name',trans('form.name'))}}
			{{Form::text('name',isset($user->name) && !empty($user->name) ? $user->name :(Session::has('account_personnal')['name'] ? Session::get('account_personnal')['name'] :''),array('placeholder'=>trans('form.name'),'required', 'class'=>isset(Session::get('field')['name']) ? 'form-error':''))}}
			<i class="icon-required" aria-hidden="true"></i>
		</div>

		<fieldset class="field born">
			<legend class="label">{{trans('form.born')}}:</legend>
			{{Form::input('number','day',isset(Helpers::createCarbonDate($user->born)->day) ? Helpers::createCarbonDate($user->born)->day : (Session::has('account_personnal') ? Session::get('account_personnal')['day']:''),array('required','placeholder'=>trans('inscription.born_day'),'min'=>1,'max'=>31,'id'=>'day','data-validator'=>'false'))}}

			{{Form::select('month',trans('general.month_select'),isset(Helpers::createCarbonDate($user->born)->month) ? Helpers::createCarbonDate($user->born)->month : (Session::has('account_personnal') ? Session::get('account_personnal')['month']:''),array('class'=>'select','data-placeholder'=>trans('inscription.born_month'),'id'=>'month','data-validator'=>'false'))}}

			{{Form::input('number','year',isset(Helpers::createCarbonDate($user->born)->year) ? Helpers::createCarbonDate($user->born)->year : (Session::has('account_personnal') ? Session::get('account_personnal')['year']:''),array('required','placeholder'=>trans('inscription.born_year'),'min'=>1900,'max'=>date('Y'),'id'=>'year'))}}
		</fieldset>

		<div class="field">
			{{Form::label('c0',trans('form.male'))}}
			{{Form::radio('civility',0,isset($user->civility) && $user->civility == 0 ? true: (Session::has('account_personnal') && Session::get('account_personnal')['civility'] == 0 ? true :false),array('id'=>'c0'))}}

			{{Form::label('c1',trans('form.female'))}}
			{{Form::radio('civility',1,isset($user->civility) && $user->civility == 1 ? true: (Session::has('account_personnal') && Session::get('account_personnal')['civility'] == 1 ? true :false),array('id'=>'c1'))}}
			<i class="icon-required" aria-hidden="true"></i>
		</div>

		<div class="field">
			{{Form::label('email',trans('form.email'))}}
			{{Form::email('email',isset($user->email) && !empty($user->email) ? $user->email :(Session::has('account_personnal') ? Session::get('account_personnal')['email'] :''),array('placeholder'=>'email@email.com','required', 'class'=>isset(Session::get('field')['email']) ? 'form-error':''))}}
			<i class="icon-required {{isset(Session::get('field')['email']) ? 'form-error':''}}" aria-hidden="true"></i>
		</div>

		<div class="field">
			{{Form::label('email_bc',trans('form.email_bc'))}}
			{{Form::email('email_bc',isset($user->email_bc) && !empty($user->email_bc) ? $user->email_bc :(Session::has('account_personnal') ? Session::get('account_personnal')['email_bc'] :''),array('placeholder'=>'email@email.com', 'class'=>isset(Session::get('field')['email_bc']) ? 'form-error':''))}}
		</div>

		<div class="field">
			{{Form::label('phone',trans('form.phone'))}}
			{{Form::input('tel','phone',isset($user->phone) && !empty($user->phone) ? $user->phone :(Session::has('account_personnal') ? Session::get('account_personnal')['phone'] :''),array('placeholder'=>'000000000','required', 'class'=>isset(Session::get('field')['phone']) ? 'form-error':''))}}
			<i class="icon-required" aria-hidden="true"></i>
		</div>

		<div class="field">
			{{Form::label('pro',trans('form.pro'))}}
			{{Form::checkbox('pro','1',isset($user->pro) && $user->pro == 1 ? true :(isset(Session::get('account_personnal')['pro']) && Session::get('account_personnal')['pro'] == 1 ? true :false))}}
			<p class="infos">{{trans('account.pro')}}</p>
		</div>

	</fieldset>
	<fieldset>
		<legend>{{trans('account.address')}}</legend>

		<div class="field">
			{{Form::label('address',trans('form.address'))}}
			{{Form::text('address',isset($user->address) && !empty($user->address) ? $user->address :(Session::has('account_personnal') ? Session::get('account_personnal')['address'] :''),array('class'=>'autocomplete','placeholder'=>'Basse-Montagne','required'))}}
			<i class="icon-required" aria-hidden="true"></i>
		</div>

		<div class="field">
			{{Form::label('locality',ucfirst(trans('form.city')))}}
			{{Form::text('locality',isset($user->locality->name) && !empty($user->locality->name) ? $user->locality->name :(Session::has('account_personnal') ? Session::get('account_personnal')['locality'] :''),array('class'=>'autocomplete','placeholder'=>'Ciney','required'))}}
			<i class="icon-required" aria-hidden="true"></i>
		</div>

		<div class="field">
			{{Form::label('region',trans('form.region'))}}
			{{Form::text('region',isset($user->region->translation[0]->value) && !empty($user->region->translation[0]->value) ? $user->region->translation[0]->value :(Session::has('account-personnal') ? Session::get('account-personnal')['region'] :''),array('class'=>'autocomplete','placeholder'=>'Namur','required'))}}
			<i class="icon-required" aria-hidden="true"></i>
		</div>

		<div class="field">
			{{Form::label('postal',trans('form.postal'))}}
			{{Form::text('postal',isset($user->postal) && !empty($user->postal) ? $user->postal :(Session::has('account-personnal') ? Session::get('account-personnal')['postal'] :''), array('class'=>'autocomplete','placeholder'=>'5100','required'))}}
			<i class="icon-required" aria-hidden="true"></i>
		</div>

	</fieldset>

	<div class="field">
	{{Form::submit(trans('form.save'),array('data-disabled'=>'Sauvegarde en cours ...'))}}
	</div>
	{{Form::close()}}

</div>

@endif

<div class="overlay"></div>
@stop
