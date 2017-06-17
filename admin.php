<?php require_once ("functions.php");
require_once("session.php");
require_once("ImageResizer.php");

if (!logged_in()) {
    redirect_to("index.php"); // redirect if not logged in
}

define("MAX_SIZE", "3000"); //definition of may file size
$upmsg=[]; // for error messages

if(isset($_POST['submitMovie'])) {
    $text = $_POST['text'];
    $text = htmlspecialchars($_POST['text']);
    $text = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['text'])));
    $text = prep($_POST['text']);
    $movieName = trim(prep($_POST['movieName']));
    $description = trim(prep($_POST['Description']));
    $genre = $_POST['Genre'];
    $year = $_POST['Year'];
    $file = $_FILES['Image'] ['tmp_name']; //handles the image
    $imageName = $_FILES['Image']['name']; // handles the image
    //Checking the size and type of the image-file
    $image_type = getimagesize($file); // will know here if an image has been inserted or not
    if ($image_type[2] = 1 || $image_type[2] = 2 || $image_type[2] = 3) {
        $size = filesize($_FILES['Image']['tmp_name']);
        if ($size < MAX_SIZE * 1024) { //checks if the size is too large
            $prefix = uniqid();
            $iName = $prefix . "_" . $imageName;
            $newName = "img/" . $iName; // image name + unique ID
            $resOBJ = new ImageResizer(); //referencing to ImageResizer.php
            $resOBJ->load($file);// from ImageResizer.php
            if ($_POST['wsize'] && $_POST['hsize']) {//defines with and height
                $width = $_POST['wsize'];
                $height = $_POST['hsize'];
                $resOBJ->resize($width, $height);
                array_push($upmsg, "Image resized to $width and $height px");
            } elseif ($_POST['wsize']) {
                $width = $_POST['wsize'];
                $resOBJ->resizeToWidth($width);
                array_push($upmsg, "Image resized to W of $width px");
            } elseif ($_POST['height']) {
                $height = $_POST['height'];
                $resOBJ->resizeToHeight($height);
                array_push($upmsg, "Image resized to H of $height px");
            } elseif ($_POST['ssize']) {
                $scale = $_POST['ssize'];
                $resOBJ->scale($scale);
                array_push($upmsg, "Image resized to scale of $scale %");
            }
        } else {
            array_push($upmsg, "Image is too big: MAY 3 Mb");
        }
    } else {
        array_push($upmsg, "Unknown image type");
    }

    $resOBJ->resizeToWidth(350); // uses resizeToWidth (will keep scale)
    $resOBJ->save($newName);
    $query = "INSERT INTO movie (MovieName, Genre, Description, Year, Image) VALUES ('$movieName','$genre','$description','$year','$iName')";
    mysqli_query($conn, $query);
    array_push($upmsg, "New movie added");


}

?>

<!DOCTYPE HTML>

<html>
<head>
    <title>Movie database</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />

    <!--script stuff-->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
    <script src="js/index.js"></script>
</head>
<body>

<!-- Header -->
<header id="header">
    <a href="index.php" class="logo">Another type of movie</a>
    </div></header>

<!-- Two -->
<section id="two" class="wrapper style1 special">
    <div class="inner">
        <?php if (!empty($upmsg)): ?>
            <div class="panel">
                <ul>
                    <li><?php echo implode('</li><li> ',$upmsg);?></li> <!-- we want to display the errors here -->
                </ul>
            </div>
        <?php endif;?>
        <div class="container">
            <br/><br/>
            Add a new movie
            <br>
            <!-- The admin can add a movie -->
            <form action="" method="post" enctype="multipart/form-data" name="Add a Menu-item">
                <br>
                <input type="text" name="movieName" placeholder="Movie name" required>
                <br><br>
                <input type="text" name="Genre" placeholder="Genre" required>
                <br><br>
                <input type="text" name="Description" placeholder="Description" required>
                <br><br>
                <input type="text" name="Year" maxlength="4" size="5" placeholder="Release year" required>
                <br><br>
                <a>Upload image:</a> <input type="file" name="Image" placeholder="Upload image" required>
                <br><br>
                <input type="submit" name="submitMovie" value="Add"/>
            </form>
            <br><br><br>
            <form action="logout.php" class="inline">
                <button class="float-left submit-button" >Logout</button>
            </form>
            <br/><br/>
        </div>
    </div>
</section>
<footer id="footer">
    <div class="copyright">
        We donut understand puns - Sorry.<br>
        &copy; By Sømaja.
    </div>
</footer>
</body>
</html>