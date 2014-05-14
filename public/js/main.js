;(function( $ ){
	var 
	$map = $('.mapContainer'),
	$main = $('.main'),
	$mapManage = $('.mapManage'),
	$win = $(window),
	//MAP
	nMapHeight,
	nMapMinHeight = 500,	
	nMapPercent = 80,
	nMapControlSize = 240,
	$winHeight = $(window).height(),
	$winWidth = $(window).width(),
	$htmlBody = $('html,body'),
	$addInfos = $('.addInfos'),
	$menu = $('.banner'),
	$nav = $('.nav'),
	$mapItem = $('.mapItem'),
	$m_search = $('.mapItem .accordeon'),
	$body = $('body'),
	$kotsHeight = $('.kots').outerHeight(),
	//MAP CONTENT
	$searchMapTab = $('.mapItem .tab'),
	bSearchTabStatus = 0,
	$mapSearch  = $('.mapManage .search .content'),
	$zoom = $('#zoom'),
	$researchBtn = $('.researchBtn'),
	$ListingBtn = $('.ListingBtn'),
	$switchView = $('.switchView'),
	$m_research = $('.mapManage .research'),
	$m_oneBuilding = $('.mapManage .oneBuilding'),
	//FORM
	$submit = $('input[type="submit"]'),
	$form = $('form'),
	$city = $('#form-city'),
	//OVERLAY
	$overlay = $('.overlay'),
	//TUTO
	$tuto = $('.helper'),
	$closeTuto = $('.closeTuto'),
	//POPUP
	$popup = $('.popup'),
	$popupLang = $('.popup.lang'),
	$popupConnection = $('.popup.connection'),
	$popupAgence = $('.popup.agence'),
	$closePopup = $('.closePopup'),
	$toSocialLogin = $('.toSocialLogin'),
	$toEmailLogin = $('.toEmailLogin'),
	$loginEmail = $('.loginEmail'),
	$loginSocial = $('.loginSocial'),
	$toPopup = $('.toPopup'),
	//ERRORS
	$errorsNotifications = $('.errorsNotifications'),
	$errorsTab = $('.errorsNotifications .tab'),
	$errorsNotificationsList = $('.errorsNotifications .list'),
	bErrorsTabStatus = 0,
	//warning-box
	$warningIcon = $('.warning-tick'),
	$warningBox = $('.warning-tick-box'),
	$closeTickbox = $('.closeTickbox'),
	//load
	bLoad = false,
	$query = $('#query'),
	$listContainer = $('.kots #container'),
	nLoadOffset = $('.kot:last').offset(),
	nMaxKot,
	$loadMore = $('.loadmore'),
	$pagination = $('.pagination'),
	$paginationList = $('.pagination ul'),
	aDataToAppend = [],
	//ajax
	$agenceAjax = $('.agenceAjax'),
	//path
	sLocations_dir = '../img/locations/',
	sImages_dir = '../img/',
	sNoPhotoLocation = sImages_dir+'noPhotoLocation.jpg',
	//ANIMATIONS
	sAnimationEvent = 'animated';



	$(function(){
		
		getTraductions();

		/**
		*
		* Masonry
		*
		**/
		
		/*getGrid(  );*/

		$m_search.drags({

			handle: ".head",
		});

		if($('.typeLocation')){

			changeCheckboxToImage();
		}
		/*$city.autocomplete({

			source: function(req, add){
				console.log(req);
				$.ajax({
					url:'getLocalityAutocomplete',
					dataType:'json',
					type:"get",
					data : {
		                name_startsWith : $city.val(), // on donne la chaîne de caractère tapée dans le champ de recherche
		                maxRows : 15
		            },
		            success: function( oData ){


		            	var aLocality = [];

		            	$.each(oData, function(i, val){ 

		            		aLocality.push(val.locality);

		            	});

		            	return aLocality;
		            }
		        })
			},
			appendTo: ".autocomplete",
		});*/

/* ERROR */

$errorsTab.on('click','a',e_toogleErrorsTab);

$('html').on('click',e_closeErrorsTab);

$errorsNotifications.on('click',function( e ){
	e.stopPropagation();
});

/* ERROR */
/* MAP */

heightMap();
widthMap();

$searchMapTab.on('click','a',m_toogleSearchTab);

$toPopup.on('click',openPopup);
		//if($popup.not(':focus') && $popup.children(':focus').length ==0){console.log('toto');hideAllPopup();}else{console.log('toti');}
		$(document).keyup(function( e ){
			if (e.keyCode == 27) {
				closePopup(e);
			}
		});

		$closePopup.on('click',closePopup);

		$overlay.on('click',function( e ){

			hideAllPopup( e );
		});

		/* CONNECTION AND REGISTER */

		$nav.find('.connection').on('click','a',openPopup);

		$toSocialLogin.on('click',showSocialLogin);

		$toEmailLogin.on('click',showEmailLogin);


		/* TEXT-OVERFLOW */
		$(window).resize(function(){
			heightMap($(window).height());
			widthMap( $(window).width() );
		});
		/*ellips();*/
		/* BARS */

		$('.goTo').on('click',function( e ){
			e.preventDefault();
			goTo( $('#main') );
		});

	/**
	*
	* MapManage
	*
	**/
	$researchBtn.on('click', showSearch );

	$ListingBtn.on('click', showListing );

	/**
	*
	* Tick box
	*
	**/
	
	/*$warningIcon.hover( showTickBox, hideTickBox);*/

	/**
	*
	* Tuto
	*
	**/
	$closeTuto.on('click', closeTuto);

});	
/*var fixSort = function(){
	var $sort = $('.short');
	if($(window).scrollTop() >= $sort.offset().top){
		$sort.css({
			position:'fixed',
			top:0,
			'margin-top':0,
		});
		$('.residence').css({
			'margin-left':256,
		});
	}
	else{
		$sort.css({
			position:'relative',
			'margin-top':'3em',
		});
		$('.residence').css({
			'margin-left':0,
		});
	}
};*/
var closeTuto = function(e){

	e.preventDefault();

	$(this).parent().css('display','none');
}
var showTickBox = function( ){
	$(this).next($warningBox).show();
}
var hideTickBox = function( ){
	$(this).next($warningBox).hide();
}

var showListing = function(e){
	e.preventDefault();

	var $that = $(this);
	$m_research.css('display','none');
	$m_oneBuilding.css('display','block');
	$switchView.find('a').removeClass('active');
	$that.addClass('active');
};
var showSearch = function(e){
	e.preventDefault();

	var $that = $(this);
	$m_oneBuilding.css('display','none')
		$m_research.css('display','block');
		$switchView.find('a').removeClass('active');
		$that.addClass('active');
};
var addAgence = function(e){

	e.preventDefault();

	var sData = $(this).serialize();

	$.ajax({
		type: "post", 
		async:   false,
		url: '/'+oLang.routes.account+'/{user_slug}/'+oLang.routes.add_agence,
		data:sData,
		dataType: "json",
		success: function( oData ){
			if(oData ==='success'){

				alert(oLang.agence.success_save);

				$overlay.click();
			}
		}
	});

};
var getTraductions = function(  ) {

	$.ajax({

		type: "get", 
		async:   false,
		url: '/getAllLang',
		dataType: "json",
		success:function( oData ){
			oLang = oData;
			console.log(oData);
			return true;
		}
	});
}
var changeCheckboxToImage  = function(){

	$('.typeLocation li').each(function(){
		$checkbox = $(this).find('input[type="checkbox"]');

		$checkbox.css({
			visibility: 'hidden',
			position:'absolute',
			left:'-99999999px',
			
		});
		$(this).find('label').css({
			backgroundImage:'url(./img/'+$checkbox.attr('data-background')+')',
			backgroundPosition:'top',
			width:'100%',
			height:100,
			paddingTop:60,
			display:'block',
		});
	});
};
var loadGrid = function(){

	$listContainer.masonry( 'appended', $('.kot.appended') );

};
var loadCSS = function() {
	var cssLink = $("<link rel='stylesheet' type='text/css' href='../css/screen.css'>");
	$("head").append(cssLink); 
};
var getRating = function( rating ){

	return Math.round( rating ) / 2;
};

var extractLatLng = function( latlng, type){

	if( type === 'lat' ){

		return latlng.split(',')[0];

	}else{

		return latlng.split(',')[1];

	}

};

var trans = function( key, parameters ){

	if(typeof parameters !== "undefined"){

		if(typeof key === 'undefined'){

			var key  = oLang.key;

		}

		var line = key;
		if(typeof key !== 'undefined'){

			$.each(parameters, function( key , value){

				line = line.replace(':'+key, value );

			});

			return line;

		}

	}else{

		if(typeof key === 'undefined'){

			var key  = oLang.key;

		}

		var line = key;
		if(typeof key !== 'undefined'){

			return key;

		}

	}

};
var isStar = function( number, star ){
//order 3 on 3.5 star

if(number > star){

	if(star - number < 0 && star - number > -1 ){

		return 'half-one';

	}

	return 'no-one';

}else{

	if(star - number < 0 && star - number > -1  ){

		return 'half-one';
	}

	return 'one';
}
};
var getGrid = function(){

	var $container = $('#container');

	$container.masonry({
		itemSelector: '.kot',
		"isOriginLeft": true,
		isFitWidth: true,
	});
};
var m_toogleSearchTab = function( e ){

	e.preventDefault();
	if(bSearchTabStatus === 0 ){

		$mapItem.css({

			left:"-220px",

		});
		bSearchTabStatus = 1;

	}else{

		$mapItem.css({
			left:"12px",
		});
		bSearchTabStatus = 0;
	}
};
var e_closeErrorsTab = function( e ){
	e.stopPropagation();
	if(bErrorsTabStatus === 1 ){

		$errorsNotifications.css({
			right:"-250px",
		});

		bErrorsTabStatus = 0;
	}

};
var e_toogleErrorsTab = function( e ){
	e.preventDefault();
	if(bErrorsTabStatus === 0 ){

		$errorsNotifications.css({
			right:"12px",

		});
		bErrorsTabStatus = 1;

	}else{

		$errorsNotifications.css({
			right:"-250px",
		});
		bErrorsTabStatus = 0;
	}

};
var a_animate = function( element, animation){
	if(element.hasClass(animation)){
		$errorsTab.removeClass(animation).addClass(sAnimationEvent)
		.addClass(animation).addClass(sAnimationEvent)
		.delay(1000)
		.queue(function(){
			$(this).removeClass(animation).addClass(sAnimationEvent)
			.dequeue();
		});

	}else{

		$errorsTab.removeClass(sAnimationEvent)
		.addClass(animation).addClass(sAnimationEvent)
		.delay(1000)
		.queue(function(){
			$(this).removeClass(animation).addClass(sAnimationEvent)
			.dequeue();
		});
	}
};
var showSocialLogin = function( e ){
	e.preventDefault();
	$loginEmail.slideUp(function(){
		$loginSocial.slideDown();
	});

};
var showEmailLogin = function( e ){
	e.preventDefault();
	$loginSocial.slideUp(function(){
		$loginEmail.slideDown();
	});

};
var openPopup = function( e ){
	e.preventDefault();
	e.stopPropagation();

	var sType = $(this).attr('data-type');

	if(sType === "lang"){
		$overlay.css('display','block');
		$popupLang.css('display','block');

	}
	else if(sType === "connection"){
		$overlay.css('display','block');
		$popupConnection.css('display','block');

	}	


};
var closePopup = function( e ){
	e.preventDefault();
	$popup.fadeOut('fast', function(){
		hideOverlay();
	}); 
	
};
var hideAllPopup = function( e ){
	e.preventDefault();
	$popup.fadeOut('fast', function(){
		hideOverlay();
	}); 

};
var hideOverlay = function(){
	$overlay.css('display','none');
};

var menu = function(){

	if($htmlBody.scrollTop() > ($addInfos.height() + $menu.outerHeight() + nMapHeight)){
		$menu.css({
			'position':'fixed',
			'top':0,
			'left':0,
			'right':0,
		});
	}
	else{
		$menu.css({
			'position':'relative',
		});
	}
};
var addInfosBar = function(){
	if($htmlBody.scrollTop() > 30){
		$addInfos.slideUp();
	}
	else{
		$addInfos.slideDown();
	}
};
/*var ellips = function(){
	$('.kot .content').ellipsis();
};*/
var heightMap = function( nWinHeight ){

	if($map){
		if(nWinHeight){

			nMapHeight =  (( nWinHeight - $('.banner').height() ) / 100 ) * nMapPercent ;

		}else{

			nMapHeight =  (( $(window).height() - $('.banner').height() ) / 100 ) * nMapPercent ;
		}

		$map.css({
			'height':nMapHeight,
			'width':$(window).width() - 240,
			'min-height':nMapMinHeight,
		});
		$mapManage.css({
			'height':nMapHeight,
			'min-height':nMapMinHeight,
		});
		$main.css({
			'height':'auto',
			'min-height':'100%',
		});
	}
};
var widthMap = function( nWinWidth ){

	/*if($map){

		if( nWinWidth ){

			$map.css({
				'width':nWinWidth - nMapControlSize,
			});

		}else{
			$map.css({
				'width':$winWidth - nMapControlSize,
			});
		}
	}*/
};
var toPercent = function( nValue , nPercent){
	return (nValue / 100) * nPercent;
};
var goTo = function( $selector ){
	$('html,body').animate({scrollTop: $selector.offset().top}, 'slow');
};
}).call(this,jQuery);

//DRAG
(function($) {
	$.fn.drags = function(opt) {

		$that = $(this);

		opt = $.extend({handle:"",cursor:"move"}, opt);

		if(opt.handle === "") {
			var $el = this;
		} else {
			var $el = this.find(opt.handle);
		}

		return $el.css('cursor', opt.cursor).on("mousedown", function(e) {
			e.stopPropagation();
			if(opt.handle === "") {
				var $drag = $(this).addClass('draggable');
			} else {
				console.log($(this));
				var $drag = $(this).addClass('active-handle');
				$that.addClass('draggable');
			}
			var z_idx = $drag.css('z-index'),
			drg_h = $drag.outerHeight(),
			drg_w = $drag.outerWidth(),
			pos_y = $drag.offset().top + drg_h - e.pageY,
			pos_x = $drag.offset().left + drg_w - e.pageX;
			$drag.css('z-index', 1000).parents().on("mousemove", function(e) {
				$('.draggable').offset({
					top:e.pageY + pos_y - drg_h,
					left:e.pageX + pos_x - drg_w
				}).on("mouseup", function() {
					$(this).removeClass('draggable').css('z-index', z_idx);
				});
			});
e.preventDefault(); // disable selection
}).on("mouseup", function() {
	if(opt.handle === "") {
		$(this).removeClass('draggable');
	} else {
		$(this).removeClass('active-handle').parent().removeClass('draggable');
	}
});

}
}).call(this,jQuery);