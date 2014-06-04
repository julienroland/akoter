<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    @if(isset($widget) && Helpers::isOk($widget) && in_array('select', $widget))
    {{HTML::style('css/admin/chosen.css')}}
    @endif

    @if(isset($widget) && Helpers::isOk($widget) && in_array('upload', $widget))
    {{HTML::style('css/uploadfile.css')}}
    @endif
    {{HTML::style('css/admin/admin.css')}}
    {{HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css')}}
    <style>
        .container{
            min-height:100%;
            margin-top:51px;
            padding:3em 0;
        }
    </style>
</head>