
<!DOCTYPE html data-widget="">
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>title</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->


  {{HTML::style('css/screen.css')}}

  @if(isset($widget) && Helpers::isOk($widget) && in_array('select', $widget))
  {{HTML::style('css/chosen-mk.css')}}
  @endif

  @if(isset($widget) && Helpers::isOk($widget) && in_array('slider', $widget))
  {{HTML::style('css/simple-slider.css')}}
  {{HTML::style('css/simple-slider-volume.css')}}
  @endif

  @if(isset($widget) && Helpers::isOk($widget) && in_array('date', $widget))
  {{HTML::style('css/jquery-ui.css')}}
  {{HTML::style('css/latoja.datepicker.css')}}
  {{HTML::style('css/melon.datepicker.css')}}
  @endif
  
  <!-- <link rel="stylesheet" href="css/range-slider.css"> -->
  {{HTML::script('js/vendor/modernizr-2.6.2.min.js')}}
</head>
<body {{isset($page) || isset($tools) ? 'id= ': ''}} {{isset($page) ? $page : "" }}>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endainif]-->
            
