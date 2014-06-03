@extends('account.layout')

@section('account')
<div class="account-container">
	<div class="how_be">
		<h2 aria-level="2" role="heading" class="accountTitle">{{trans('account.how_be_owner')}}</h2>
<!-- <div class="intro">Tant que les étapes requisent n'ont pas été faites, vos logements ne pourront être visible pour les autres utilisateurs</div> -->
		<div class="how_be_step {{$personnal ? ($personnal->count < $personnal->total ? 'notdone' :'done') : 'done'}}">
			<p>
				{{trans('inscription.how_be.profile')}}

				@if($personnal)

				<span class="informations">{{trans('account.required_percent', array('percent'=>Helpers::toPercent($personnal->count,$personnal->total,'diff')))}} </span>
				
				@else

				<span class="success">{{trans('account.stepDone')}}</span>

				@endif
			</p>
			@if($personnal)
			<a href="{{route('account_personnal', Auth::user()->slug)}}" class="btn-inscription">{{trans('account.completeProfileBtn')}}</a>
			@endif
		</div>
		<div class="how_be_step {{Auth::user()->email_comfirm == 0 ? 'notdone' : 'done'}}">

			<p>
				{{trans('inscription.how_be.email')}}
			</p>

			@if(Auth::user()->email_comfirm == 0)

			<a href="{{route('checkEmail', Auth::user()->slug)}}" class="btn-inscription">{{trans('account.validateEmail')}}</a>

			@else

			<span class="success">{{trans('account.stepDone')}}</span>

			@endif
		</div>
		<div class="how_be_step {{Auth::user()->validate == 0 ? 'notdone' : 'done'}}">
			<p>
				{{trans('inscription.how_be.admin')}}
				@if(Auth::user()->validate == 0)

				<a class="btn-inscription tooltip-ui-s" title="{{trans('inscription.how_be.request_validation_title')}}" href="{{route('requestValidation', Auth::user()->slug)}}">{{trans('inscription.how_be.request_validation')}}</a>

				@endif
			</p>
		</div>
		<div class="how_be_step {{Auth::user()->building()->get()->count() ? 'done' :'notdone'}}">
			<p>
				{{trans('inscription.how_be.location')}}
			</p>

			<a href="{{route('index_localisation_building', Auth::user()->slug)}}" class="btn-inscription">{{trans('account.registerLocation')}}</a>
		</div>
		<div class="how_be_step">
			<p>
				{{trans('inscription.how_be.admin_location')}}
			</p>

		</div>
		<div class="how_be_step">
			<p>
				{{trans('inscription.how_be.done')}}
			</p>
		</div>			

	</div>
</div>
@stop