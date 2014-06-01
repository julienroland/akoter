
<!DOCTYPE html data-widget="">
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html prefix="og: http://ogp.me/ns#" class="no-js" lang="{{App::getLocale()}}">
 <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="robots" content="all">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{isset($request) && $request > 0  ? '('.$request.') ' :''}} {{isset($title) ? $title : trans('general.titlePage')}}</title>
  <meta name="description" content="{{isset($description) ? $description :''}}">
  <meta name="author" content="{{Config::get('var.email')}}">
  <meta name="keywords" content="{{isset($keywords) ? $keywords : Config::get('var.keywords')}}">
  <link rel="apple-touch-icon" sizes="" href="">  
  <meta property="og:title" content="{{isset($title) ? $title : trans('general.titlePage')}}">
  <meta property="og:type" content="website">
  <meta property="og:image" content="{{isset($ogImage) ? $ogImage :'' }}">
  <meta property="og:description" content="{{isset($description) ? $description :''}}">
  <meta property="og:url" content="{{Request::url()}}">
  <meta property="og:locale" content="{{App::getLocale()}}">
  @foreach(Config::get('app.setLocale') as $locale_og)
  <meta property="og:locale:alternate" content="{{$locale_og}}">
  @endforeach
  <meta property="og:latitude" content="{{Config::get('var.lat')}}">
  <meta property="og:longitude" content="{{Config::get('var.lng')}}">
  <meta property="og:street-address" content="{{Config::get('var.street')}}">
  <meta property="og:locality" content="{{Config::get('var.city')}}">
  <meta property="og:postal-code" content="{{Config::get('var.postal')}}">
  <meta property="og:country-name" content="{{Config::get('var.country')}}">
  <meta property="og:email" content="{{Config::get('var.email')}}">
  <meta property="og:phone_number" content="{{Config::get('var.phone')}}">
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
<body role="document" {{isset($page) || isset($tools) ? 'id= ': ''}} {{isset($page) ? $page : "" }}>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endainif]-->
            
