<?php
	include 'loginCheck.php';
	include 'dbConn.php';
	
	$id = $_GET['id'];

	$sql = "SELECT * FROM product WHERE id = {$id};";
	$res = $conn->query($sql);
	$row = $res->fetch();

	$id = $row['id'];
	$sku = $row['sku'];
	$title = $row['post_title'];
	$type = $row['meta_type'];


	$categorySql = "SELECT id, GROUP_CONCAT(ctgry) as allCategories FROM category WHERE id ={$id} GROUP BY id ;";
	$categories = $conn->query($categorySql);
	$categories = $categories->fetch();
	$categories = $categories['allCategories'];
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<title></title>
</head>
<body>
	<div class="container">
	<div class="d-flex align-items-center">
	<div class="card d-flex" style="width: 100rem; margin-top:50px">
	  <div class="card-body" style="padding: 50px;">
	    <h3 class="card-title" style="margin-bottom: 30px"> <?php echo $title ?> </h3>
	    <p class="card-text"><b>ID:</b> <?php echo $id ?></p>
	   	<p class="card-text"><b>SKU:</b> <?php echo $sku ?></p>
	    <p class="card-text"><b>Type:</b> <?php echo $type; ?></p>
	    <p class="card-text"><b>Categories:</b> <?php echo $categories; ?></p>

		<div class="d-flex" style="margin-top:30px">

	    <a href="/tienda" class="btn btn-primary">Return</a>	
	    
	    <form method="Get" action="/tienda/add.php" style="margin-left: 30px">
		    <input name="id" value="<?php $text = isset($id) ? $id: ""; echo $text ?>" style="display: none">
		   	<input  name="name" value="<?php $text = isset($title) ? $title: ""; echo $text ?>" style="display: none">
		   	<input  name="sku"  value="<?php $text = isset($sku) ? $sku: ""; echo $text ?>" style="display: none">
		    <input  name="type" placeholder="Type" value="<?php $text = isset($type) ? $type: ""; echo $text ?>" style="display: none">
		    <input  name="categories" value="<?php $text = isset($categories) ? $categories: ""; echo $text ?>" style="display: none">

		   	<input type="submit" class="btn btn-warning" value="Edit">
	    </form>
	</div>
<!-- 	    <a href="/tienda/Edit.php" class="btn btn-warning">Edit</a>
   	    <a href="/tienda/delele.php" class="btn btn-danger">Delete</a> -->
	  </div>
	 </div>
	</div>
</div>
</body>
</html>