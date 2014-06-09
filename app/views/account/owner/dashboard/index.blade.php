@extends('account.owner.dashboard.layout')

@section('dashboard')

@if($location->building->register_step >= Config::get('var.steps'))
@if($location->validate == 0)
<div class="informations-row">
    <div class="informations">{{trans('account.location_waiting_validation')}}</div>
</div>
@endif
@else
<div class="informations-row">
    <div class="informations">
        <div class="circle" id="circles-1" data-percent="{{Helpers::toPercent($location->building->register_step, Config::get('var.steps'))}}"></div>
        <div class="circle-text">
            {{trans('account.location_notcomplete',array('url'=>route('index_inscription_adverts',array(Auth::user()->slug, $location->building->id, $location->id)),'percent'=>
            Helpers::toPercent($location->building->register_step, Config::get('var.steps'))))}}
        </div>
    </div>
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

            <h3 aria-level="3" role="heading" class="titleDashboard">{{$location->translation->count() > 0 ? $location->translation->lists('value','key')['title']:trans('dashboard.no_title')}}</h3>
            <span>{{$location->building->address}}</span>
            <span>{{trans('locations.ref', array('ref'=>$location->id))}}</span>
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

                @if($nb_oldTenants <= 0 )
                <span class="icon icon-key105"></span>
                {{trans('dashboard.neverTenants', array('url'=>route('indexPostOwner')))}}

                @else 
                <span class="icon icon-speech76"></span>
                @if($nb_comments > 0)

                {{trans('dashboard.numberCommRequest',array('number'=>$nb_comments,'url'=>route('requestLike', array(Auth::user()->slug, $location->id))))}}

                @else

                {{trans('dashboard.noCommentYet',array('url'=>route('requestLike', array(Auth::user()->slug, $location->id))))}}

                @endif
                @endif

            </div>
            <div class="view">
                <span class="icon icon-view6">{{trans('locations.views', array('number'=>$location->nb_views))}}</span>
            </div>
            <div class="rating">
                <div class="icons rating tooltip-ui-w" title="{{Helpers::getRating($location->rating)}} {{Lang::get('locations.stars')}} {{trans('general.on')}} {{trans('locations.nb_vote',array('number'=>$location->nb_rate))}}">
                    <span class="section">{{Helpers::getRating($location->rating)}} {{Lang::get('locations.stars')}}</span>
                    <span class="icon {{Helpers::isStar( 1, $location->rating )}} " aria-hidden="true"></span>
                    <span class="icon {{Helpers::isStar( 2, $location->rating )}}" aria-hidden="true"></span>
                    <span class="icon {{Helpers::isStar( 3, $location->rating )}}" aria-hidden="true"></span>
                    <span class="icon {{Helpers::isStar( 4, $location->rating )}}" aria-hidden="true"></span>
                    <span class="icon {{Helpers::isStar( 5, $location->rating )}}" aria-hidden="true"></span>
                </div>
            </div>
        </div>
    </div>
</div>
@stop