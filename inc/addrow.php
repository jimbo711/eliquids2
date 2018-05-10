<?php

include 'connect.php';

/***********************************
    Add item/row to Database
***********************************/

// Store form inputs in vars
$newLiquidName = $_GET['name'];
$newLiquidQty = $_GET['qty'];

// change chars from html to equiv
$newLiquidName = htmlspecialchars($newLiquidName);
$newLiquidQty = htmlspecialchars($newLiquidQty);

// prevent sql injection
$newLiquidName = mysqli_real_escape_string($conn, $newLiquidName);
$newLiquidQty  = mysqli_real_escape_string($conn, $newLiquidQty);

// store query in var
$sql = 
    // insert inputs into these columns
    "INSERT INTO madeliquids (`liquidname`, `qty`) 
     VALUES ('$newLiquidName', '$newLiquidQty')";

// Run Query
if (mysqli_query($conn, $sql)) {
    header('Location: ../index.php');
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

?>