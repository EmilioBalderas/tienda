<?php
	session_start();
	if( isset($_SESSION['logged']))
	{
		unset($_SESSION['logged']);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<style type="text/css">
		
		body {
		  background: #007bff;
		  background: linear-gradient(to right, #0062E6, #33AEFF);
		}

	</style>
</head>

<body>
 	<div class="row justify-content-md-center fadeInDown" style="margin-top: 100px">
		<div class=" card col-md-4 border-dark align-self-center">
			<h3 class="text-center" style="padding-top: 30px">Log in</h3>


			<form  class=" justify-content-md-center" method="POST" action="loginController.php" style="margin: 10px; padding: 30px"> 

			<input class="form-control" placeholder="Username" type="text" name ="user" required>
			<br>
			<input class="form-control" placeholder="password" type="password" name ="pass" required>
			<br>

			<?php
				if(isset( $_SESSION['invalid'] ))
					echo "<p>Invalid username or password<p>";
			?>

			<input type="submit" name="log in" class="btn btn-primary" style="margin-top: 10px">

			</form>
		</div>
	</div>
</body>

</html>

// <!-- 161.35.99.189
// 19fb37a2e473f056c9425f523ba416c93b8b18b441cbe5ea -->