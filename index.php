
<?php //admin login
require_once("connection.php");
require_once("session.php");
require_once("functions.php");
if (logged_in()) {
    redirect_to("admin.php"); //redirects if already logged in
}

$message=[];

// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
    $username = trim(mysqli_real_escape_string($conn, $_POST['User'])); //sets the $username equal to User
    $password = trim(mysqli_real_escape_string($conn,$_POST['Pass'])); // sets the $password equal to Pass

    $query = "SELECT ID, User, Pass FROM login WHERE User = '".$username."' LIMIT 1"; // checks for the user
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1)
    {
        // username/password authenticated
        // and only 1 match
        $found_user = mysqli_fetch_array($result);
        if(password_verify($password, $found_user['Pass'])){ //checks if the entered password fits the one stored in the db
            $_SESSION['User_id'] = $found_user['ID'];
            $_SESSION['User'] = $found_user['users'];
            redirect_to("admin.php");
        }
        else {
            // username/password combo was not found in the database
            array_push($message, "Could not log in.<br>Username/password combination incorrect.<br>
					Please make sure your capslock is off and try again.");
        }
    }
    else if(mysqli_num_rows($result) < 1){
        array_push($message, "SQL query with no results - Romaine calm.");
    }
} else { // Form has not been submitted.
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        array_push($message, "You are now logged out. Another one bites the crust.");
    }
}

if (isset($conn)){mysqli_close($conn);}
?>


<html>
    <head>
        <title>Special Movie Database</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
    </head>


    <body>
    <!-- Header -->
    <header>
        <div id="header">
        <a href="index.php" class="logo">A Movie Database</a>
        </div>
    </header>

    <!-- Two -->
    <section id="two" class="wrapper style1 special">
        <div class="inner">
            <?php if (!empty($message)): ?>
                <div class="panel">
                    <ul>
                        <li><?php echo implode('</li><li> ',$message);?></li> <!-- we want to display the errors here -->
                    </ul>
                </div>
            <?php endif;?>

            <form action="" method="post">
                Username:
                <input type="text" name="User" maxlength="30" value="" placeholder="Enter you username" required />
                Password:
                <input type="password" name="Pass" maxlength="30" value="" placeholder="Enter you password" required/>
                <input type="submit" name="submit" value="Login" />
            </form>

            <div id="content">
                <?php readAllMovies() ?> <!-- displays the function //the main part of the site, shows the movies-->
            </div>

        </div>
    </section>

        <footer id="footer">
            <div class="copyright">
                For the sake of life<br>
                &copy; By Sømaja.
            </div>
        </footer>
    </body>
</html>





