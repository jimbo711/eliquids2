<?php

include 'connect.php';

/***********************************
    Add item/row to Database
***********************************/

// Store form inputs in vars
$newLiquidName = $_GET['name'];
$newLiquidQty = $_GET['qty'];

// Create empty error message
$errors = "";

// validate name field (only letters, dashes and spaces)
if(!preg_match("/^[a-zA-Z\'\-\040\.]+$/", $newLiquidName)){
    $errors .= '<p>Invalid name - Only letters, dashes and spaces are allowed.</p>';
}
// vaildate qty (must be numeric and not empty)
if (!is_numeric($newLiquidQty)) {
    $errors .= '<p>Invalid qty - Qty must be a number.</p>';
}

// Continue if error message is still empty
if ($errors == "") {

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

} else {
    // Else (there were errors), report and link home
    echo '<p>Operation aborted due to errors.  See Below:</p>';
    echo $errors;
    echo '<p><a href="../index.php">Go Back...</a></p>';
}
?>