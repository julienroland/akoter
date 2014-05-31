(function(e){if("object"==typeof google&&"object"==typeof google.maps){var t,s,a,o,i,n,l,r,c,u,n,p,m,g,d,f="img/",h="/images/users/:user_id/buildings/:building_id/",v="/images/users/:user_id/locations/:location_id/",y=f+"map/markers/kot.png",b=f+"map/markers/school.png",T=f+"map/markers/target.png",C=[{featureType:"road",elementType:"labels",stylers:[{visibility:"simplified"},{lightness:20}]},{featureType:"administrative.land_parcel",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"landscape.man_made",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"transit",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road.local",elementType:"labels",stylers:[{visibility:"simplified"}]},{featureType:"road.local",elementType:"geometry",stylers:[{visibility:"simplified"}]},{featureType:"road.highway",elementType:"labels",stylers:[{visibility:"simplified"}]},{featureType:"poi",elementType:"labels",stylers:[{visibility:"off"}]},{featureType:"road.arterial",elementType:"labels",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"all",stylers:[{hue:"#a1cdfc"},{saturation:30},{lightness:49}]},{featureType:"road.highway",elementType:"geometry",stylers:[{hue:"#f49935"}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{hue:"#fad959"}]}],w=[{featureType:"administrative.country",elementType:"geometry.stroke",stylers:[{color:"#00006f"},{lightness:-5},{visibility:"on"},{weight:3},{hue:"#ff0091"}]},{featureType:"all",elementType:"all",stylers:[{invert_lightness:!0},{saturation:0},{lightness:25},{gamma:.6},{hue:"#435158"}]}],_=[],k=[],x=new google.maps.LatLng(50.5,4.6),L=!1,M=[],N=(new google.maps.LatLng,new google.maps.Circle),S=(new google.maps.Rectangle,e("#listKot")),O=(new RegExp("[,]"),new google.maps.Geocoder),I=7,j=new google.maps.Marker({icon:T}),E=google.maps.geometry.spherical,Z=document.getElementById("form-city"),P=document.getElementById("form-range"),B=e("#form-city"),D=e("#form-range"),q=e(".label-range"),z={types:["(cities)"],componentRestrictions:{country:"be"},setTypes:["geocode"]},R=!1,A=38,V=40,G=37,U=39,K=e('.mapItem input[type="submit"]'),F=e(".ListingBtn"),Q=e("#slider"),W=(e("#slider-pager"),e(".typeLocationList ul")),J=e(".loading"),H=e("#filter"),X=e("#zoom"),Y=e(".mapItem"),$=(e(".mapItem .tab"),e(".errorsNotifications")),et=e(".errorsNotifications .list"),tt='<li class="notSee" data-id=":id"><a href=""><div class="iconError"><img src=":icon"></img></div><span class="textError">:message</span></a></li>',st='<span class="numberTitle">:number</span> problème(s) rencontré(s)',at=e(".errorsNotifications .tab"),ot=0,it="animated",nt=[{opt_textColor:"white",url:f+"map/clusters/kot/small.png",height:30,width:30},{opt_textColor:"white",url:f+"map/clusters/kot/medium.png",height:45,width:45},{opt_textColor:"white",url:f+"map/clusters/kot/big.png",height:60,width:60}],lt=[{opt_textColor:"white",url:f+"map/clusters/school/small.png",height:30,width:30},{opt_textColor:"white",url:f+"map/clusters/school/medium.png",height:45,width:45},{opt_textColor:"white",url:f+"map/clusters/school/big.png",height:60,width:60}],rt=e(".showAllMarkerKot"),ct=e(".colorBlind"),ut=e(".streetView");e(function(){ut.on("click","a",zt),e("#form-range").on("change",gt),X.bind("mousewheel",dt),X.on("keydown",dt),e("html").on("click",mt),ct.on("click","a",ht),rt.on("click","a",vt)});var pt=function(){_t(),qt(),e("#locations .map").css("display","none"),Rt(new google.maps.LatLng(50.5,4.6)),Y.css("display","block"),Lt(),xt(),l=new google.maps.places.Autocomplete(Z,z),J.delay(400).fadeOut(function(){e(this).remove()}),yt(),google.maps.event.addListener(l,"place_changed",function(){R=!0;var s=l.getPlace();if(s.geometry){var o=s.geometry.location;if(t.panTo(o),Vt(t,14,t.getZoom()),j.setPosition(o),j.setMap(t),r=o,n=Number(P.value),!e.isNumeric(n)){var i=5,p=a.map.range_required,m=f+"reseaux/fb.jpg";Kt(i,p,m)}c=o,console.log(s),window.setTimeout(function(){B.val(s.address_components[0].long_name)},10),L?actionEcoleClick(n):Ft(c,n,"latlng",function(e,t){e?(u=t,kt(K,0),D.next().hasClass("tuto")||D.next().hasClass("messageTuto")||D.after('<span class="range messageTuto">'+a.map.you_can_change_range+"</span>")):kt(K,0)})}})},mt=function(e){e.stopPropagation(),1===ot&&($.css({right:"-250px"}),ot=0)},gt=function(){q.html(e(this).val()>999?"Distance: "+e(this).val()/1e3+"km":"Distance: "+e(this).val()+"m")},dt=function(e,s){var a=Number(X.attr("data-min")),o=Number(X.attr("data-max")),i=Number(X.attr("data-step"));if("mousewheel"===e.type)s>0?this.value?this.value<o?(this.value=parseInt(this.value)+i,t.setZoom(Number(this.value)),X.css("cursor","ns-resize")):X.css("cursor","s-resize"):(this.value=parseInt(a),t.setZoom(Number(this.value)),X.css("cursor","n-resize")):parseInt(this.value)>a?(this.value=parseInt(this.value)-i,t.setZoom(Number(this.value)),X.css("cursor","ns-resize")):X.css("cursor","n-resize");else if("keydown"===e.type)if(e.keyCode===A)this.value?this.value<o?(this.value=parseInt(this.value)+i,t.setZoom(Number(this.value)),X.css("cursor","ns-resize")):X.css("cursor","n-resize"):(this.value=parseInt(a)+i,t.setZoom(Number(this.value)));else if(e.keyCode===V)this.value?this.value>a&&(this.value=parseInt(this.value)-i,t.setZoom(Number(this.value))):(this.value=parseInt(a)-i,t.setZoom(Number(this.value)));else if(e.keyCode===G){var n=t.getCenter().lat(),l=t.getCenter().lng(),r=t.getZoom();t.panTo(new google.maps.LatLng(n,l-.1/r*2))}else if(e.keyCode===U){var n=t.getCenter().lat(),l=t.getCenter().lng(),r=t.getZoom();t.panTo(new google.maps.LatLng(n,l+.1/r*2))}return!1},ft=function(e){styledMap=new google.maps.StyledMapType(e,{name:"Styled Map"}),t.mapTypes.set("map_style",styledMap),t.setMapTypeId("map_style")},ht=function(e){e.preventDefault(),"undefined"==typeof d&&(d=!1),d?(ft(C),ct.removeClass("active"),d=!1):(ft(w),ct.removeClass("active").addClass("active"),d=!0)},vt=function(e){if(e.preventDefault(),"undefined"==typeof g&&(g=!1),g)g=!1,rt.removeClass("active"),Bt(u,n);else{p.addMarkers(_);for(var s=0;s<_.length;s++)_[s].setMap(t),_[s].setOptions({visible:!0});rt.removeClass("active").addClass("active"),g=!0}},yt=function(){H.click(function(t){if(t.preventDefault(),n=Number(P.value),!e.isNumeric(n)){var s=5,o=a.map.range_required,i=f+"reseaux/fb.jpg";Kt(s,o,i)}return c=Z.value,L=!1,L?actionEcoleClick(n):Ft(c,n,"geocoder",function(e,t){e?(u=t,kt(K,0),Tt(D,"messageTuto")):kt(K,0)}),!1}),B.change(function(){if(console.log("ok"),n=Number(P.value),!e.isNumeric(n)){var t=5,s=a.map.range_required,o=f+"reseaux/fb.jpg";Kt(t,s,o)}c=Z.value,L=!1,Tt(D,"messageTuto"),Ct(B),L?actionEcoleClick(n):Ft(c,n,"geocoder",function(e,t){e?(u=t,kt(K,0),D.next().hasClass("tuto")||D.next().hasClass("messageTuto")||D.after('<span class="range messageTuto">'+a.map.you_can_change_range+"</span>")):kt(K,0)})}),D.change(function(){if(n=Number(P.value),!e.isNumeric(n)){var t=5,s=a.map.range_required,o=f+"reseaux/fb.jpg";Kt(t,s,o)}c=Z.value,L?bt(n):(wt(""===c,e(".localite.messageError"),B,"localite",e(".mainType"),a.map.select_location,B),u?At("ville",u,n):D.prop("disabled",!0))})},bt=function(e){At("ecole",r,e)};e.fn.extend({a_animate:function(t){"undefined"==typeof t&&(t="bounce"),this.hasClass(t)?this.removeClass(t).addClass(it).addClass(t).addClass(it).delay(1e3).queue(function(){e(this).removeClass(t).addClass(it).dequeue()}):this.removeClass(it).addClass(t).addClass(it).delay(1e3).queue(function(){e(this).removeClass(t).addClass(it).dequeue()})}});var Tt=function(e,t){e.next().hasClass(t)&&e.next().remove()},Ct=function(t){t.hasClass("form-error")&&(t.removeClass("form-error"),t.next().remove()),t.find(".messageError").length<=0&&e(".errors").removeClass("none").addClass("none")},wt=function(e,t,s,o,i,n,l){e&&(t.length<=0&&s.after('<span class="'+o+' messageError">'+a.map.enter_locality_or_school+"</span>").html(n),s.addClass("form-error"))},_t=function(){e.ajax({type:"get",async:!0,url:"/getAllLang",dataType:"json",success:function(e){return a=e,console.log(e),!0}})},kt=function(t,s){1===s?t.prop("disabled",!0).val(a.map.research):0===s&&t.delay(600).queue(function(t){e(this).prop("disabled",!1).val(a.map.filter),t()})},xt=function(){e.ajax({dataType:"json",url:"ajax/getKots",type:"get",success:function(e){i=e,Nt(i)}})},Lt=function(){e.ajax({dataType:"json",url:"ajax/getSchools",type:"get",success:function(e){oSchools=e,St(oSchools)}})},Mt=function(e,t){return"lat"===t?e.split(",")[0]:"lng"===t?e.split(",")[1]:void 0},Nt=function(e){for(var s=0;s<e.length;s++){var a=Mt(e[s].latlng,"lat"),o=Mt(e[s].latlng,"lng");Et(new google.maps.LatLng(a,o),e[s].id,s)}ut.css("display","block"),p=new MarkerClusterer(t,_,{gridSize:50,maxZoom:15,styles:nt})},St=function(e){for(var s=0;s<e.length;s++){var a=Mt(e[s].latlng,"lat"),o=Mt(e[s].latlng,"lng");Zt(new google.maps.LatLng(a,o),e[s].id,s)}m=new MarkerClusterer(t,k,{gridSize:100,maxZoom:15,styles:lt})},Ot=function(t,s){return e.each(s,function(e,s){t=t.replace(":"+e,s)}),t},It=function(e,t){return e=e.split("."),e[0]+t+"."+e[1]},jt=function(t){e.ajax({dataType:"json",url:"ajax/getLocations/"+t,type:"get",success:function(t){console.log(t),e.each(t.photo,function(e){Q.append('<li><img width="'+t.photo[e].width+'" height="'+t.photo[e].height+'" src='+Ot(h,{building_id:t.id,user_id:t.user_id})+It(t.photo[e].url,"-gallery")+"></li>")}),e.each(t.active_location,function(e){W.append('<li><a href="'+a.routes.locations+"/"+t.active_location[e].translation[0].value+'" class="tooltip-ui-w" title="'+a.locations.goLocation+'"><div class="type"><img src="'+Ot(v,{location_id:t.active_location[e].id,user_id:t.user_id})+It(t.active_location[e].accroche[0].url,"-small")+'"><span class="number">'+t.active_location[e].remaining_location+'</span></div><div class="price"><span class="expensive">'+Math.round(t.active_location[e].price)+"€</span></div></a></li>")}),Q.responsiveSlides({manualControls:"#slider-pager",nav:!0,pager:!0,auto:!0,prevText:a.form.previous,nextText:a.form.next,namespace:"transparent-btns"}),e(".tooltip-ui-w").tipsy()}}),F.click()},Et=function(e,s,a){o=new google.maps.Marker({position:e,map:t,id:s,order:a,icon:y}),_.push(o),google.maps.event.addListener(o,"click",function(){Vt(t,17,t.getZoom()),console.log(i[this.order]),jt(this.id),t.panTo(this.getPosition()),r=this.getPosition()})},Zt=function(e,s,a){gMarkerSchool=new google.maps.Marker({position:e,map:t,id:s,order:a,icon:b}),k.push(gMarkerSchool),google.maps.event.addListener(gMarkerSchool,"click",function(){L=!0,Vt(t,17,t.getZoom()),t.panTo(this.getPosition()),r=this.getPosition()})},Pt=function(e,s){return{fillColor:"#fff",fillOpacity:.6,strokeColor:"#313131",strokeOpacity:.4,clickable:!1,strokeWeight:.8,map:t,center:e,radius:s}},Bt=function(e,s,a){console.log(e),M=[];var o=Pt(e,s);N.setOptions(o),"ville"===a&&N.bindTo("center",j,"position"),j._cityCircle=N;for(var n=N.getBounds(),l=0;l<i.length;l++)n.contains(new google.maps.LatLng(Mt(i[l].latlng,"lat"),Mt(i[l].latlng,"lng")))?(M.push(i[l].id),Dt(M.length),_[l].setMap(t),_[l].setOptions({visible:!0}),t.fitBounds(n),p.redraw()):("undefined"==typeof g?(_[l].setMap(null),_[l].setOptions({visible:!1}),p.redraw()):g?(_[l].setMap(t),_[l].setOptions({visible:!0}),p.redraw()):(_[l].setMap(null),_[l].setOptions({visible:!1}),p.redraw()),p.clearMarkers());S.attr("value",JSON.stringify(M))},Dt=function(e){q.html(q.html().indexOf("(")<0?q.html()+" ("+e+")":q.html().replace(/\(.*?\)/g," ("+e+")"))},qt=function(e){var e=e||C,s={disableDefaultUI:!0,scrollwheel:!1,zoom:8,minZoom:I,center:x,styles:e,streetViewControl:!1,mapTypeControlOptions:{mapTypeIds:[google.maps.MapTypeId.ROADMAP,"map_style"]}};t=new google.maps.Map(document.getElementById("gmap"),s)},zt=function(e){e.preventDefault();var t=s.getVisible();if("undefined"!=typeof r)0==t?(s.setPosition(r),s.setVisible(!0)):(s.setPosition(r),s.setVisible(!1));else{var o=6,i=a.map.no_stop_targeted;Kt(o,i,sIcon)}},Rt=function(e){var a={position:e,addressControlOptions:{position:google.maps.ControlPosition.BOTTOM},visible:!1,panControl:!0,enableCloseButton:!1,pov:{heading:34,pitch:0}};s=new google.maps.StreetViewPanorama(document.getElementById("gmap"),a),t.setStreetView(s)},At=function(e,s,a){N&&N.setMap(null),u=Number(a);var o=s,i=E.computeOffset(o,u,0),n=E.computeOffset(o,u,-90),l=E.computeOffset(o,u,180),r=E.computeOffset(o,u,90);if("ville"===e){j.setPosition(o),j.setMap(t);var c="#FF0000"}var c="#0000FF",u=google.maps.geometry.spherical.computeDistanceBetween(o,i),p=Pt(s,u,c);N.setOptions(p);for(var m=new Array(i,n,l,r),g=new google.maps.LatLngBounds,d=0,f=m.length;f>d;d++)g.extend(m[d]);t.fitBounds(g),Bt(s,u,e)},Vt=function(e,t,s){if(!(s>=t)){var a=google.maps.event.addListener(e,"zoom_changed",function(){google.maps.event.removeListener(a),Vt(e,t,s+1)});setTimeout(function(){e.setZoom(s)},80)}},Gt=function(t,s){s.parent().removeClass("notSee");var a=Number(at.find(".number").html());a>0&&(at.find(".number").html(a-1),et.find("li a").each(function(){e(this).parent().hasClass("notSee")&&(e(this).parent().hasClass("notSee"),e(this).mouseover(function(t){Gt(t,e(this))}))}))},Ut=function(t){t&&t.preventDefault(),0===ot&&$.css({right:"-12px"}).queue(function(){ot=1,e(this).dequeue()}).delay(3e3).queue(function(){$.is(":hover",":focus")?ot=1:(e(this).css({right:"-250px"}).dequeue(),ot=0)})},Kt=function(t,s,a,o){if(o)var o=o;else var o="shake";if(Ut(),et.find("li").attr("data-id",t).length>0){et.find("li").attr("data-id",t).removeClass("notSee").addClass("notSee");var i=Number(at.find(".number").html());at.find(".number").html(i+1),$.a_animate(o),et.find("li a").each(function(){e(this).parent().hasClass("notSee")&&(e(this).parent().hasClass("notSee"),e(this).mouseover(function(t){Gt(t,e(this))}))})}else{var i=Number(at.find(".number").html()),n=Number($.find(".numberTitle").html()),l=tt.replace(":message",s).replace(":icon",a).replace(":id",t),r=st.replace(":number",n+1);at.find(".number").html(i+1),$.find(".titleMessageError").html(r),et.append(l),$.a_animate(o),et.find("li a").each(function(){e(this).parent().hasClass("notSee")&&(e(this).parent().hasClass("notSee"),e(this).mouseover(function(t){Gt(t,e(this))}))})}},Ft=function(s,o,i,n){var l=Number(o);if("geocoder"===i){kt(K,1);{({disableDefaultUI:!0,scrollwheel:!1,mapTypeId:google.maps.MapTypeId.ROADMAP,center:O.geocode({address:s,region:"be"},function(s,o){if(o===google.maps.GeocoderStatus.OK){var i=s[0].geometry.location;"undefined"!=typeof N&&null!==N.getBounds()?t.fitBounds(N.getBounds()):Vt(t,15,t.getZoom()),t.panTo(i),r=i,e("#coords").attr("value",i);{E.computeOffset(i,l,360)}j.setPosition(i),j.setMap(t),ut.css("display","block"),google.maps.event.addListener(j,"click",function(){Vt(t,15,t.getZoom()),t.panTo(j.getPosition())}),n(!0,i)}else if(o===google.maps.GeocoderStatus.ZERO_RESULTS){var c=1,u=a.map.no_result_search,p=f+"reseaux/fb.jpg";Kt(c,u,p,"shake"),n(!1,u)}else if(o===google.maps.GeocoderStatus.REQUEST_DENIED){var c=2,u=a.map.request_reject,p=f+"reseaux/fb.jpg";Kt(c,u,p),n(!1,u)}else if(o===google.maps.GeocoderStatus.INVALID_REQUEST){var c=3,u=a.map.enter_address,p=f+"reseaux/fb.jpg";Kt(c,u,p),n(!1,u)}else if(o===google.maps.GeocoderStatus.UNKNOWN_ERROR){var c=4,u=a.map.intern_error,p=f+"reseaux/fb.jpg";Kt(c,u,p),n(!1,u)}})})}}else"latlng"===i&&(kt(K,1),Vt(t,15,t.getZoom()),t.panTo(s),j.setPosition(s),j.setMap(t),r=s,ut.css("display","block"),google.maps.event.addListener(j,"click",function(){Vt(t,17,t.getZoom()),t.panTo(j.getPosition())}),n(!0,s))};google.maps.event.addDomListener(window,"load",pt)}}).call(this,jQuery);