<?php

/***********************************
    Make Connection to Database
***********************************/

// Database connection (host, username, pwd)
$conn = mysqli_connect("localhost", "root", "");

// If connection isn't returning true
if (!$conn) {
    // present error
    die("Error connecting to database: ".mysqli_connect_error());
}
// Check for errors
if (mysqli_connect_errno()) {
    // present error
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Select the table to work with
mysqli_select_db($conn, "eliquid") or die(mysqli_error($conn));

?>