@extends('account.layout')

@section('account')
<div class="account-container">
	<div class="how_be">
		<h2 aria-level="2" role="heading" class="accountTitle">{{trans('account.how_be_tenant')}}</h2>
		
		<div class="how_be_step {{$personnal ? ($personnal->count < $personnal->total ? 'notdone' :'done') : 'done'}}">
			<p>
				{{trans('inscription.how_be.profile')}}

				@if($personnal)

				<span class="informations">{{trans('account.required_percent', array('percent'=>Helpers::toPercent($personnal->count,$personnal->total,'diff')))}} </span>
				
				@else

				<span class="success">{{trans('account.stepDone')}}</span>

				@endif
			</p>
		</div>
		<div class="how_be_step {{Auth::user()->email_comfirm == 0 ? 'notdone' : 'done'}}">

			@include('includes.success')

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
		@include('includes.success')
			<p>
				{{trans('inscription.how_be.admin')}}
			</p>

			@if(Auth::user()->validate == 0)

			<a class="btn-inscription tooltip-ui-s" title="{{trans('inscription.how_be.request_validation_title')}}" href="{{route('requestValidation', Auth::user()->slug)}}">{{trans('inscription.how_be.request_validation')}}</a>

			@endif
		</div>
	</div>
</div>
@stop