;(function( $ ){
  var $fields = $('.autocomplete');

  $.each($fields, function(index){

    var autocomplete = new google.maps.places.Autocomplete($fields[index], {types: ['geocode'], componentRestrictions: {'country':'be'}});
 
    google.maps.event.addListener(autocomplete, 'place_changed', function() {

      var place = autocomplete.getPlace();

      for(var i in place.address_components){

       if(place.address_components[i].types[0] == "administrative_area_level_2"){

        var region = place.address_components[i].long_name

      }
      else if(place.address_components[i].types[0] == "locality"){
        var locality = place.address_components[i].long_name
      }
      else if(place.address_components[i].types[0] == "route"){
        var street = place.address_components[i].long_name
      }
      else if(place.address_components[i].types[0] == "postal_code"){
        var postal = place.address_components[i].long_name
      }
    }

    if($($fields[index]).attr('name').indexOf('agence[') > -1){

      $('input[name="agence[region]"]').val(region).addClass('fill'); 
      $('input[name="agence[locality]"]').val(locality).addClass('fill'); 
      $('input[name="agence[postal]"]').val(postal).addClass('fill'); 
      $('input[name="agence[address]"]').val(street).addClass('fill'); 

      if(place){ 

        window.setTimeout(function(){
          $('input[name="agence[address]"]').val(street);
        }, 50);
      }

    }else{

      if(region!= "" && typeof region !=="undefined" && region !="null"){
        $('input[name="region"]').val(region).addClass('fill'); 
      }

      if(locality!= "" && typeof locality !=="undefined" && locality !="null"){
        $('input[name="locality"]').val(locality).addClass('fill'); 
      }

      if(postal!= "" && typeof postal !=="undefined" && postal !="null"){
        $('input[name="postal"]').val(postal).addClass('fill'); 
      }

      if(street!= "" && typeof street !=="undefined" && street !="null"){
        $('input[name="address"]').val(street).addClass('fill'); 
      }

      if(place){ 

        if(street!= "" && typeof street !=="undefined"){
          window.setTimeout(function(){
            $('input[name="address"]').val(street);
          }, 20);
        }

        if(street!= "" && typeof locality !=="undefined"){
          window.setTimeout(function(){
            $('input[name="locality"]').val(locality);
          }, 20);
        }

        if(street!= "" && typeof region !=="undefined"){
          window.setTimeout(function(){
            $('input[name="region"]').val(region);
          }, 20);
        }

        if(street!= "" && typeof postal !=="undefined"){
          window.setTimeout(function(){
            $('input[name="postal"]').val(postal);
          }, 20);
        }
      }
    }



  });
})

}).call(this,jQuery);