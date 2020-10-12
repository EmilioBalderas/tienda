<?php
	include 'loginCheck.php';
	include 'dbConn.php';
	var_dump($_POST);
	$post_title = $_POST['name'];
	$sku = $_POST['sku'];
	$type = $_POST['type'];
	$categories = $_POST['categories'];

	//update
	if($_POST["idOriginal"] != "")
	{
		$id = $_POST["idOriginal"];

		//delete prev categories;
		$sql = "DELETE FROM category Where id = {$id}";
		$conn->prepare($sql)->execute();

		$sql = "UPDATE product SET sku = '{$sku}', meta_type = '{$type}', post_title = '{$post_title}' WHERE id = {$id};";
		$conn->prepare($sql)->execute();
	}
	else {//insert
		$sql =  "INSERT INTO product (sku, meta_type, post_title) VALUES ('{$sku}', '{$type}', '{$post_title}')";
		$conn->prepare($sql)->execute();

		$id = $conn->lastInsertId();
		echo $id;
	}

	//insert new Categories;
	echo "<br>" . $categories . "<br>";
	$categories = explode(",",  $categories);
	var_dump($categories);
	echo $id;
	foreach ($categories as $key => $value) {
		$value = rtrim(ltrim($value));
		echo $value;
		$sql = "INSERT INTO category VALUES ('{$id}','{$value}')";
		$conn->prepare($sql)->execute();			
	}

	header( "Location: index.php" );
?>
