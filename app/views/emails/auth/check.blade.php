<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Email vérif</h2>

		<div>
			To reset your password, complete this form: {{ URL::to('activation', array($key)) }}.
		</div>
	</body>
</html>