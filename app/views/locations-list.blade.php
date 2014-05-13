
<div class="kot prenium" itemscope itemtype="http://schema.org/Residence" data-id="{{$location->id}}">
  <div itemscope itemprop="geo" itemtype="GeoCoordinates"> 
    <meta content="{{Helpers::extractLatLng($location->building->latLng , 'lat')}}" itemprop="latitude">
    <meta content="{{Helpers::extractLatLng($location->building->latLng , 'lng')}}" itemprop="longitude">

  </div>
  <div class="mainInfos">
    <div class="photo">

      <a href="" title="Voir l'annonce {{$location->location_title}}">
        @if(Helpers::isOk($location->photo))
        <img itemprop="image" src="{{Config::get('var.img_locations_dir').$location->photo}}" alt="{{trans('locations.photoOf',array('title'=>$title))}}">
        @else
        <img itemprop="image" src="{{Config::get('var.img_dir').Config::get('var.no_photoLocation')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">
        @endif
      </a>
    </div>

    <div class="content"> 
      @foreach($location->translation as $translation)

      @if( $translation->key === 'title' )
      <h3 aria-level="3" itemprop="name" role="heading" class="titleKot"><a href="" title="{{trans('locations.goTo',array('title'=>$translation->value))}}">{{$translation->value}}</a>
      </h3>

      @endif

      @endforeach


      <span class="typeAndLocation"><a href="" title="{{trans('see_typeAndLocation',array('city'=>$location->building->locality->name,'type'=>$location->typeLocation->translation[0]->value))}}">{{$location->typeLocation->translation[0]->value}} | <span itemprop="address" itemscope itemtype="PostalAddress"><span class="city" itemprop="addressRegion">{{$location->building->locality->name}}</span></a><span class="section" itemprop="streetAddress">{{$location->building->street}}</span>
      <meta content="{{$location->building->locality->postal}}" itemprop="postal">
      <meta content="BE" itemprop="addressCountry">
    </span></span>
        <!--   @foreach($location->translation as $translation)

          @if( $translation->key === 'description' )

          <p itemprop="description">

            {{$translation->value}}

          </p>

          @endif

          @endforeach -->
        </div>

        <div class="special">


         @foreach($location->particularity as $particularity)

         <div class="{{Helpers::toSlug($particularity->icon)}} spe"  title="{{Lang::get('seo.l_particularity_perso',array('stuff'=>$particularity->translation[0]->value))}}"></div> 
         @endforeach

       </div>

     </div>
     <div class="addInfos">
      <div class="muchRate">
        <div class="star" title="{{Helpers::getRating($location->rating)}} {{Lang::get('locations.stars')}}">
          <div class="icons" aria-hidden="true">
            <span class="section">{{Helpers::getRating($location->rating)}} {{Lang::get('locations.stars')}}</span>
            <span class="icon {{Helpers::isStar( 1, Helpers::getRating($location->rating) )}} "></span>
            <span class="icon {{Helpers::isStar( 2, Helpers::getRating($location->rating) )}}"></span>
            <span class="icon {{Helpers::isStar( 3, Helpers::getRating($location->rating) )}}"></span>
            <span class="icon {{Helpers::isStar( 4, Helpers::getRating($location->rating) )}}"></span>
            <span class="icon {{Helpers::isStar( 5, Helpers::getRating($location->rating) )}}"></span>
          </div>
          <span class="number"><b>{{$location->nb_rate}}</b> {{Lang::get('locations.votes')}}</span>
        </div>
        <div class="howMuch">
         <span class="icon icon-user3"></span>
         <span class="peoples">
           @if($location->remaining_room > 1)
           <b>{{$location->remaining_room}}</b> {{Lang::get('locations.seats')}}
           @else
           <b>{{$location->remaining_room}}</b> {{Lang::get('locations.seat')}}
           @endif
         </span>
       </div>
     </div>
     <div class="priceLocation">

       @if($location->charge_type === "1")
       <div class="priceCharge">
         <span class="textPrice">{{Lang::get('locations.charge_of')}}</span>
         <span class="thePrice">
           {{round($location->charge_price).'€'}}
         </span>
       </div>
       @else
       <span class="priceCharge add_info">
        {{Lang::get('locations.charges_included')}}
      </span>
      @endif
      <div class="priceLoyer">
       <span class="textPrice">{{Lang::get('locations.rent_of')}}</span>
       <div class="thePrice">{{round($location->price)}}€</div>
     </div>
   </div>
 </div>
</div>
<!-- endkot -->