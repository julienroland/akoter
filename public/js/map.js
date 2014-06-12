
//ERROR; 
/*
 ID:1(geocoder) = aucun résultat trouvé ,
 ID:2(geocoder) = requete non-autorisée, 
 ID:3(geocoder) = requete invalide, 
 ID:4(geocoder) = error interne
 ID:5(range) = Uniquement des chiffres autorisés
 */
 ;(function($){
 	if (typeof google === 'object' && typeof google.maps === 'object') {
 		"use strict";
       //GENERAL
       var
       gMap,
       sImgDir = '/img/',
       sBuildingDir = '/images/users/:user_id/buildings/:building_id/',
       sLocationDir = '/images/users/:user_id/locations/:location_id/',
        //ICONS
        kotIcon = sImgDir+'map/markers/kot.png',
        schoolIcon = sImgDir+'map/markers/school.png',
        targetIcon = sImgDir+'map/markers/target.png',
        //MAP
        panorama,
        oLang,
        jsStandardMapStyle = [{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"},{"lightness":20}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#a1cdfc"},{"saturation":30},{"lightness":49}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"hue":"#f49935"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"hue":"#fad959"}]}],
        jsColorBlindMapStyle = [ {"featureType": "administrative.country","elementType": "geometry.stroke","stylers": [{ "color": "#00006f" },{ "lightness": -5 },{ "visibility": "on" },{ "weight": 3 },{ "hue": "#ff0091" }]},{"featureType":"all","elementType":"all","stylers":[{"invert_lightness":true},{"saturation":0},{"lightness":25},{"gamma":0.6},{"hue":"#435158"}]}],
        gMarkerArrayKot = [],
        gMarkerArraySchool = [],
        gMarkerKot,
        gMarkerEcole,
        gCenter = new google.maps.LatLng(50.5,4.6),
        oKots,
        nDistanceValueOk,
        oEcoles,
        bSchoolClick =false,
        aKots = [],
        oSchools = [],
        gSchool = new google.maps.LatLng(),
        sNom = [],
        sCachet,
        cityCircle = new google.maps.Circle(),
        rectangle = new google.maps.Rectangle(),
        listKot = [],
        $listKot = $('#listKot'),
        listEcole = [],
        regLatLng = new RegExp("[,]"),
        geocoder = new google.maps.Geocoder(),
        oRayon,
        nMinZoom = 7,
        gMarker = new google.maps.Marker({icon : targetIcon}),
        gSpherical = google.maps.geometry.spherical,
        sCity = document.getElementById('form-city'),
        sRange = document.getElementById('form-range'),
        $city = $('#form-city'),
        $range = $('#form-range'),
        $l_range = $('.label-range'),
        optionsPlaces = {types: ['geocode'],componentRestrictions: {country:"be"},setTypes: ['geocode']},
        gPlaceAutoComplete,
        isAutoComplete = false,
        gCurrentPlace,
    //key
    nUp = 38,
    nDown = 40,
    nLeft = 37,
    nRight = 39,
  //FORM
  $submit = $('.mapItem input[type="submit"]'),
  sOldValue,
  sCenterCity,
  gCenterCity,
  nDistanceValueOk,
  $listingBtn = $('.ListingBtn'),
  $slider = $('#slider'),
  $pager = $('#slider-pager'),
  $listLocations = $('.typeLocationList ul'),

  //SELECTOR
  $loading = $('.loading'),
  $filter = $('#filter'),
  $zoom = $('#zoom'),
  $mapItem = $('.mapItem'),
  $mapItemTab = $('.mapItem .tab'),
  mc,
  mcSchool,
    //ERRORS
    $errorsNotifications = $('.errorsNotifications'),
    $errorsNotificationsAppend = $('.errorsNotifications .list'),
    sErrorsNotifcationOutput = '<li class="notSee" data-id=":id"><a href=""><div class="iconError"><img src=":icon"></img></div><span class="textError">:message</span></a></li>',
    sErrorsTitle = '<span class="numberTitle">:number</span> problème(s) rencontré(s)',
    $errorsTab = $('.errorsNotifications .tab'),
    bErrorsTabStatus = 0,

    //ANIMATIONS
    sAnimationEvent = 'animated',
    //CLUSTER
    clusterStyleKot = [
    {
    	opt_textColor: 'white',
    	url: sImgDir+'map/clusters/kot/small.png',
    	height: 30,
    	width: 30
    },
    {
    	opt_textColor: 'white',
    	url: sImgDir+'map/clusters/kot/medium.png',
    	height: 45,
    	width: 45
    },
    {
    	opt_textColor: 'white',
    	url: sImgDir+'map/clusters/kot/big.png',
    	height: 60,
    	width: 60
    }
    ],
    clusterStyleSchool = [
    {
    	opt_textColor: 'white',
    	url: sImgDir+'map/clusters/school/small.png',
    	height: 30,
    	width: 30
    },
    {
    	opt_textColor: 'white',
    	url: sImgDir+'map/clusters/school/medium.png',
    	height: 45,
    	width: 45
    },
    {
    	opt_textColor: 'white',
    	url: sImgDir+'map/clusters/school/big.png',
    	height: 60,
    	width: 60
    }
    ],

    //CONTROL
    $showMarkersKot = $('.showAllMarkerKot'),
    bShowAllKot,
    $colorBlind = $('.colorBlind'),
    $streetView = $('.streetView'),
    jsStyledMap,
    bColorBlindOn;

    $(function(){

      /**
      *
      * Street view
      *
      **/
      
      $streetView.on( 'click', 'a', toggleStreetView );

      /**
      *
      * Range Append for data
      *
      **/
      
      $('#form-range').on('change', displayDataRange );

      /**
      *
      * Change zoom on scroll or keyup and down
      *
      **/
      
      $zoom.bind("mousewheel", changeZoom);

      $zoom.on("keydown", changeZoom);

      /**
      *
      * On click on html, hide popup
      *
      **/
      $('html').on('click', hidePopup );

      /**
      *
      * On click on colorblind button, change map stype
      *
      **/
      
      $colorBlind.on('click','a',toogleMapStyle );

      /**
      *
      * On click on showAllMarker button, show all marker
      *
      **/
      
      $showMarkersKot.on('click','a',showAllMarkerKot);

    });

    /**
    *
    * When google map is loaded
    *
    **/
    
    var initialize = function(){
    	/**
    	*
    	* Get traductions
    	*
    	**/
    	getTraductions();
      /**
      *
      * Display map
      *
      **/
      
      displayGoogleMap();

      /**
      *
      * Hidding map on listing page
      *
      **/
      
      $('#locations .map').css('display','none');
      /**
      *
      * Preload street view
      *
      **/
      
      displayStreetView( new google.maps.LatLng(50.5,4.6) );

      /**
      *
      * Display map item
      *
      **/
      
      $mapItem.css('display','block');

      /**
      *
      * Get locations and schools with ajax
      *
      **/

      ajaxAllSchool();

      ajaxAllKot();

      /**
      *
      * Loading google autoComplete
      *
      **/
      
      gPlaceAutoComplete = new google.maps.places.Autocomplete(sCity,optionsPlaces);

      /**
      *
      * When it's done, hide loading state
      *
      **/
      
      $loading.delay(400).fadeOut( function(){

      	$(this).remove();

      });

      eventInput();

      /**
      *
      * @change autocomplete
      *
      **/
      
      google.maps.event.addListener(gPlaceAutoComplete, 'place_changed', function() {

    /**
    *
    * Set autocomplete on true to avoid bug with other filter systems
    *
    **/
    
    isAutoComplete = true;

    /**
    *
    * Get place of element targeted
    *
    **/
    
    var place = gPlaceAutoComplete.getPlace();

    if (!place.geometry){

    	return;

    }

    /**
    *
    * Get lat & lng
    *
    **/
    
    var center = place.geometry.location;

    /**
    *
    * Change map position
    *
    **/
    
    gMap.panTo(center);

    smoothZoom(gMap, 14, gMap.getZoom());

    gMarker.setPosition( center );

    gMarker.setMap( gMap );

    /**
    *
    * Define globaly currentPlace for streetView
    *
    **/
    
    gCurrentPlace = center;

    /**
    *
    * Get distance
    *
    **/
    
    nDistanceValueOk = Number(sRange.value);

    /**
    *
    * @if distance not number, generate an error message (id 5)
    *
    **/
    
    if(!$.isNumeric(nDistanceValueOk))
    {

    	var id = 5;
    	var sMessage = oLang.map.range_required;
    	var sIcon = sImgDir+"reseaux/fb.jpg";

    	e_errorNotification(id, sMessage, sIcon );
    }   

   /**
   *
   * Define globaly the center
   *
   **/
   
   sCenterCity = center;

   window.setTimeout(function(){
   	$city.val(place.address_components[0].long_name);
   }, 10);
   
   if(bSchoolClick)
   {
   	actionEcoleClick( nDistanceValueOk );
   }
   else
   {
    /**
    *
    * getCity( latLng, range, type = "geocoder", callback)
    *
    **/
    
    getCity( sCenterCity , nDistanceValueOk , "latlng", function( bType, sMessage ){

      /**
      *
      * @if no range define, generate tutorial
      *
      **/
      
      if(bType){

      	gCenterCity  = sMessage;

        /**
        *
        * On filter loading, change submit to disabled to prevent spam
        *
        **/
        
        processSubmit( $submit, 0 );

        if($range.next().hasClass('tuto')){

        }else{

        	if($range.next().hasClass('messageTuto')){

        	}else{

        		$range.after('<span class="range messageTuto">'+oLang.map.you_can_change_range+'</span>');
        	}
        }

      }else{

       processSubmit( $submit, 0 );

     }
   });

  }
});


/* FORM */


/* END FORM*/
/*introJs().start();*/

};

/**
*
* On click on html, hide popup
*
**/

var hidePopup = function( e ){

/**
*
* Stop la propagation
*
**/

e.stopPropagation();

/**
*
* @if errors is display, hide 
*
**/

if(bErrorsTabStatus === 1 ){

	$errorsNotifications.css({
		right:"-250px",
	});

	bErrorsTabStatus = 0;
}
};

/**
*
* Range Append for data
*
**/

var displayDataRange = function(){
    /**
    *
    * @if range > 999 display it on kilometers type else on meters
    *
    **/
    
    if($(this).val()>999){

    	$l_range.html('Distance: '+($(this).val()/1000)+'km');

    }else{

    	$l_range.html('Distance: '+$(this).val()+'m');
    }

  };

/**
*
* Change zoom using input #zoom using scroll or keyup & keydown
*
**/

var changeZoom = function(event, delta ){

  /**
  *
  * Get basic data
  *
  **/
  
  var nMin = Number($zoom.attr('data-min'));
  var nMax = Number($zoom.attr('data-max'));
  var nStep = Number($zoom.attr('data-step'));

  /**
  *
  * @if it's scroll
  *
  **/
  
  if(event.type ==="mousewheel"){
    /**
    *
    * @if zoom use positively (scrollup)
    *
    **/
    
    if (delta > 0 ) {

    	if(this.value){

        /**
        *
        * @if not higher than max value
        *
        **/
        
        if(this.value < nMax) {

          /**
          *
          * get value, increment by one step
          *
          **/
          
          this.value = parseInt(this.value) + nStep;

          /**
          *
          * define zoom
          *
          **/
          
          gMap.setZoom( Number(this.value) ); 

          /**
          *
          *  change cursor to show that we can go higher or
          *
          **/

          $zoom.css('cursor','ns-resize');

        }
        else
        {

          /**
          *
          * We are on maximun, so only show cursor for going less
          *
          **/
          
          $zoom.css('cursor','s-resize');
        } 

      }
      else{

        /**
        *
        * @if no value, that mean it's the first use, define base on min-zoom
        *
        **/

        this.value = parseInt( nMin );

        /**
        *
        * Define zoom
        *
        **/
        
        gMap.setZoom( Number(this.value ));

        /**
        *
        * Show cursor that we only can go higher
        *
        **/
        
        $zoom.css('cursor','n-resize');

      }
    } 
    else{
      /**
      *
      * @if higher than min
      *
      **/
      
      if (parseInt(this.value) > nMin ) {

        /**
        *
        * decrement step
        *
        **/
        
        this.value = parseInt(this.value) - nStep;
        /**
        *
        * Define zoom
        *
        **/
        
        gMap.setZoom( Number(this.value ));

        /**
        *
        * Show that we can go higher and lower
        *
        **/
        
        $zoom.css('cursor','ns-resize');
      }
      else{

        /**
        *
        * We are on min, show that we only can go higher
        *
        **/
        
        $zoom.css('cursor','n-resize');
      } 
    }
  }
  else if(event.type ==="keydown"){

    /**
    *
    * Same way and logique just check key
    *
    **/
    
    if(event.keyCode === nUp){

    	if(this.value){

    		if(this.value < nMax) {

    			this.value = parseInt(this.value) + nStep;
    			gMap.setZoom( Number(this.value) );  
    			$zoom.css('cursor','ns-resize');

    		}
    		else{

    			$zoom.css('cursor','n-resize');

    		}
    	}
    	else{

    		this.value = parseInt( nMin ) + nStep;
    		gMap.setZoom( Number(this.value ));

    	}

    }else if(event.keyCode === nDown){

    	if(this.value){

    		if(this.value > nMin) {

    			this.value = parseInt(this.value) - nStep;
    			gMap.setZoom( Number(this.value) );  

    		}
    	}
    	else{

    		this.value = parseInt( nMin ) - nStep;
    		gMap.setZoom( Number(this.value ));

    	}

      /**
      *
      * Add left and right key to navigate on map
      *
      **/
      
    }else if(event.keyCode === nLeft) {
      /**
      *
      * get latLng and zoom
      *
      **/
      
      var gLat = gMap.getCenter().lat();

      var gLng = gMap.getCenter().lng();

      var gZoom = gMap.getZoom();

      /**
      *
      * Change position to those value incremented on zoom ratio
      *
      **/
      
      gMap.panTo( new google.maps.LatLng(gLat, gLng - ((0.1) / gZoom)*2));

      /**
      *
      * Same than left key
      *
      **/
      
    }else if(event.keyCode === nRight) {

      /**
      *
      * get latLng and zoom
      *
      **/
      var gLat = gMap.getCenter().lat();

      var gLng = gMap.getCenter().lng();

      var gZoom = gMap.getZoom();

      /**
      *
      * Change position to those value incremented on zoom ratio
      *
      **/

      gMap.panTo( new google.maps.LatLng(gLat, gLng + ((0.1) / gZoom)*2));

    }

  }

/**
 *
 * Prevent default use of input
 *
 **/
 
 return false;

};
/**
*
* Change map style for colorblind
*
**/

var switchStyleMap = function( style ){

/**
*
* Define new style using map_style created on displayGoogleMap()
*
**/

styledMap = new google.maps.StyledMapType(style,
	{name: "Styled Map"});

gMap.mapTypes.set('map_style', styledMap);

gMap.setMapTypeId('map_style');


};

/**
*
* On click on colorblind button, change map stype
*
**/
var toogleMapStyle = function( e ){

	e.preventDefault();

  /**
  *
  * toggle using global variable
  *
  **/
  
  if(typeof(bColorBlindOn) === "undefined" ) {

  	bColorBlindOn = false;

  }

  if(!bColorBlindOn){

  	switchStyleMap( jsColorBlindMapStyle );
  	$colorBlind.removeClass('active').addClass('active');
  	bColorBlindOn = true;

  }
  else
  {

  	switchStyleMap( jsStandardMapStyle );
  	$colorBlind.removeClass('active');
  	bColorBlindOn = false;

  }

};

/**
*
* Check if all markers targeted or filtered is on view
*
**/

var fitToAllMarkers = function( markers ) {

  var bounds = new google.maps.LatLngBounds();

    /**
    *
    * Create bounds from markers
    *
    **/
    
    for( var index in markers ) {

      /**
      
        TODO:
        - Check if this work
      
        **/

        if( marker[index].getVisible() === true && marker[index].getMap() !== null ){

        	var latlng = markers[index].getPosition();

        }

        bounds.extend(latlng);
      }

    /**
    *
    * Don't zoom in too far on only one marker
    *
    **/
    
    if (bounds.getNorthEast().equals(bounds.getSouthWest())) {

    	var extendPoint1 = new google.maps.LatLng(bounds.getNorthEast().lat() + 0.1, bounds.getNorthEast().lng() + 0.1);

    	var extendPoint2 = new google.maps.LatLng(bounds.getNorthEast().lat() - 0.1, bounds.getNorthEast().lng() - 0.1);

    	bounds.extend(extendPoint1);

    	bounds.extend(extendPoint2);
    }

    gMap.fitBounds( bounds );

    /**
     
       TODO:
       -  Adjusting zoom here doesn't work :/
     
       **/


     };

/**
*
* On click on showAllMarker button, show all marker
*
**/

var showAllMarkerKot = function( e ){

  e.preventDefault();

  if(typeof bShowAllKot === 'undefined'){

    bShowAllKot = false;

  }

/**
*
* Hide all markers if not in range
*
**/

if( bShowAllKot ){

	bShowAllKot = false;

	$showMarkersKot.removeClass('active');

  /**
  *
  * Call inRange to hide marker not in range
  *
  **/
  
  inRange( gCenterCity, nDistanceValueOk );

  /**
  *
  * Show all
  *
  **/
  
}else{

	/*mc.addMarkers(gMarkerArrayKot);*/

	for(var i =0; i < gMarkerArrayKot.length; i++){

		gMarkerArrayKot[i].setMap(gMap);

		gMarkerArrayKot[i].setOptions({'visible':true});

	}

	$showMarkersKot.removeClass('active').addClass('active');

	bShowAllKot = true;

}

};
/**
*
* On event on map item 
*
**/

var eventInput = function()
{

  $filter.click(function(e){ ///CLICK
  	e.preventDefault();

    nDistanceValueOk = Number(sRange.value);

    if(!$.isNumeric(nDistanceValueOk))
    {
      var id = 5;
      var sMessage = oLang.map.range_required;
      var sIcon = sImgDir+"reseaux/fb.jpg";

      e_errorNotification(id, sMessage, sIcon );
    }   

    sCenterCity = sCity.value;

    bSchoolClick = false;

    if(bSchoolClick)
    {
      actionEcoleClick( nDistanceValueOk );
    }
    else
    {
      getCity( sCenterCity , nDistanceValueOk , "geocoder", function( bType, sMessage ){

       if(bType){

        gCenterCity  = sMessage;

        processSubmit( $submit, 0 );

        removeFormTuto($range, 'messageTuto');

      }else{

        processSubmit( $submit, 0 );

      }
    });
    }
    return false;

  }); 

  $city.change(cityForm);

  $range.change(rangeForm);

};
var rangeForm = function(){

  nDistanceValueOk = Number(sRange.value);

  if(!$.isNumeric(nDistanceValueOk))
  {
    var id = 5;
    var sMessage = oLang.map.range_required;
    var sIcon = sImgDir+"reseaux/fb.jpg";

    e_errorNotification(id, sMessage, sIcon );
  }   


  sCenterCity = sCity.value;
    /*if( sCenterCity === ""){

      $showMarkersKot.css('display','block');

    }*/


    if(bSchoolClick) {

      actionSchoolClick( nDistanceValueOk );

    }
    else
    {
      formError(sCenterCity === "", $('.localite.messageError'), $city ,'localite', $('.mainType') ,oLang.map.select_location, $city);

      if(gCenterCity){

        drawCircle('ville' , gCenterCity , nDistanceValueOk);

      }else{

        $range.prop('disabled', true);

      }
    }
  }
  var cityForm = function(){

    nDistanceValueOk = Number(sRange.value);

    if(!$.isNumeric(nDistanceValueOk))
    {
      var id = 5;
      var sMessage = oLang.map.range_required;
      var sIcon = sImgDir+"reseaux/fb.jpg";

      e_errorNotification(id, sMessage, sIcon );
    }   

    sCenterCity = sCity.value;

    bSchoolClick = false;

    removeFormTuto($range, 'messageTuto');

    removeFormError( $city );

    if(bSchoolClick)
    {
      actionEcoleClick( nDistanceValueOk );
    }
    else
    {

      getCity( sCenterCity , nDistanceValueOk , "geocoder", function( bType, sMessage ){
        if(bType){
          gCenterCity  = sMessage;

          processSubmit( $submit, 0 );

          if($range.next().hasClass('tuto')){

          }else{

            if($range.next().hasClass('messageTuto')){

            }else{
              $range.after('<span class="range messageTuto">'+oLang.map.you_can_change_range+'</span>');
            }
          }

        }else{

          processSubmit( $submit, 0 );

        }
      });

    }


  }

  var actionSchoolClick = function( nDistance ){

  //filtrer les kots en fonction d'un rayon
   //afficher le cercle
   
   drawCircle( 'ecole', gCurrentPlace , nDistance );

 }
 $.fn.extend({
   a_animate: function( animation){
    if(typeof animation === 'undefined'){
     animation = 'bounce';
   }

   if(this.hasClass(animation)){
     this.removeClass(animation).addClass(sAnimationEvent)
     .addClass(animation).addClass(sAnimationEvent)
     .delay(1000)
     .queue(function(){
      $(this).removeClass(animation).addClass(sAnimationEvent)
      .dequeue();
    });

   }else{

     this.removeClass(sAnimationEvent)
     .addClass(animation).addClass(sAnimationEvent)
     .delay(1000)
     .queue(function(){
      $(this).removeClass(animation).addClass(sAnimationEvent)
      .dequeue();
    });
   }
 }
});
 var removeFormTuto = function( selector, hasClass ){
   if(selector.next().hasClass(hasClass)){
    selector.next().remove();
  }
};
var removeFormError = function( form ){
	if(form.hasClass('form-error')){
		form.removeClass('form-error');
		form.next().remove();
	}
	if(form.find('.messageError').length <= 0){
		$('.errors').removeClass('none').addClass('none');
	}
};
var formError = function( condition, exist, form , name, parent, content, giveFocus){
	if(condition){
		if(exist.length <= 0){  
			form.after('<span class="'+name+' messageError">'+oLang.map.enter_locality_or_school+'</span>').html(content);
		}
		form.addClass('form-error');
		if(giveFocus){
			/*giveFocus.focus();*/
		}
	}

  //thereIsError(parent.find('.errors'));
  
};
var getTraductions = function(  ) {

	$.ajax({

		type: "get", 
		async:   true,
		url: '/getAllLang',
		dataType: "json",
		success:function( oData ){
			oLang = oData;
			return true;
		}
	});
}
var thereIsError = function( element ){
	if(element.length > 0){
		if(element.hasClass('none')){
			element.removeClass('none');
			if(element.find('span').length <= 0){
				element.append('<span>'+oLang.map.errors_detects+'</span>');
			}
		}
	}
};
var processSubmit = function(that, nType){

	if(nType === 1){

		that.prop('disabled', true).val(oLang.map.research);

	}else if(nType === 0){

		that.delay(600)
		.queue(function(next){
			$(this).prop('disabled', false).val(oLang.map.filter);
			next();
		});
	}


};

var ajaxAllKot = function(){

	$.ajax({
		dataType:"json",
		url:"/ajax/getKots",
		type:"get",

    success: function ( oData ){
     oKots = oData;
     createMarkerKot(oKots);

   }
 })
}

var ajaxAllSchool = function(){
	$.ajax({
		dataType: "json",
		url:"/ajax/getSchools",
		type:"get",

    success: function ( oResponse ){
     oSchools = oResponse;
     createMarkerSchool(oSchools);

   }
 })
}
var getLatLng = function( value, type ){

	if(type ==='lat'){

		return value.split(',')[0];

	}else if(type ==='lng'){

		return value.split(',')[1];
	}
}
var createMarkerKot = function(oData){

	for(var i=0;i < oData.length;i++)
	{
		var lat = getLatLng(oData[i].latlng, 'lat');
		var lng = getLatLng(oData[i].latlng, 'lng');
  /*listKot.push(LatLng);
  console.log(listKot);*/

  drawMarkerKot( new google.maps.LatLng(lat,lng), oData[i].id, i);
}

$streetView.css('display','block');

mc = new MarkerClusterer(gMap, gMarkerArrayKot, {
	gridSize: 50,
	maxZoom: 15,
	styles: clusterStyleKot,
}); 
//mc.clusters[i].markers[i].getVisible() <== si false alors mc.clusters[i].setMap(null)
} 

var createMarkerSchool = function(oData){
	for(var i=0;i < oData.length;i++){
		var lat = getLatLng(oData[i].latlng, 'lat');
		var lng = getLatLng(oData[i].latlng, 'lng');
		/*listEcole.push(LatLng);*/


		drawMarkerSchool( new google.maps.LatLng(lat,lng), oData[i].id, i);

	}

	mcSchool = new MarkerClusterer(gMap, gMarkerArraySchool, {
		gridSize: 100,
		maxZoom: 15,
		styles: clusterStyleSchool,
	}); 
};
var getDir = function(sString, aParams){
  $.each(aParams, function(key, value){

    sString = sString.replace(':'+key, value);    

  });

  return sString;

}
var beforeUrl = function(sUrl, string ){

  sUrl = sUrl.split('.');

  return sUrl[0]+string+'.'+sUrl[1];
}
var getLocations = function( nId ){
  $.ajax({
    dataType: "json",
    url:"/ajax/getLocations/"+nId,
    type:"get",
    success:function(oData){

      if($slider.find('li').length > 0){

        $slider.find('li').remove();

      }

      if($listLocations.find('li').length > 0){

        $listLocations.find('li').remove();

      }
      $.each(oData.photo, function(i){

        $slider.append('<li><img width="'+oData.photo[i].width+'" height="'+oData.photo[i].height+'" src='+getDir(sBuildingDir, {"building_id": oData.id, "user_id":oData.user_id})+beforeUrl(oData.photo[i].url,'-mapslider')+'></li>');

      });
      $.each(oData.available_location, function(i){

        $listLocations.append('<li><a href="'+oLang.routes.locations+'/'+oData.available_location[i].translation[0].value+'" class="tooltip-ui-w" title="'+oLang.locations.goLocation+'"><div class="type"><img classs="thumbnail" src="'+getDir(sLocationDir, {"location_id": oData.available_location[i].id, "user_id":oData.user_id})+beforeUrl(oData.available_location[i].accroche[0].url,'-small')+'"><span class="number" title="'+oLang.locations.remaining_room+'">'+oData.available_location[i].remaining_room+'</span><span class="typeLocation">'+oData.available_location[i].type_location.translation[0].value+'</span></div><div class="price"><span class="expensive">'+Math.round(oData.available_location[i].price)+'€</span></div></a></li>'); //<div class="oneLocation"><ul><li><a href=""></a><div class="infosLocation"></div></li></ul></div>

      });

      $slider.responsiveSlides({  
        manualControls: '#slider-pager',
        nav: true,
        pager: true,
        auto: true,
        prevText: oLang.form.previous,  
        nextText: oLang.form.next,
        namespace: "transparent-btns"
      });

      $('.tooltip-ui-w').tipsy();

      $listingBtn.click();  

    }
  });


}
var drawMarkerKot = function ( mPosition, sId, i)
{

	gMarkerKot = new google.maps.Marker({
		position: mPosition,
		map : gMap,
		id : sId,
		order:i,
		icon : kotIcon,
		/*visible: true,*/
	});

	gMarkerArrayKot.push(gMarkerKot);

	google.maps.event.addListener(gMarkerKot, 'click', function() {
		/*gMap.setZoom(17);*/
		smoothZoom(gMap, 17, gMap.getZoom());


    getLocations(this.id)
    gMap.panTo(this.getPosition());

    gCurrentPlace = this.getPosition();

  });

}
var drawMarkerSchool = function ( mPosition, sId , i)
{

	gMarkerSchool = new google.maps.Marker({
		position:mPosition,
		map : gMap,
		id : sId,
		order : i,
		icon : schoolIcon
	});

	gMarkerArraySchool.push(gMarkerSchool);

 // actionEcoleClick();
 google.maps.event.addListener(gMarkerSchool,'click',function(){

 	bSchoolClick = true;

   gMap.setZoom(17);

   gMap.panTo(this.getPosition());
   console.log(oSchools);
   console.log(this.getPosition());
   console.log(this);
   var oDataOneSchool = oSchools[this.order];

   gCurrentPlace = this.getPosition();

   var contentString = 
   '<div class="school">'+
   '<h3 aria-level="3" role="heading" class="titleSchool">'+
   oDataOneSchool.name+
   '</h3>'+
   '<span class="address">'+
   oDataOneSchool.street+', '+oDataOneSchool.locality.postal+' ('+oDataOneSchool.locality.name+' '+oDataOneSchool.region.translation[0].value +')'+
   '</span>'+
   '<div class="website">'+
   oDataOneSchool.web+
   '</div>'+
   '</div>';
   var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

   infowindow.open(gMap,gMarkerSchool);

 });

};
var defineCircle = function(center, radius, sColor){
	return {
		fillColor: '#fff',
		fillOpacity: .6,
		strokeColor: '#313131',
		strokeOpacity: .4,
		clickable: false,
		strokeWeight: .8,
		map: gMap,
		center: center,
		radius: radius
	};
}
var inRange = function ( oCenter, nDistance, sType ) //obj Google / numeric
{

  if(nDistance > 1){

   aKots = [];
   var options = defineCircle(oCenter, nDistance);
   cityCircle.setOptions( options );
   if(sType==='ville'){
    cityCircle.bindTo('center', gMarker, 'position');
  }
  gMarker._cityCircle = cityCircle;

  var boundd = cityCircle.getBounds();
  for(var i=0;i<oKots.length;i++)
  {
    /*console.log(oKots[i].id+!boundd.contains(new google.maps.LatLng(getLatLng(oKots[i].latlng, 'lat'), getLatLng(oKots[i].latlng, 'lng'))));*/
    if(!boundd.contains(new google.maps.LatLng(getLatLng(oKots[i].latlng, 'lat'), getLatLng(oKots[i].latlng, 'lng')))){

     if(typeof bShowAllKot === 'undefined'){

      gMarkerArrayKot[i].setMap(null);
      gMarkerArrayKot[i].setOptions({visible: false});
	     mc.redraw(); //TODO FAIRE FONCTIONNER CLUSTER AVEC DES MARKERS HIDDEN

     }else{

	    if(bShowAllKot){// JE LES LAISSES VISIBLES
	    	gMarkerArrayKot[i].setMap(gMap);
	    	gMarkerArrayKot[i].setOptions({visible: true});

	    	mc.redraw();

	    }else{

	    	gMarkerArrayKot[i].setMap(null);
	    	gMarkerArrayKot[i].setOptions({visible: false});
	    	mc.redraw();
	    }

   }
   mc.clearMarkers();

 }
 else
 {

   aKots.push(oKots[i].id);

   displayNumberResult(aKots.length);

   gMarkerArrayKot[i].setMap( gMap );
   gMarkerArrayKot[i].setOptions({visible: true});
   /*mc.addMarker(gMarkerArrayKot[i]);*/
   gMap.fitBounds(boundd);
   mc.redraw();

 }


}

/*if(aKots.length <= 0){

	$showMarkersKot.css('display','block').a_animate();
}*/

$listKot.attr('value',JSON.stringify(aKots));

}
};
var displayNumberResult = function( nNumber ){

	if($l_range.html().indexOf('(') < 0){
		$l_range.html( $l_range.html() + ' ('+ nNumber +')');

	}else{

		$l_range.html( $l_range.html().replace(/\(.*?\)/g, " ("+ nNumber +")"));

	}
}
var hideGoogleMap = function() {

	$('#gmap').css({display:"none"});
	$('.mapInfo').css({height:"auto",marginLeft:0,float:"none"});

}
var showGoogleMap = function() {

	$('#gmap').css({display:"block"});
	$('.mapInfo').css({height:"auto",marginLeft:0,float:"left"});

}
var displayGoogleMap = function ( jsStyle  ){

	var jsStyle = jsStyle || jsStandardMapStyle;

	var aMapOptions = {
		disableDefaultUI:true,
		scrollwheel:false,
		zoom: 8,
		minZoom:nMinZoom,
		center:gCenter,
		styles: jsStyle,
		streetViewControl: false,
		mapTypeControlOptions: {

			mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
		}
	}
	gMap = new google.maps.Map(document.getElementById('gmap'),aMapOptions);

  //ajaxAllEcole();
};

var toggleStreetView = function( e ) {

	e.preventDefault();

	var toggle = panorama.getVisible();


	if(typeof gCurrentPlace !== "undefined"){

		if (toggle == false) {

			panorama.setPosition( gCurrentPlace );
			panorama.setVisible( true );
      $streetView.removeClass('active').addClass('active'); 

    } else {

     panorama.setPosition( gCurrentPlace );
     panorama.setVisible( false );
     $streetView.removeClass('active');

   }
 }else{

  var id  = 6
  var sMessage = oLang.map.no_stop_targeted;
  e_errorNotification(id, sMessage, sIcon );

}

};
var displayStreetView = function( center ){

	var panoramaOptions = {
		position: center,
		addressControlOptions: {
			position: google.maps.ControlPosition.BOTTOM
		},
		visible:false,
		panControl: true,
		enableCloseButton: false,
		pov: {
			heading: 34,
			pitch: 0
		}
	};
	panorama = new  google.maps.StreetViewPanorama(document.getElementById('gmap'), panoramaOptions);
	gMap.setStreetView(panorama);
};
var drawCircle = function(sType , oCenter, sDistance){

	if( cityCircle )
	{
		cityCircle.setMap( null );
	}
	nDistance = Number(sDistance);

	var oCenterCity = oCenter;
  var oCircleRangeN = gSpherical.computeOffset(oCenterCity, nDistance, 0); //marker limitant au NORD
  var oCircleRangeO = gSpherical.computeOffset(oCenterCity, nDistance, -90); //marker limitant au OUERT
  var oCircleRangeS = gSpherical.computeOffset(oCenterCity, nDistance, 180); //marker limitant au SUD
  var oCircleRangeE = gSpherical.computeOffset(oCenterCity, nDistance, 90); //marker limitant au EST
  
  if(sType ==='ville'){

  	gMarker.setPosition( oCenterCity );
  	gMarker.setMap( gMap );
  	var sColor = '#FF0000';

  }
  else(sType ==='ecole')
  {
  	var sColor = '#0000FF';
  }

  var nDistance = google.maps.geometry.spherical.computeDistanceBetween(oCenterCity, oCircleRangeN);

  var aCircleOptions = defineCircle(oCenter, nDistance, sColor);

  cityCircle.setOptions(aCircleOptions);
  var LatLngList = new Array (oCircleRangeN,oCircleRangeO,oCircleRangeS,oCircleRangeE);
  var bounds = new google.maps.LatLngBounds();
  for (var i = 0, LtLgLen = LatLngList.length; i < LtLgLen; i++) {
  	bounds.extend (LatLngList[i]);
  }
  gMap.fitBounds(bounds) ;

  inRange(oCenter, nDistance, sType);


};
var smoothZoom = function(map, max, cnt) {
	if (cnt >= max) {
		return;
	}
	else {
		var z = google.maps.event.addListener(map, 'zoom_changed', function(event){
			google.maps.event.removeListener(z);
			smoothZoom(map, max, cnt + 1);
		});
        setTimeout(function(){map.setZoom(cnt)}, 50); // 80ms is what I found to work well on my system -- it might not work well on all systems
      }
    };
    var e_isSaw = function( e , that){
     that.parent().removeClass('notSee');

     var nNumberOfErrorsTab = Number($errorsTab.find('.number').html());

     if(nNumberOfErrorsTab > 0 ){

      $errorsTab.find('.number').html(nNumberOfErrorsTab-1);

      $errorsNotificationsAppend.find('li a').each(function(){if($(this).parent().hasClass('notSee')){$(this).parent().hasClass('notSee');$(this).mouseover(function(e){e_isSaw(e, $(this));})};}); 
    }

  };

  var e_showCloseErrorsTab = function( e ){
   if( e ){
    e.preventDefault();
  }

  if(bErrorsTabStatus === 0 ){

    $errorsNotifications.css({

     right:"-12px",

   }).queue(function(){

     bErrorsTabStatus = 1;
     $(this).dequeue();

   }).delay(3000).queue(function(){
     if($errorsNotifications.is(':hover',':focus')){
      bErrorsTabStatus = 1
    }else{
      $(this).css({

       right:"-250px",

     }).dequeue();
      bErrorsTabStatus = 0;
    }
  });



 }

};
var e_errorNotification = function( id, sMessage, sIcon, animate ){

	if(animate){

		var animate = animate;

	}else{

		var animate = 'shake'
	}

	e_showCloseErrorsTab();

	if($errorsNotificationsAppend.find('li').attr('data-id',id).length > 0){
		$errorsNotificationsAppend.find('li').attr('data-id',id).removeClass('notSee').addClass('notSee');
                //REPLACEMENT
                var nNumberOfErrorsTab = Number($errorsTab.find('.number').html());
                // APPEND
                $errorsTab.find('.number').html(nNumberOfErrorsTab+1);

                $errorsNotifications.a_animate( animate );


                $errorsNotificationsAppend.find('li a').each(function(){if($(this).parent().hasClass('notSee')){$(this).parent().hasClass('notSee');$(this).mouseover(function(e){e_isSaw(e, $(this));})};}); 
                /*$errorsNotificationsAppend.find('li a').each(function(){$(this).focus(function(e){e_isSaw(e, $(this));});}); */

              }else{

                //REPLACEMENT
                var nNumberOfErrorsTab = Number($errorsTab.find('.number').html());
                var nNumberOfErrorsTitle = Number($errorsNotifications.find('.numberTitle').html());

                var sCode = sErrorsNotifcationOutput.replace(':message',sMessage).replace(':icon',sIcon).replace(':id',id);
                var title = sErrorsTitle.replace(':number',nNumberOfErrorsTitle+1);
                // APPEND
                $errorsTab.find('.number').html(nNumberOfErrorsTab+1);
                $errorsNotifications.find('.titleMessageError').html(title);
                $errorsNotificationsAppend.append(sCode);

                
                $errorsNotifications.a_animate( animate );

                $errorsNotificationsAppend.find('li a').each(function(){if($(this).parent().hasClass('notSee')){$(this).parent().hasClass('notSee');$(this).mouseover(function(e){e_isSaw(e, $(this));})};}); 
                /*$errorsNotificationsAppend.find('li a').each(function(){$(this).focus(function(e){e_isSaw(e, $(this));});}); */
              }
            };

            var getCity = function(sPosition, sDistance, sType, callback){

             var nDistance = Number(sDistance);

             if(sType ==="geocoder"){

              processSubmit($submit, 1);

              var aMapOptions = {
               disableDefaultUI:true,
               scrollwheel:false,
               mapTypeId: google.maps.MapTypeId.ROADMAP,
               center:geocoder.geocode({
                address:sPosition,
                region:"be"

              },function(aResults,sStatus)
              {
                if(sStatus ===google.maps.GeocoderStatus.OK)
                {
                 var center = aResults[0].geometry.location;

                      /**
                      *
                      * @if circle already create, the zoom is define by the bounds of gMap
                      * @else zoom is define basicaly
                      *
                      **/
                      
                      if( typeof cityCircle !== "undefined" && cityCircle.getBounds() !== null){

                      	gMap.fitBounds( cityCircle.getBounds() );

                      }
                      else
                      {

                      	smoothZoom(gMap, 15, gMap.getZoom());

                      }

                      gMap.panTo ( center );
                      gCurrentPlace = center;

                      $('#coords').attr('value',center);

                      var oCircleRangeN = gSpherical.computeOffset(center, nDistance, 360);

                      gMarker.setPosition( center );
                      gMarker.setMap( gMap );

                      $streetView.css('display','block');

                      google.maps.event.addListener(gMarker, 'click', function() {
                      	smoothZoom(gMap, 15, gMap.getZoom());
                      	gMap.panTo(gMarker.getPosition());
                      });

                      //drawCircle( 'ville' ,center , sDistance );
                      callback( true , center);
                    }
                    else if(sStatus ===google.maps.GeocoderStatus.ZERO_RESULTS)//1
                    {
                    	var id = 1;
                    	var sMessage = oLang.map.no_result_search;
                    	var sIcon = sImgDir+"reseaux/fb.jpg";

                    	e_errorNotification(id, sMessage, sIcon, 'shake' );
                    	callback( false, sMessage);

                    }
                    else if(sStatus ===google.maps.GeocoderStatus.REQUEST_DENIED)//2
                    {

                    	var id = 2;
                    	var sMessage = oLang.map.request_reject;
                    	var sIcon = sImgDir+"reseaux/fb.jpg";

                    	e_errorNotification(id, sMessage, sIcon );
                    	callback( false, sMessage);
                    }
                    else if(sStatus ===google.maps.GeocoderStatus.INVALID_REQUEST)//3
                    {

                    	var id = 3;
                    	var sMessage = oLang.map.enter_address;
                    	var sIcon = sImgDir+"reseaux/fb.jpg";

                    	e_errorNotification(id, sMessage, sIcon );
                    	callback( false, sMessage);
                    }
                    else if(sStatus ===google.maps.GeocoderStatus.UNKNOWN_ERROR)//4
                    {

                    	var id =4;
                    	var sMessage = oLang.map.intern_error;
                    	var sIcon = sImgDir+"reseaux/fb.jpg";

                    	e_errorNotification(id, sMessage, sIcon );
                    	callback( false, sMessage);
                    }

                  })
}
}else if( sType === "latlng" ){

	processSubmit($submit, 1);

	smoothZoom(gMap, 15, gMap.getZoom());
	gMap.panTo ( sPosition );
	gMarker.setPosition( sPosition );
	gMarker.setMap( gMap );
	gCurrentPlace = sPosition;

	$streetView.css('display','block');

	google.maps.event.addListener(gMarker, 'click', function() {
		smoothZoom(gMap, 17, gMap.getZoom());
		gMap.panTo(gMarker.getPosition());
	});
  //drawCircle( 'ville' ,sPosition , sDistance );
  callback(true, sPosition);
}
}
google.maps.event.addDomListener(window, 'load', initialize);
}
}).call(this,jQuery);