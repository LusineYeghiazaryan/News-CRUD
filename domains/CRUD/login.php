<?php session_start();

if(isset($_POST['username'], $_POST['password'])) {
	
	require_once("connection.php");
	
	$user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND password=md5('$pass')")
					or die("Could not execute the select query.");
	
	$row = mysqli_fetch_assoc($result);
		
	if(is_array($row) && !empty($row)) {
		$validuser = $row['username'];
		$_SESSION['valid'] = $validuser;
		$_SESSION['name'] = $validuser;
		$_SESSION['id'] = $row['id'];
		if(isset($_SESSION['valid'])) {
			header('Location: index.php');	
			exit();		
		}		
	} else {
		$_SESSION['login'] = 'false';
		header('Location: login.php');	
		exit();	
	}
} else {
?>
<html>
<head>
	<title>Login to News CRUD</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="jumbotron text-center">
		<h1>Login to News CRUD</h1>
	</div>
	<div class="container">
		<a class='btn' role='button' href="index.php">Home</a>
		
		<h2>Login</h2>
		<?php if(isset($_SESSION['login']) && $_SESSION['login'] == 'false') { ?>
			<div class="alert alert-warning">
				<strong>Invalid username or password!</strong>
			</div>
		<?php } ?>		
		<form name="registration" method="post" action="">
			<div class="form-group">
				<label for="username">Username:</label>
				<input type="text" class="form-control" name="username" required="required">
			</div>		
			<div class="form-group"> 
				<label for="password">Password:</label>
				<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required="required">
			</div>
			
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
		
	</body>
</html>
<?php } ?>
