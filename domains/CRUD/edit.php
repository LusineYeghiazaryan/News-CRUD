<?php session_start(); 
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

// including the database connection file
include_once("connection.php");

if(isset($_POST['id']))
{	
	$id = $_POST['id'];

	$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
	$article = filter_var($_POST['article'], FILTER_SANITIZE_STRING);
	$date = date('Y-m-d H:i:s');
	$userId = $_SESSION['id'];
	
	//updating the table
	$result = mysqli_query($conn, "UPDATE news SET title='$title', body='$article' WHERE id=$id");
		
	//redirectig to the display page. In our case, it is view.php
	header("Location: view.php");
	
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($conn, "SELECT * FROM news WHERE id=$id");

$res = mysqli_fetch_array($result);

$title = $res['title'];
$body = $res['body'];

?>
<html>
<head>
	<title>Edit Article</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="jumbotron text-center">
		<h1>Edit Article</h1>
	</div>
	<div class="container">
	<div class="btn-group btn-group-justified">
		<a href="index.php" class="btn">Home</a>
		<a href="view.php" class="btn">My Articles</a>
		<a href="logout.php" class="btn">Logout</a>
	</div>
		
		<h2>Edit Article</h2>	
		<form name="registration" method="post" action="edit.php">
			<div class="form-group">
				<label for="title">Title:</label>
				<input type="text" class="form-control" name="title" value="<?php echo $title;?>" required="required">
			</div>		
			<div class="form-group"> 
				<label for="article">Article:</label>
				<textarea class="form-control" rows="5" id="article" name="article" required="required"><?php echo $body;?></textarea>
			</div>
			<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
			<button type="submit" class="btn btn-default">Update</button>
		</form>
		
	</body>
</html>