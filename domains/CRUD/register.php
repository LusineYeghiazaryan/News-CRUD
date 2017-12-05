<?php
session_start();
require_once("connection.php");

	if(isset($_POST['email'],$_POST['username'],$_POST['password'])) {
		$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
		$user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

		$use_user = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'")
			or die("Could not execute the select query.");
		
		if ($use_user->num_rows != 0)
		{
			$_SESSION['reg'] = 'false';
			header('Location: register.php');	
			exit();	
		}

		mysqli_query($conn, "INSERT INTO users(email, username, password) VALUES('$email', '$user', md5('$pass'))")
			or die("Could not execute the insert query.");

		$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND password=md5('$pass')")
			or die("Could not execute the select query.");
	
		$row = mysqli_fetch_assoc($result);
	
		if(is_array($row) && !empty($row)) {
			$validuser = $user;
			$_SESSION['valid'] = $validuser;
			$_SESSION['name'] = $row['name'];
			$_SESSION['id'] = $row['id'];
			if(isset($_SESSION['valid'])) {
				header('Location: index.php');	
				exit();		
			}		
		}
	} else {
	?>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="jumbotron text-center">
	  <h1>Registration</h1>
	</div>
	<div class="container">
	<a class='btn' role='button' href="index.php">Home</a>
	<h2>Register</h2>
		<?php if(isset($_SESSION['reg']) && $_SESSION['reg'] == 'false') { ?>
			<div class="alert alert-warning">
				<strong>The username is already in use!</strong>
			</div>
		<?php } ?>	
		<form name="registration" method="post" action="">
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" class="form-control" name="username" required="required">
				</div>
				<div class="form-group"> 
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email" required="required">
				</div>			
				<div class="form-group"> 
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required="required">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>

		</form>
	<?php } ?>
</body>
</html>
