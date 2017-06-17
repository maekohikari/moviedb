<?php require_once("connection.php");

function readAllMovies()
{
    global $conn;
    $sqlMovies = "SELECT MovieName, Genre, Description, Year, Image FROM movie"; /*SELECT column_name FROM table_name*/
    $resultMovies = $conn->query($sqlMovies);

    if ($resultMovies->num_rows > 0) {
        // output data of each row
        while($rowMovies = $resultMovies->fetch_assoc()) {
            echo $rowMovies["movieName"] . "(" . $rowMovies["Year"]. ")" . "<br>" .
                $rowMovies["Genre"] . "<br>" .
                $rowMovies["Description"] . "<br>" ;
            echo '<img src="img/'.$rowMovies["Image"] . '" alt="movie poster"><br><br><br>';
            ;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
}

	function redirect_to($location) {
        header("Location: {$location}");
        exit;
    }

function text_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function prep($value) {
    global $conn;
    $value = mysqli_real_escape_string($conn,htmlspecialchars(trim($value)));
    return $value;
}

function e($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8', false);
}

//salt adding to password
//define("MAX_LENGTH", 6);
//
//function generateHashWithSalt($password) {
//    $intermediateSalt = md5(uniqid(rand(), true));
//    $salt = substr($intermediateSalt, 0, MAX_LENGTH);
//    return hash("sha256", $password . $salt);
//}

?>