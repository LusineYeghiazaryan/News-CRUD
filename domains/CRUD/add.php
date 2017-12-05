<?php session_start(); 

if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

//including the database connection file
include_once("connection.php");

if(isset($_POST['title'], $_POST['article'])) {	
	$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
	$article = filter_var($_POST['article'], FILTER_SANITIZE_STRING);
	$date = date('Y-m-d H:i:s');
	$userId = $_SESSION['id'];
			
	//insert data to database	
	$result = mysqli_query($conn, "INSERT INTO news(title, body, created, author) VALUES('$title','$article','$date', '$userId')");
		
	header('Location: view.php');
}
?>