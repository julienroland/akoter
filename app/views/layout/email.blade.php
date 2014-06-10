<!DOCTYPE html>
<html>
<head>
	<title></title>
	
</head>
<body style="
margin:0;
width:100%;
font-family:'Helvetica Neue',Helvetica, Arial, sans-serif;
color:#8A8282;
font-size:18px;
line-height: 1.3;
font-weight:300;
background-color:#F1F1F1;
">
<table style="
width:100%;
border-spacing:0;
margin-bottom:3em;
">
<!-- background-color: #EF672F; -->
<tr style="
height: 180px;
display: block;
">

<td style="display:block;margin:auto;height:100%;">
<a style="display:block;width:100%;height:100%;" href="{{Request::root()}}" title="Akoter, site de kots en Belgique">
		<img style="display:block;margin:auto;" src="{{public_path().Config::get('var.img_dir').'email-header.png'}}" alt="Akoter">
	</a>
</td>
</tr>
<tr style="width: 500px;display:block;margin:auto;">
	<td >
		@yield('content')
	</td>
</tr>
</table>
</body>
</html>			