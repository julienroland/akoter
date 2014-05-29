
<section class="map">
  {{Form::open(array('route'=> 'listLocation','method'=>'get','class'=>'mainType' ))}}
  <div class="mapContainer">

   <div class="loading">
     <div class="item"></div>
     <span class="loadingText">{{trans('general.loading')}}</span>
   </div>

   {{Form::text('','',array('id'=>'zoom','data-min'=>'7','data-max'=>'15','data-step'=>'1','autocomplete'=>'off','class'=>'tooltip-ui-s','title'=>trans('title.map.scroll')))}}

   <div class="mapItem">
     <div class="accordeon">
      <div class="handle icon icon-move6"></div>
      <div class="search stuff">
       <div class="head fastSearch">
         <h3 aria-level="3" role="heading" class="titleMap">{{trans('general.map_search')}}</h3>
       </div>
       <div class="content">

        <div class="errors none">
        </div>
        <div class="field">
          {{Form::label('form-city',ucfirst(trans('form.city')).':')}}
          <div class="icon-map54 input-city">
            {{Form::text('city','',array('tabindex'=>'4','id'=>'form-city','class'=>'form-city form-icon','placeholder'=>trans('form.locality')))}}
          </div>
        </div>
        <div class="field">
          {{Form::label('form-range',ucfirst(trans('form.range')).':',array('class'=>'label-range'))}}
          {{Form::text('range','',array('tabindex'=>'5','data-slider'=>'true','data-slider-step'=>'100','data-slider-range'=>'0,15000','data-slider-theme'=>'volume','data-slider-name'=>'range','id'=>'form-range','class'=>'form-range form-icon'))}}

        </div>
        <div class="field">
          <button role="button" class="send" id="filter">{{ucfirst(trans('form.filter'))}}</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="mapControls">
 <div class="tab">
   <a aria-label="{{trans('general.hide_panel')}}" role="button" href="javascript:void(0)" title="{{trans('general.hide_panel')}}" aria-hidden="true">
     <span aria-hidden="true" class="icon icon-prohibited1"></span>
   </a>
 </div>
 <ul>
   <li class="controlItem colorBlind"> 
     <a aria-label="{{trans('title.map.contrast')}}" role="button" class="tooltip-ui-e" href="javascript:void(0)" title="{{trans('title.map.contrast')}}">
       <span aria-hidden="true" class="icon icon-contrast"></span>
     </a>
   </li>
   <li class="controlItem streetView"> 
     <a aria-label="{{trans('title.map.streetView')}}" role="button" class="tooltip-ui-e" href="javascript:void(0)" title="{{trans('title.map.streetView')}}">
       <span aria-hidden="true" class="icon icon-person3"></span>
     </a>
   </li>
   <li class="controlItem showAllMarkerKot">
     <a aria-label="{{trans('title.map.allKots')}}" role="button" href="javascript:void(0)" class="tooltip-ui-e" title="{{trans('title.map.allKots')}}">
       <span aria-hidden="true" class="icon icon-location32"></span> 
     </a></li>

   </ul>
 </div>

 <div id="gmap">
 </div>
</div>


@include('map.mapManage')

{{Form::hidden('list','',array('id'=>'listKot'))}}
{{Form::close()}}
</section>