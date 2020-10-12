<?php
	include 'loginCheck.php';
	include 'dbConn.php';

	if(!isset($_POST["sel"]))
	{
		header( "Location: /tienda" );
		die();
	}

	$sel = $_POST["sel"];

	$strVer = "(";
	foreach ($_POST["sel"] as $key => $value) {
	$strVer .= $value . ",";
	}
	$strVer = substr($strVer, 0, strlen($strVer) - 1);
	$strVer .= ")";
	echo $strVer;

	//delete products
	$sql = "DELETE FROM product WHERE id in {$strVer}";
	$sth = $conn->prepare($sql);
	$sth->execute();

	//delete form category
	$sql = "DELETE FROM category WHERE id in {$strVer}";
	$sth = $conn->prepare($sql);
	$sth->execute();

	header( "Location: /tienda" );

?>