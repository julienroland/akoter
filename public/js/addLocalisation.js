/* HEPL RIA 2013 - Test One
 *
 * JS Document - /js/main.js
 *
 * coded by [Julien Roland]
 * started at 28/10/13
 */

 /* jshint boss: true, curly: true, eqeqeq: true, eqnull: true, immed: true, latedef: true, newcap: true, noarg: true, browser: true, jquery: true, noempty: true, sub: true, undef: true, unused: true, white: false */
 ;(function( $ ){
 	"use strict";

 	var gMap,
 	gStartPosition = new google.maps.LatLng( 50.833 , 4.333 ),
 	sPosition,
 	gMarker,
 	oData,
 	sCurrentPosition,
 	nZoomAdresse = 16,
 	nZoomZone = 16,
 	nZoomLocalite = 15,
 	$adresse = $('input[name="address"]'),
 	$region = $('input[name="region"]'),
 	$localite = $('input[name="locality"]'),
 	$number = $('input[name="number"]'),
 	$latlng = $('#latlng'),
 	$rechercheBtn = $('#rechercheMap'),
 	sAdresse,
 	sPays,
 	sRegion,
 	sSousRegion,
 	sLocalite,
 	sNumber,
 	lat,
 	lng,
 	icon_marker = '/img/building.png',
 	geocoder = new google.maps.Geocoder();

 	$(function(){

 	});

 	var initialize = function(){

 		displayGoogleMap();

 		$rechercheBtn.on('click', function( e ){

 			e.preventDefault();
 			getPosition( 'geocoder' );
 			

 		});

 	};
 	var getLatLng = function( value, type ){

 		if(type ==='lat'){

 			return value.split(',')[0];

 		}else if(type ==='lng'){

 			return value.split(',')[1];
 		}
 	}
 	var displayGoogleMap = function(){

 		gMap = new google.maps.Map(document.getElementById('gmapLocalisation'),{
 			center:gStartPosition,
 			zoom:7,
 			disableDefaultUI:false,
 			scrollwheel:false,
 			streetViewControl:false,
 			mapTypeId:google.maps.MapTypeId.ROADMAP,
 		});

 		if($latlng && $latlng.val().length > 0){
 			var lat = getLatLng($latlng.val(), 'lat');
 			var lng = getLatLng($latlng.val(), 'lng');

 			var latLng = new google.maps.LatLng(lat, lng);
 			createMarker(latLng);
 			gMap.setCenter(latLng);
 			gMap.setZoom(nZoomLocalite);

 		}

 	};

 	var getPosition = function( sType , sPosition, sTypePartAdresse ){

 		if(sType === "geocoder"){

 			if(typeof sPosition !== "undefined"){

 				if(sTypePartAdresse === "adresse"){

 					sAdresse = $adresse.val();

 				}
 				else if( sTypePartAdresse === "region" ){

 					sRegion = $region.find('option:selected').text();	

 				}
 				else if( sTypePartAdresse === "localite" ){

 					sLocalite = $localite.find('option:selected').text();

 				}

 			}
 			else{

 				var sAdresse = $(this).val();

 			}
 			if(!sRegion){

 				sRegion = $region.find('option:selected').text();

 			}
 			if(!sLocalite){

 				sLocalite = $localite.find('option:selected').text();
 			}
 			if(!sAdresse){

 				sAdresse = $adresse.val();
 			}
 			if(!sNumber){

 				sNumber = $number.val();
 			}

 			var aMapOptions = {
 				disableDefaultUI:true,
 				scrollwheel:false,
 				mapTypeId: google.maps.MapTypeId.ROADMAP,
 				center:geocoder.geocode({

 					address:sAdresse + ' ' + sNumber + ' ' + sLocalite  + ' ' + sRegion + ' ' + 'Belgique',

 				},function(aResults,sStatus)
 				{
 					if(sStatus === google.maps.GeocoderStatus.OK)
 					{
 						oData = aResults[0];

 						lat = oData.geometry.location.lat();
 						lng = oData.geometry.location.lng();

 						sCurrentPosition = new google.maps.LatLng( lat , lng );
 						$latlng.val( " " );
 						$latlng.val( lat + ',' + lng );

 						if(typeof gMarker === 'undefined'){

 							$latlng.val( " " );
 							$latlng.val( lat + ',' + lng );
 							createMarker( sCurrentPosition );
 							gMap.panTo( sCurrentPosition );

 							gMap.setZoom( nZoomZone );

 						}
 						else
 						{

 							$latlng.val( " " );
 							$latlng.val( lat + ',' + lng );
 							gMarker.setPosition( sCurrentPosition );
 							gMap.panTo( sCurrentPosition );

 							if(sTypePartAdresse === "adresse"){

 								gMap.setZoom( nZoomAdresse );

 							}
 							else if( sTypePartAdresse === "sous_region" )
 							{

 								gMap.setZoom( nZoomSousRegion );


 							}
 							else if( sTypePartAdresse === "localite" ){


 								gMap.setZoom( nZoomLocalite );


 							}
 							else
 							{

 								gMap.setZoom( nZoomZone );

 							}

 						}

 					}
 				})
}
}
else
{	

	$latlng.val( " " );
	$latlng.val( sPosition.lat() + ',' + sPosition.lng() );
	gMap.panTo( sPosition );
}

};
var createMarker = function( gLatLng ){

	gMarker = new google.maps.Marker({
		position:gLatLng,
		animation: google.maps.Animation.DROP,
		map : gMap,
		draggable: true,
		visible: true,
		icon: icon_marker
	});

	google.maps.event.addListener(gMarker, 'dragend', function( e ) {

		getPosition ( "latlng" , new google.maps.LatLng( e.latLng.lat() , e.latLng.lng() ));
		
	});
	google.maps.event.addListener(gMarker, 'click', function( e ) {

		gMap.setZoom(18);
		gMap.panTo(new google.maps.LatLng( e.latLng.lat() , e.latLng.lng() ));
		
	});


};
var updatePosition = function(  ){
	var gMyPosition = new google.maps.LatLng( oMyPosition.latitude , oMyPosition.longitude );
	gMap.panTo( gMyPosition );

};


google.maps.event.addDomListener(window, 'load', initialize);

}).call(this,jQuery);