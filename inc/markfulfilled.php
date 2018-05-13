<?php

// Make connection
include 'connect.php';

// Get user input
$fulfilled  = $_GET['fulfilled'];

// Loop through array of checked boxes
// The values will correspond to a row id which we want to update (mark fulfilled)
foreach ($fulfilled as $order) {
    // Store query - set fulfilled column to true where row ID matches selected checkbox value
    $sql = "UPDATE orders
            SET fulfilled = 1 
            WHERE id = '$order'";

    // Run Query
    mysqli_query($conn, $sql);

    // Store query - enter current date into 'dispatched' column
    $date = date("Y-m-d");
    $sql = "UPDATE orders
            SET dispatched = '$date' 
            WHERE id = '$order'";

    // Run Query
    mysqli_query($conn, $sql);
}

// Redirect home
header('Location: ../index.php');



?>