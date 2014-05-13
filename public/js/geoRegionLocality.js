;(function( $ ){
	var 
	geocoder = new google.maps.Geocoder();

	$(function(){
		locateMe();
	});
	var locateMe = function(){

		if(navigator.geolocation){

			navigator.geolocation.getCurrentPosition(function(position){

				getPositionSuccess(position);
				

			},function(){

				getPositionError();
			});
			
		}
	};
	var getPositionSuccess = function( oPosition ){

 var oPosition = new google.maps.LatLng(oPosition.coords.latitude, oPosition.coords.longitude);
		getRegion( oPosition );
		getLocality( oPosition );

	};

	var getRegion = function( oPosition ){

		geocoder.geocode({'latLng': oPosition},function(oResults,sStatus)
		{
			if(sStatus ===google.maps.GeocoderStatus.OK)
			{

				for( var i in oResults[0].address_components){

					if(oResults[0].address_components[i].types[0] === 'route'){

						$('.autocomplete[name="address"]').val( oResults[0].address_components[i].long_name );

					}

					if(oResults[0].address_components[i].types[0] === 'locality'){

						$('.autocomplete[name="locality"]').val( oResults[0].address_components[i].long_name );

					}

					if(oResults[0].address_components[i].types[0] === 'administrative_area_level_2'){

						$('.autocomplete[name="region"]').val( oResults[0].address_components[i].long_name );

					}


					if(oResults[0].address_components[i].types[0] === 'postal_code'){

						$('.autocomplete[name="postal"]').val( oResults[0].address_components[i].long_name );

					}


				}
			}
		});
	};

	var getLocality = function( oPosition ){
		
	}

}).call(this,jQuery);