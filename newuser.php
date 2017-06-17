<?php require_once("functions.php");

$message = [];
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.

	// perform validations on the form data
	$username = trim(mysqli_real_escape_string($conn, $_POST['User']));
	$password = trim(mysqli_real_escape_string($conn, $_POST['Pass']));
    $iterations = ['cost' => 15];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

	$query = "INSERT INTO login (User, Pass) VALUES ('{$username}','{$hashed_password}')";
	$result = mysqli_query($conn, $query);
		if ($result) {
			array_push($message, "User created");
		} else {
			array_push($message, "User could not be created");
		}
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Movie Database Create a new user</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
</head>
<body>

<!-- Header -->
<header id="header">
	<a href="index.php" class="logo">Movie Database</a>
	</div></header>

<!-- Two -->
<section id="two" class="wrapper style1 special">
	<div class="inner">
		<h2>Will you be the one?</h2>
		<?php if (!empty($message)): ?>
			<div class="panel">
				<ul>
					<li><?php echo implode('</li><li>',$message);?></li> <!-- we want to display the errors here -->
				</ul>
			</div>
		<?php endif;?>
		<br/><br/>
		Create a new Admin user
		<br/><br/>
		<form action="" method="post">
			Username:
			<input type="text" name="User" maxlength="30" value="" placeholder="Enter you new username"  />
			Password:
			<input type="password" name="Pass" maxlength="30" value="" placeholder="Enter you new password"/><br><br>
			<input type="submit" name="submit" value="Create" />
		</form>

		<br/><br/>
	</div>
</section>
<footer id="footer">
	<div class="copyright">
		For the sake of life<br>
		&copy; By Sømaja.
	</div>
</footer>
<!--script stuff-->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>
</html>
<?php
if (isset($conn)){mysqli_close($conn);}
?>
