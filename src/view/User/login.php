<?php

	require '../../../Core/autoload.php';
?>

<!Doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UserLogin</title>
	<link rel="stylesheet" href="../../../webroot/css/main.css">
</head>
	<body>
		<form method="POST" action="/index.php" enctype="multipart/form-data">
			<label for="email">Email</label>
			<input type="email" id="email" name="email"/>
			<label for="password">Password</label>
			<input type="password" name="password" id="password"/>
			<button type="submit">Login</button>
		</form>
	</body>
</html>
