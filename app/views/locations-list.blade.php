  @foreach($location->translation as $translation)

  @if( $translation->key === 'title' )
  <?php $title = $translation->value; ?>
  @endif

  @if( $translation->key === 'slug' )
  <?php $slug = $translation->value; ?>
  @endif

  @endforeach

  <div class="kot prenium" itemscope itemtype="http://schema.org/Residence" data-id="{{$location->id}}">

    <a href="{{route('showLocation', $slug)}}" title="{{trans('locations.goTo',array('title'=>$title))}}">
      <div itemscope itemprop="geo" itemtype="GeoCoordinates"> 
        <meta content="{{Helpers::extractLatLng($location->building->latLng , 'lat')}}" itemprop="latitude">
        <meta content="{{Helpers::extractLatLng($location->building->latLng , 'lng')}}" itemprop="longitude">

      </div>
      <div class="mainInfos">
        <div class="photo">

          @if(isset($location->accroche[0]))
          <img itemprop="image" src="{{'/'.Config::get('var.images_dir').Config::get('var.users_dir').$location->building->user->id.'/'.Config::get('var.locations_dir').$location->id.'/'.Helpers::addBeforeExtension($location->accroche[0]->url, Config::get('var.img_medium'))}}" alt="{{trans('locations.photoOf',array('title'=>$title))}}">
          @else
          <img itemprop="image" width="184" height="184" src="{{Config::get('var.img_dir').Config::get('var.no_photoLocation')}}" alt="{{Lang::get('errors.no_location_image_alt')}}">
          @endif

        </div>  

        <div class="content"> 

          <h3 aria-level="3" itemprop="name" role="heading" class="titleKot">{{$title}}
          </h3>

          <span class="typeAndLocation">{{$location->typeLocation->translation[0]->value}} | <span itemprop="address" itemscope itemtype="PostalAddress"><span class="city" itemprop="addressRegion">{{$location->building->locality->name}}</span><span class="section" itemprop="streetAddress">{{$location->building->street}}</span>
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

         <div class="{{Helpers::toSlug($particularity->icon)}} spe tooltip-ui-n"  title="{{$particularity->translation[0]->value}}"></div> 
         @endforeach

       </div>

     </div>
     <div class="addInfos">
      <div class="muchRate">
        <div class="star" title="{{Helpers::getRating($location->rating)}} {{Lang::get('locations.stars')}}">
          <div class="icons" >
            <span class="section">{{Helpers::getRating($location->rating)}} {{Lang::get('locations.stars')}}</span>
            <span class="icon {{Helpers::isStar( 1, Helpers::getRating($location->rating) )}} " aria-hidden="true"></span>
            <span class="icon {{Helpers::isStar( 2, Helpers::getRating($location->rating) )}}" aria-hidden="true"></span>
            <span class="icon {{Helpers::isStar( 3, Helpers::getRating($location->rating) )}}" aria-hidden="true"></span>
            <span class="icon {{Helpers::isStar( 4, Helpers::getRating($location->rating) )}}" aria-hidden="true"></span>
            <span class="icon {{Helpers::isStar( 5, Helpers::getRating($location->rating) )}}" aria-hidden="true"></span>
          </div>
          <span class="number"><b>{{$location->nb_rate}}</b> {{Lang::get('locations.votes')}}</span>
        </div>
        <div class="howMuch {{$location->advert_specific == 0 &&  Helpers::isOk($location->nb_locations) && $location->nb_locations > 1 ? 'both' :''}}">

          @if($location->advert_specific == 0)
          <div class="seat">
           <span class="icon icon-user3"></span>
           <span class="peoples">
            @if($location->remaining_room > 1)

            <b>{{$location->remaining_room}}</b> {{Lang::get('locations.seats')}}
            @else
            <b>{{$location->remaining_room}}</b> {{Lang::get('locations.seat')}}   
            @endif
          </span>
        </div>
        @if(Helpers::isOk($location->nb_locations) )
        <div class="nb_locations">
          @if($location->nb_locations > 1)
          <span title="{{Lang::get('locations.nb_locations')}}" class="icon icon-longa"></span><b>{{$location->remaining_location}}</b> <span class="section">{{Lang::get('locations.nb_locations')}}</span>
            <!-- 
            <span title="{{Lang::get('locations.nb_location')}}" class="icon icon-longa"></span><b>{{$location->remaining_location}}</b> <span class="section">{{Lang::get('locations.nb_location')}}</span> -->
            @endif
          </div>
          @endif
          @else
          <div class="seat">
           <span class="icon icon-user3"></span>
           <span class="peoples">
             @if($location->remaining_room > 1)
             <b>{{$location->remaining_room}}</b> {{Lang::get('locations.seats')}}
             @else
             <b>{{$location->remaining_room}}</b> {{Lang::get('locations.seat')}}
             @endif

             @endif
           </span>
         </div>
       </div>
       <div class="priceLocation">

         @if($location->charge_type == 1)
         <div class="priceCharge">
           <span class="textPrice">{{Lang::get('locations.charge_of')}}</span>
           <span class="thePrice">
             {{round($location->charge_price).'€'}}
           </span>
         </div>
         @elseif($location->charge_type == 2)
         <span class="priceCharge add_info conso">
          {{Lang::get('locations.charges_conso')}}
        </span>
        @elseif($location->charge_type == 0)
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
 </a>

</div>

<!-- endkot -->