<?php session_start(); ?>
<html>
<head>
	<title>News CRUD</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" >
	<script src="js/bootstrap.min.js"></script>

</head>

<body>
	<div class="jumbotron text-center">
	  <h1>Welcome to News CRUD</h1>
	</div>
	<div class="container">

	<?php
	if(isset($_SESSION['valid'])) {			
		include("connection.php");					
	?>
				
		Welcome <?php echo $_SESSION['name'] ?> ! 
		<div class="btn-group btn-group-justified">
			<a class='btn' role='button' href="logout.php">Logout</a>
			<a href='view.php' class="btn">My Articles</a>
		</div>

	<?php } else { ?>
		<h2>Please login in or register</h2>
		<a class='btn btn-info' role='button' href='login.php'>Login</a>  
		<a class='btn btn-info' role='button' href='register.php'>Register</a>
	<?php }	
	//including the database connection file
	include_once("connection.php");

	//fetching data in descending order (lastest entry first)
	$result = mysqli_query($conn, "SELECT news.id, news.title, news.body, news.created, users.username FROM news LEFT JOIN users ON news.author=users.id ORDER BY news.id DESC")
					or die("Could not execute the select query.");
	while($res = mysqli_fetch_array($result)) { ?>	
		<hr class="hr-primary" />
		<h2><?php echo $res['title']; ?></h2>
		
		<h4>Author: <?php echo $res['username']; ?></h4>
		<h5>Date: <?php echo $res['created']; ?></h5>
		
		<p><?php echo $res['body']; ?></p>
					
		<?php if($_SESSION['name'] == $res['username']) {?>
			<div class="btn-group btn-group-justified">
			<a class='btn' role='button' href="edit.php?id=<?php echo $res['id']; ?>">Edit</a>
			<a href='delete.php?id=<?php echo $res['id']; ?>' class="btn" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
		</div>
		
	<?php 
		}
	} ?>
	</div>
</body>
</html>
