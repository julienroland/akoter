@extends('account.owner.dashboard.layout')

@section('dashboard')

@if($location->building->register_step >= Config::get('var.steps'))
@if($location->validate == 0)
<div class="informations">{{trans('account.location_waiting_validation')}}</div>
@endif
@else
<div class="informations">
    {{trans('account.location_notcomplete',array('percent'=>Helpers::toPercent($location->building->register_step, Config::get('var.steps'))))}}
</div>
@endif

<div class="oneLocation">

    <div class="image">
        @if(Helpers::isOK($photo))
        <img class="thumbnail medium-img"
        src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').Auth::user()->id.'/'.Config::get('var.locations_dir').$location->id.'/'.Helpers::addBeforeExtension($photo->url, Config::get('var.img_medium'))}}"
        width="{{$photo->width}}" height="{{$photo->width}}"/>
        @else
        <img class="thumbnail medium-img" src="{{Config::get('var.img_dir')}}{{Config::get('var.no_photoLocation')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">
        @endif
    </div>
    <div class="infos">
        <h3>{{$location->translation->lists('value','key')['title']}}</h3>
        <span>{{$location->building->address}}</span>
    </div>
</div>
@stop