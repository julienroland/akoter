@if(isset($widget) && !in_array('nojs', $widget) || !isset($widget))
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
@endif

@if(isset($widget) && in_array('select', $widget))
{{HTML::script('js/min/chosen.jquery.js')}}
<script>

    var config = {
        '.select'                : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.nb-select' : {disable_search_threshold:100},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
        $(selector).chosen({width: 'auto'});
    }
</script>

@endif

@if(isset($widget) && in_array('upload', $widget))
<script>
        $('.baseFile').remove();

</script>
{{HTML::script('js/jquery.uploadfile.min.js')}}
{{HTML::script('js/jquery.validationEngine.js')}}
{{HTML::script('js/jquery.validationEngine-fr.js')}}

@endif

@if(isset($widget) && in_array('map', $widget))
boo
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJSSKlpz3C7EwQd2kvgn1JRBd7Ojrl9dM&amp;sensor=false&amp;libraries=places,geometry"></script>

<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js">
</script>
<script type="text/javascript">

    var script = '<script type="text/javascript" src="./js/min/markerClusterer';
    if (document.location.search.indexOf('compiled') !== -1) {
        script += '_compiled';
    }
    script += '.js"><' + '/script>';
    document.write(script);

</script>

{{HTML::script('js/map.js')}}
@endif

@if(isset($widget) && in_array('listing', $widget))
{{HTML::script('js/min/moreListing.js')}}
@endif


@if(isset($widget) && in_array('grid', $widget))
{{HTML::script('js/min/grid.js')}}

<script>

    var $container = $('#container');

    $container.masonry({
        itemSelector: '.kot',
        "isOriginLeft": true,
        isFitWidth: false,
    });

</script>
@endif

@if(isset($widget) && in_array('slider', $widget))
{{HTML::script('js/min/simple-slider.min.js')}}
@endif

@if(isset($widget) && in_array('mousewheel', $widget))
{{HTML::script('js/min/jquery.mousewheel.min.js')}}
@endif

@if(isset($widget) && !in_array('nojs', $widget) || !isset($widget))
{{HTML::script('js/main.js')}}
@endif

@if(isset($widget) && in_array('slideshow', $widget))
{{HTML::script('js/min/responsiveSlides.js')}}
<script>
    $("#slider").responsiveSlides({
        manualControls: '#slider-pager',
        nav: true,
        auto: false,
        pager: true,
        namespace: "transparent-btns",
        maxwidth: 540,
    });

</script>
@endif

@if(isset($widget) && in_array('ui', $widget))
{{HTML::script('js/min/ui.js')}}


@if(isset($widget) && in_array('tabs', $widget))
<script> $( ".tabs" ).tabs();</script>
@endif

@if(isset($widget) && Helpers::isOk($widget) && in_array('sort', $widget))
<script>
    $(function(){
        $("#sortable").sortable({
            stop: function(event, ui) {
                var data = {};

                $("#sortable li").each(function(i, el){
                    var p = $(el).find('a').attr('data-id');
                    data[p]=$(el).index()+1;
                });

                $("form > [name='image_order']").val(JSON.stringify(data));

            },
            create: function(event, ui) {
                var data = {};

                $("#sortable li").each(function(i, el){
                    var p = $(el).find('a').attr('data-id');
                    data[p]=$(el).index()+1;
                });

                $("form > [name='image_order']").val(JSON.stringify(data));

            },
            update: function(event, ui) {

                var data = {};

                $("#sortable li").each(function(i, el){
                    var p = $(el).find('a').attr('data-id');
                    data[p]=$(el).index()+1;

                });

                var sType = $(this).attr('data-type');

                $.ajax({
                    type: "get",
                    url: '/ajax/updatePhotoPosition/'+sType,
                    data: JSON.stringify(data),
                    dataType: "json",
                });


            }

        }).disableSelection();


});
</script>
@endif

@if(isset($widget) && (in_array('date', $widget) || in_array('datepicker', $widget)))

<script>
    $('.datepicker').datepicker({
        format: "dd-mm-yy",
        inline: true,
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
    }).datepicker('widget').wrap('<div class="ll-skin-melon"/>');

</script>
@if(App::getLocale() ==='fr')
<script>
    (function( factory ) {
        if ( typeof define === "function" && define.amd ) {

            // AMD. Register as an anonymous module.
            define([ "../datepicker" ], factory );
        } else {

            // Browser globals
            factory( jQuery.datepicker );
        }
    }(function( datepicker ) {

        datepicker.regional['fr'] = {
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['janvier', 'février', 'mars', 'avril', 'mai', 'juin',
            'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
            monthNamesShort: ['janv.', 'févr.', 'mars', 'avril', 'mai', 'juin',
            'juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.'],
            dayNames: ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'],
            dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
            dayNamesMin: ['D','L','M','M','J','V','S'],
            weekHeader: 'Sem.',
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
            datepicker.setDefaults(datepicker.regional['fr']);

            return datepicker.regional['fr'];

        }));
</script>

@elseif(App::getLocale() ==='nl')

<script>
    /* Dutch (UTF-8) initialisation for the jQuery UI date picker plugin. */
    /* Written by Mathias Bynens <http://mathiasbynens.be/> */
    (function( factory ) {
        if ( typeof define === "function" && define.amd ) {

            // AMD. Register as an anonymous module.
            define([ "../datepicker" ], factory );
        } else {

            // Browser globals
            factory( jQuery.datepicker );
        }
    }(function( datepicker ) {

        datepicker.regional.nl = {
            closeText: 'Sluiten',
            prevText: '←',
            nextText: '→',
            currentText: 'Vandaag',
            monthNames: ['januari', 'februari', 'maart', 'april', 'mei', 'juni',
            'juli', 'augustus', 'september', 'oktober', 'november', 'december'],
            monthNamesShort: ['jan', 'feb', 'mrt', 'apr', 'mei', 'jun',
            'jul', 'aug', 'sep', 'okt', 'nov', 'dec'],
            dayNames: ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'],
            dayNamesShort: ['zon', 'maa', 'din', 'woe', 'don', 'vri', 'zat'],
            dayNamesMin: ['zo', 'ma', 'di', 'wo', 'do', 'vr', 'za'],
            weekHeader: 'Wk',
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};
            datepicker.setDefaults(datepicker.regional.nl);

            return datepicker.regional.nl;

        }));


</script>

@endif

@endif

@endif

@if(isset($widget) && in_array('validator', $widget))

{{HTML::script('js/min/validator.js')}}

@endif


@if(isset($widget) && in_array('geoRegionLocality', $widget))

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJSSKlpz3C7EwQd2kvgn1JRBd7Ojrl9dM&amp;sensor=false"></script>
{{HTML::script('js/min/geoRegionLocality.js')}}

@endif

@if(isset($widget) && in_array('city_autocomplete', $widget))
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCJSSKlpz3C7EwQd2kvgn1JRBd7Ojrl9dM&amp;libraries=places&amp;sensor=false&amp;language=language&amp;components=country:be"></script>
{{HTML::script('js/city_autocomplete.js')}}
@endif

@if(isset($widget) && in_array('editor', $widget))

{{HTML::script('//tinymce.cachefly.net/4.0/tinymce.min.js')}}
<script type="text/javascript">
    tinymce.init({
        selector: ".editor",
        mode : "textareas",
        toolbar: "bold italic | bullist numlist outdent indent",
        language_url : '/js/editor/fr.js',
        menubar: "tools edit",
        plugins: [
        "lists charmap",
        "wordcount",
        "paste",

        ],
        paste_auto_cleanup_on_paste : true,
        paste_remove_styles: true,
        paste_remove_styles_if_webkit: true,
        paste_strip_class_attributes: true,
        style_formats: [
        {
            title: 'Bold text',
            inline: 'b',
        },
        ]
    });
</script>
@endif

@if(isset($page) && $page ==='inscription_localisation')


{{HTML::script('js/min/addLocalisation.js')}}

@endif

{{HTML::script('js/min/retina.js')}}

{{HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js')}}
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script async>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='//www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X');ga('send','pageview');
</script>
</body>
</html>
