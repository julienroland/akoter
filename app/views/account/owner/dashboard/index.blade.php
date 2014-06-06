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
    <div class="header">
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
            <h3 aria-level="3" role="heading" class="titleDashboard">{{$location->translation->lists('value','key')['title']}}</h3>
            <span>{{$location->building->address}}</span>
        </div>
    </div>
    <div class="actions">
       <!--  <div class="edit">
            <a class="icon icon-tools6 tooltip-ui-s" title="{{trans('locations.edit_location')}}" href="">

            </a>
        </div> -->
        <div class="{{$location->available == 1 ? 'activate' : 'desactivate'}}">
            @if($location->available == 1)
            <a class="icon icon-approve tooltip-ui-s" title="{{trans('locations.desactivate_location')}}" href="{{route('dashboard_desactivateLocation', array(Auth::user()->slug, $location->id))}}">
            </a>
            @else
            <a class="icon icon-remove11 tooltip-ui-s" title="{{trans('locations.activate_location')}}" href="{{route('dashboard_activateLocation', array(Auth::user()->slug, $location->id))}}">

            </a>
            @endif
        </div>
    </div>
    <div class="content">
        <div class="infosUsefull">
            <div class="reservation">
                <span class="icon icon-arrow"></span>
                @if($nb_requestMonth > 0)
                {{trans('dashboard.request', array('number'=>$nb_requestMonth))}}
                @else
                {{trans('dashboard.no_request')}}
                @endif
            </div>
            <div class="waitingTenantSoon">
                <span class="icon icon-calendar68"></span>
                @if($nb_tenantsMonth > 0)

                {{trans('dashboard.waitingTenant', array('number'=>$nb_tenantsMonth))}}

                @else

                {{trans('dashboard.noWaitingTenant')}}

                @endif 
            </div>
            <div class="requestLike">
                <span class="icon icon-speech76"></span>
                @if($nb_oldTenants <= 0 )

                {{trans('dashboard.neverTenants')}}

                @else 

                @if($nb_comments > 0)

                {{trans('dashboard.numberCommRequest',array('number'=>$nb_comments,'url'=>route('requestLike', array(Auth::user()->slug, $location->id))))}}

                @else

                {{trans('dashboard.noCommentYet',array('url'=>route('requestLike', array(Auth::user()->slug, $location->id))))}}

                @endif
                @endif

            </div>
        </div>
    </div>
</div>
@stop