<?php
	session_start();
	require 'dbConn.php';

	$user = $_POST["user"];
	$pass = $_POST["pass"];

	$sql = 'SELECT user FROM admin WHERE user = :user AND password = :password;';

	$sth = $conn->prepare($sql);
	$sth->execute(array(':user' => $user, ':password' => $pass));
	$res = $sth->fetchAll();

	if(count($res) >= 1)
	{
		header( "Location: /tienda" );
		$_SESSION['logged'] = true;
	}
	else {
		$_SESSION['invalid'] = true;
		header( "Location: /tienda" );
	}
?>

<!-- 161.35.99.189
19fb37a2e473f056c9425f523ba416c93b8b18b441cbe5ea -->