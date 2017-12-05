<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($conn, "SELECT * FROM news WHERE author=".$_SESSION['id']." ORDER BY id DESC")
					or die("Could not execute the select query.");
?>
<html>
<head>
	<title>My Articles</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="jumbotron text-center">
		<h1>My Articles</h1>
	</div>
	<div class="container">
	<div class="btn-group btn-group-justified">
		<a href="index.php" class="btn">Home</a>
		<a href="add.html" class="btn">Add New Article</a>
		<a href="logout.php" class="btn">Logout</a>
	</div>

	
	<table class="table table-striped">
    <thead>
		<tr>
			<th>Title</th>
			<th>Article</th>
			<th>Created Date</th>
			<th>Update</th>
		</tr>
    </thead>
    <tbody>
		<?php
		while($res = mysqli_fetch_array($result)) {		
			echo "<tr>";
			echo "<th>".$res['title']."</th>";
			echo "<th>".$res['body']."</th>";
			echo "<th>".$res['created']."</th>";	
			echo "<th><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></th>";		
		}
		?>
	    </tbody>
  </table>	
</body>
</html>
