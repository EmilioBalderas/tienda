<?php
	include 'loginCheck.php';
	include 'dbConn.php';
	
	if(isset($_GET['id']))
	{
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
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<title><?php $text = isset($id) ? "Edit ": "Add"; echo $text ?> product</title>

	<style type="text/css">
		.s{ margin-top: 20px;}
	</style>
</head>
<body>
	<div class="container">
	<div class="d-flex align-items-center">
	<div class="card d-flex" style="width: 100rem; margin-top:50px">
	  <div class="card-body" style="padding: 50px;">
	    <h3 class="card-title" style="margin-bottom: 30px"> <?php $text = isset($id) ? "Edit ": "Add"; echo $text ?> product </h3>
	    <form method="POST" action="/tienda/addController.php">
		    <input name="idOriginal" value="<?php $text = isset($id) ? $id: ""; echo $text ?>" style="display: none">
		    <!-- <input class="form-control" type="text" name="id" placeholder="ID" value="<?php $text = isset($id) ? $id: ""; echo $text ?>" required> -->
		   	<input class="form-control s" type="text" name="name" placeholder="post title" value="<?php $text = isset($title) ? $title: ""; echo $text ?>" required>
		   	<input class="form-control s" type="text" name="sku" placeholder="sku" value="<?php $text = isset($sku) ? $sku: ""; echo $text ?>" required>
		    <input class="form-control s" type="text" name="type" placeholder="Type" value="<?php $text = isset($type) ? $type: ""; echo $text ?>" required>
		    <input class="form-control s" type="text" name="categories" placeholder="Categories: separate with commas multiple" value="<?php $text = isset($categories) ? $categories: ""; echo $text ?>" required>
			<div class="d-flex" style="margin-top:30px">
				<div>
				<a href="/tienda" class="btn btn-primary">Back</a>
				</div>
				<div class=" ml-auto p-2" style="">

		    		<input type="submit" class="btn btn-primary" value="<?php $text = isset($id) ? "Edit ": "Add"; echo $text ?>">
		    	</div>
		 	</div>

	    </form>
<!-- 	    <a href="/tienda/Edit.php" class="btn btn-warning">Edit</a>
   	    <a href="/tienda/delele.php" class="btn btn-danger">Delete</a> -->
	  </div>
	 </div>
	</div>
</div>
</body>
</html>