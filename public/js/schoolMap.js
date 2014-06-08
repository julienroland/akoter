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
 	gMarkerSchool,
 	gMarker,
 	gMarkerArraySchool = [],
 	oData,
 	oSchool,
 	sCurrentPosition,
 	sImgDir = 'img/',
 	$rechercheBtn = $('.searchMap'),
 	schoolIcon = sImgDir+'map/markers/school.png',
 	newSchoolIcon = sImgDir+'newSchool.png',
 	$latlng = $('#latlng'),
 	geocoder = new google.maps.Geocoder();

 	$(function(){

 	});

 	var initialize = function(){

 		displayGoogleMap();

 		getSchools();
 
 		$rechercheBtn.on('click', function( e ){

 			e.preventDefault();
 			getPosition( "geocoder" );
 			

 		});

 	};

 	var getPosition = function(sType , sPosition, sTypePartAdresse ){

 		if(sType === "geocoder"){

 			var sAddress = $('#address').val();
 			var sRegion = $('#region').find('option:selected').text();
 			var sLocality = $('#locality').find('option:selected').text();
 			console.log(sRegion);
 			geocoder.geocode({
 				address:sAddress + ' ' + sRegion + ' ' + sLocality +' Belgium',
 				region:"be"

 			},function(aResults,sStatus)
 			{
 				console.log(aResults);
 				var center = aResults[0].geometry.location;
 				console.log(center);
 				createMarkerNewSchool(center);
 				var lat = center.lat();
 				var lng = center.lng();

 				sCurrentPosition = new google.maps.LatLng( lat , lng );
 				$latlng.val( " " );
 				$latlng.val( lat + ',' + lng );

 			});

 		}else{

 			$latlng.val( " " );
 			console.log(sPosition);
 			$latlng.val( sPosition.lat() + ',' + sPosition.lng() );
 			gMap.panTo( sPosition );
 		}

 	}

 	var getSchools = function(){

 		$.ajax({
 			url:'/ajax/getSchools',
 			type:"get",
 			dataType: "json",
 			success:function( oData ){
 				oSchool = oData;
 				createMarkerSchool(oData);
 			}
 		});
 	}
 	var createMarkerNewSchool =function( position){

 	 gMarker = new google.maps.Marker({
 			position:position,
 			map : gMap,
 			icon : newSchoolIcon,
 			animation: google.maps.Animation.DROP,
 			draggable: true,
 		});

 		google.maps.event.addListener(gMarker, 'dragend', function( e ) {

 			getPosition ( "latlng" , new google.maps.LatLng( e.latLng.lat() , e.latLng.lng() ));

 		});

 		google.maps.event.addListener(gMarker,'click',function(){

 			gMap.setZoom(17);

 			gMap.panTo(this.getPosition());

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

 	gMap.setZoom(17);

 	gMap.panTo(this.getPosition());

 	var oDataOneSchool = oSchool[this.id];

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
var createMarkerSchool = function( oData ){
	for(var i=0;i < oData.length;i++){
		var lat = getLatLng(oData[i].latlng, 'lat');
		var lng = getLatLng(oData[i].latlng, 'lng');


		drawMarkerSchool( new google.maps.LatLng(lat,lng), oData[i].id, i);

	}
}
var getLatLng = function( value, type ){

	if(type ==='lat'){

		return value.split(',')[0];

	}else if(type ==='lng'){

		return value.split(',')[1];
	}
}
var displayGoogleMap = function(){

	gMap = new google.maps.Map(document.getElementById('sMap'),{
		center:gStartPosition,
		zoom:7,
		disableDefaultUI:false,
		streetViewControl:false,
		mapTypeId:google.maps.MapTypeId.ROADMAP,
	});


};

var updatePosition = function(  ){
	var gMyPosition = new google.maps.LatLng( oMyPosition.latitude , oMyPosition.longitude );
	gMap.panTo( gMyPosition );

};


google.maps.event.addDomListener(window, 'load', initialize);

}).call(this,jQuery);