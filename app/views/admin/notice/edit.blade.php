@extends('admin.layout.layout')

@section('container')

	<div class="row">
	{{Form::open(array('url'=>array('admin/notice/store',$notice->id)))}}
		<div class="col-lg-8">

			@if(Session::has('success'))
			<div class="alert alert-success">
				{{Session::get('success')}}
			</div>
			@endif

		
			

		</div>
		<div class="col-lg-4">
			<p>Posté par : <a href="{{url('admin/user/show', $notice->user->id)}}">{{$notice->user->first_name.' '. $notice->user->name}}</a></p>
			<p>Crée le : {{Helpers::beTime($notice->created_at)}}</p>
			
				{{Form::close()}}
			</div>
		</div>
	</div>
@stop