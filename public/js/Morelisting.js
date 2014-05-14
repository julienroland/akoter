;(function( $ ){
//load
var 
bLoad = false,
$query = $('#query'),
$listContainer = $('.kots #container'),
nLoadOffset = $('.kot:last').offset(),
nMaxKot,
aDataToAppend,
nkotHeight = 400,
sPage = '?page=',
nPage = 1,
$win = $(window),
$loadMore = $('.loadmore'),
sImages_dir = '../img/',
$filterForm = $('#filterKot'),
$locations = $('#locations'),
$clearAll = $('#filterKot .clearAll'),
$filterFormFields = $('#filterKot input, #filterKot select'),
$pagination = $('.pagination'),
$filterMenu = $('.sortmenu'),
$searchBar = $('.sortmenu .searchBar'),
$formActions = $('.formActions'),
$alertbox = $('.alertbox'),
$classify = $('.classify'),
$listing = $('.listing'),
$map = $locations.find('.map'),
$filterActions = $('.filterType .filterItem'),
sNoPhotoLocation = sImages_dir+'noPhotoLocation.jpg',
$selectCharge = $('.selectCharge'),
$clearAll = $('.clearAll'),
$pannel = $('.pannel'),
$toogleMap = $('.toogleMap'),
$toogleList = $('.toogleList'),
$maxPagination = ( $pagination.find('li').length ) - 2;


$(function(){

	$selectCharge.on('change', displayOrNotPrice);

	$('html').on('click',closeAlertbox);

	$pagination.attr('aria-hidden',false).hide();

	$classify.on('change', sortList );

	$clearAll.on('click', clearAll);

	$(window).scroll(function(){
		kotLoad();
		filterMenu();
	});

	kotLoad();

	$formActions.on('click', 'a.goOn', hideAllFilter );

	$formActions.on('click', 'a.submit', function(e){
		e.preventDefault();
		$filterForm.submit();

	} );

	$alertbox.on('click', function(e){
		e.stopPropagation();
	});

	$filterActions.on( 'click','a', displayAlertbox );

	$toogleMap.on('click', displayMap);

	$toogleList.on('click', displayList);
});
var displayList = function( e ){
	e.preventDefault();

	var $that = $(this);
	$map.fadeOut('fast', function(){
		$listing.fadeIn();
		$pannel.find('a').removeClass('active');
		$that.addClass('active');
	});
}
var displayMap = function( e ){
	e.preventDefault();

	var $that = $(this);
	$listing.fadeOut( 'fast',function(){
		$map.fadeIn();
		$pannel.find('a').removeClass('active');
		$that.addClass('active');
	});
}
var sortList = function(){

	$filterForm.submit();
}
var closeAlertbox = function( e ){
	e.stopPropagation();
	$alertbox.hide();
};
var hideAllFilter = function( e ){
	e.preventDefault();
	e.stopPropagation();

	$(this).parents('.alertbox').hide(); 

};
var displayAlertbox = function( e ){
	e.preventDefault();
	e.stopPropagation();
	$alertbox.hide();
	$(this).siblings('.alertbox').toggle();


};
var filterMenu = function( e ){

	if($win.scrollTop() >= 80){

		
		$filterMenu.css({
			position:"fixed",
			height:70,
			top:0,
		});

		$searchBar.css('display','none');

		$map.css({
			'margin-top':70,
		});

		$listing.css({
			'padding-top':70 + 24,
		});

		$clearAll.css('display','none');

		$pannel.css('display','none');

	}else{

		$filterMenu.css({
			position:"absolute",
			height:112 ,
			top:80,
		});

		$searchBar.css('display','block');

		$map.css({
			'margin-top':112,
		});

		$listing.css({
			'padding-top':112 + 24,
		});

		$clearAll.css('display','inline-block');

		$pannel.css('display','block');
	}

};
var clearAll = function( e ){
	e.preventDefault();
	
	$(':input', $filterForm)
	.not(':button, :submit, :reset, :hidden')
	.val('')
	.removeAttr('checked')
	.removeAttr('selected');
	$filterForm[0].reset();
};

var filter = function( e ){
	e.preventDefault();

	var sData = $(this).serialize();

	var data = JSON.parse($query.attr('data-data'));

	console.log(sData);
	$.ajax({
		url: '/ajax/getLocationsFilter',
		type: 'get',
		data: sData,
		dataType: "json",
		success:function( oData ){
			/*console.log(oData);*/
			$listContainer.find('.kot').remove();
			aDataToAppend = [];

			for(var i in oData.data){

				appendMoreLocation( oData.data[i] );
			}

			
			
			$listContainer.append( aDataToAppend );
			$('#locations #container').masonry( 'appended', aDataToAppend );
			$('#locations #container').masonry( 'appended', $('.kot.appended') );
			$('#locations #container').masonry();
			/*getGrid();

			loadGrid();*/

			data.nb = data.nb + oData.data.length ;

			$query.attr('data-data', JSON.stringify(data));

			offset = $('.kot:last').offset();
		}
	});



};
var displayOrNotPrice = function( ){

	var $input = $('#input-chargePrice');

	if($(this).val() == 0 ){

		$input.parent().css('display','none');

	}else{

		$input.parent().css('display','block');

	}

};
var kotLoad = function(){

	if((($('.kot:last').offset().top - (nkotHeight * 2))-$win.height() <= $win.scrollTop()) && bLoad==false ){

			// la valeur passe à vrai, on va charger
			bLoad = true;

			if(nPage < $maxPagination){

				nPage++;

				var sGet = $filterForm.serialize();

				$.get(sPage+nPage+"&"+sGet, function(data){ 

					var el = $($(data).find("#container").html());

					$listContainer.append(el).masonry( 'appended', el, true );

					offset = $('.kot:last').offset();

					setTimeout(function(){

						bLoad = false;

						if((($('.kot:last').offset().top - (nkotHeight * 2))-$win.height() <= $win.scrollTop()) && bLoad==false ){
							kotLoad();
						}
					},3000);
					
				});


			}



		}
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

	$.fn.clearForm = function() {
		return this.each(function() {
			var type = this.type, tag = this.tagName.toLowerCase();
			if (tag == 'form')
				return $(':input',this).clearForm();
			if (type == 'text' || type == 'password' || tag == 'textarea')
				this.value = '';
			else if (type == 'checkbox' || type == 'radio')
				this.checked = false;
			else if (tag == 'select')
				this.selectedIndex = -1;
		});
	};

}).call( this, jQuery );