<?php 
	include 'loginCheck.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style type="text/css"> 
		.scrollable { overflow-y: auto; height: 700px; }
		.scrollable thead th { position: sticky; top: 0; }
		.scrollable input { position: relative; ; bottom: 0; }

	</style>
</head>
<body >

<div class="d-flex justify-content-center" style="margin-bottom: 30px; margin-top: 30px">
	<h1>Products</h1>
	</div>
	<div class="row justify-content-center" >

		<form id="myform"> 
			<div class="scrollable" >
			 	<table class="table table-striped  scrollable"}>
			 		<thead class="thead-dark posit">
					  <tr >
					  	<th></th>
						<th>Id</th>
					    <th>SKU</th>
					    <th>post</th>
					    <th>type</th>
					    <th>categories</th>
					  </tr>
					 </thead>
					  
					  <tbody>
					  <?php
					  	include 'dbConn.php';

						$sql = 'SELECT * FROM product;';
						$res = $conn->query($sql);
						$res = $res->fetchAll();

						$categorySql = "SELECT id, GROUP_CONCAT(ctgry) as allCategories FROM category GROUP BY id;";
						$categories = $conn->query($categorySql);
						$categories = $categories->fetchAll();

						// echo $categories[0]["id"];

					    foreach ($res as $row) {
    				    	$id = $row['id'];
					    	$sku = $row['sku'];
					    	$title = $row['post_title'];
					    	$type = $row['meta_type'];

					    	//obtener categorias de la fila actual; 
					    	$category = array_filter($categories, function($arr)
							{ 
								global $id;
								return $arr["id"] == $id;
							});

							$cats = array_values($category)[0]['allCategories'];

					    	echo "<tr >";
					    	echo '<td>  <input type="checkbox" name="sel[]" value=' .  $id .' >  </td>';	
					    	echo "<td> 	$id </td>";
					    	echo "<td> 	$sku </td>";
					        echo "<td>  <a href=/tienda/product.php?id=$id> $title </a>  </td>";
					        echo "<td>  $type  </td>";
					        echo "<td>  $cats </td>";
							echo "</tr>";
						}	
					  ?>
					  </tbody>
			 	</table>
			</div>

			<div class="d-flex" style="margin-top:30px">
				<div class="">
				<input class="form-control" size="40" placeholder="Filter: use semicolon for multiple filters" type="text" id="myFilter">
		 		</div>
				<div class=" ml-auto p-2" style="margin-right: 30px;">
				<a href="/tienda/add.php" id="add" type="submit" name="mode-add" class="btn btn-success" style="margin-right: 30px">New Product</a>
				<button id="del" type="submit" class="btn btn-danger"  >Delete Selected</button>
		 		</div>
	 		</div>
	</form>
</div>
	
	<script type="text/javascript">
 		 
 		$("#myFilter").focus();

 		//change keys functionalities
		$(document).ready(function() {
		  $(window).keydown(function(event){
		    if(event.keyCode == 13) { //enter dont send code
		      event.preventDefault();
		      return false;}
		    if(event.keyCode == 9) //tab select filter input
		    {
		    	event.preventDefault();
		    	$("#myFilter").focus();
		    	return false;
		    
		    }
		  });
		});

		//set button functionality
		$("#del").on("click", function(e){
		    e.preventDefault();
		    $('#myform').attr('action', "/tienda/delete.php");
		    $('#myform').attr('method', "post");
		    $('#myform').submit();
			});
		$("#add").on("click", function(e){
		    // e.preventDefault();
		    // $('#myform').attr('action', "/tienda/add.php");
		    // $('#myform').attr('method', "post");
		    // $('#myform').submit();
			});



		  $("#myFilter").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	

	    	var querys = value.split(";");
		    	$("tbody tr").map(function() {
		    		console.log($(this));
		    		let tr = $(this)
		    		let valid = true;
		    		querys.forEach(function(query){
		    			query = query.trimStart();
		    			query = query.trimEnd();
		    			var inRow = tr.text().toLowerCase().indexOf(query) > -1;
						valid = valid && inRow;
		     	 		tr.toggle(valid);
		     	 		console.log(tr);
		    });})
		  });
	</script>

</body>

</html>