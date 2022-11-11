<?php $ip = $_SERVER['SERVER_ADDR']; ?>

<!doctype html>
<html>
<head>
	<title>Environment</title>
</head>
<body>
	<h1><?= $ip ?></h1>
	<p><?= gethostbyaddr($ip) ?>
</body>
</html>