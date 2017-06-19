<?php

define("DB_SERVER", "localhost");
define("DB_USER" , "root");
define("DB_PASS","1234");
define("DB_NAME", "moviedb");


$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);
    if (!$conn) {
    die ("Could not connect!");
}
$db_select = mysqli_select_db($conn,DB_NAME);
if (!$db_select) {
    die ("doesn't work dude" . mysqli_error($conn));
}

//Connection workaround -- fix later
   /* $conn1 = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);

    if (!$conn1) {
        die ("Could not connect!");
    }

    $db_select = mysqli_select_db($conn1,DB_NAME);

    if (!$db_select) {
        die ("doesn't work dude". mysqli_error($conn1));
}



//Connection workaround -- fix later
$conn2 = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);

if (!$conn2) {
    die ("Could not connect!");
}

$db_select = mysqli_select_db($conn2,DB_NAME);

if (!$db_select) {
    die ("doesn't work dude". mysqli_error($conn2));
}*/
