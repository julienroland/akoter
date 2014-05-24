<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Akoter</h1>
        <p>Bonjour {{$user->first_name}}</p>
        <p>Validatez votre email en cliquant sur ce lien: <a href="{{url('activation/'.$key)}}">{{url('activation/'.$key)}}</a></p>

	</body>
</html>