<?php

// Make connection
include 'connect.php';

// Get user input
$rowID = $_GET['rowID'];

// Store query
$sql = "DELETE FROM madeliquids WHERE id='$rowID'";

// Run Query
if (mysqli_query($conn, $sql)) {
    header('Location: ../index.php');
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

?>