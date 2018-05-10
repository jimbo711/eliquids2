<?php

// Make connection
include 'connect.php';

// Get user input
$name = $_GET['name'];
$newQty = $_GET['newQty'];

// Store query
$sql = "UPDATE madeliquids
        SET qty='$newQty' 
        WHERE liquidname='$name'";

// Run Query
if (mysqli_query($conn, $sql)) {
    header('Location: ../index.php');
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

?>