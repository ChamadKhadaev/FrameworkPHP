<?php
	
?>

<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <form action="/create" method="POST" enctype="multipart/form-data">
		    <input type="text" name="username" placeholder="Username"/>
		    <input type="email" name="email" placeholder="Email"/>
		    <input type="password" name="password" placeholder="Password"/>
	        <input type="submit" name="register" value="Register"/>
    </form>
</body>
</html>
