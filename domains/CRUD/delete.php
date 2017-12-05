<?php session_start(); 

if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

//including the database connection file
include("connection.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result=mysqli_query($conn, "DELETE FROM news WHERE id=$id");

//redirecting to the display page (view.php in our case)
header("Location:view.php");
?>

