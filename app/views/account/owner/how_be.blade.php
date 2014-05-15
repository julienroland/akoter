@extends('account.layout')

@section('account')
<div class="account-container">
	<div class="how_be_owner">
		<h2 aria-level="2" role="heading" class="accountTitle">{{trans('account.how_be_owner')}}</h2>

		<div class="first owner_step {{$personnalNotComplete ? ($personnalNotComplete->count < $personnalNotComplete->total ? 'notdone' :'done') : ''}}">
			<p>
				{{trans('inscription.how_be_owner.first')}}

				@if($personnalNotComplete)

				<span class="informations">{{trans('account.required_percent', array('percent'=>Helpers::toPercent($personnalNotComplete->count,$personnalNotComplete->total,'diff')))}} </span>
				
				@endif
			</p>
			<a href="{{route('account_personnal', Auth::user()->slug)}}" class="btn-inscription">{{trans('account.completeProfile')}}</a>
		</div>
		<div class="second owner_step notdone">
			<p>
				{{trans('inscription.how_be_owner.second')}}
			</p>
			<a href="{{route('index_localisation_building', Auth::user()->slug)}}" class="btn-inscription">{{trans('account.registerLocation')}}</a>
		</div>
		<div class="third owner_step notdone">
			<p>
				{{trans('inscription.how_be_owner.third')}}
			</p>

		</div>
		<div class="fourth owner_step notdone">
			<p>
				{{trans('inscription.how_be_owner.fourth')}}
			</p>
		</div>			

	</div>
</div>
@stop