<?php

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
		<form method="POST" action="/loginUser">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" />
			<label for="password">Password</label>
			<input type="password" name="password" id="password"/>
			<input type="submit" name="login" Value="Login"/>
		</form>
	</body>
</html>
