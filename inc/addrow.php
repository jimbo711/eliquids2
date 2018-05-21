<?php 
// Connect to DB
require_once 'connect.php'; 
// Set page title
$page_title = "Woops...";
// Set path to root
$path_home = "../";
// Page header
require_once 'header.php';
?>
<div class="container">
    <h1>Woops...</h1>
    <?php

    // Store form inputs in vars
    $newLiquidName = $_GET['name'];
    $newLiquidQty = $_GET['qty'];

    // Create empty error message
    $errors = "";

    // validate name field (only letters, dashes and spaces)
    if(!preg_match("/^[a-zA-Z\'\-\040\.]+$/", $newLiquidName)){
        $errors .= '<div class="alert alert-warning" role="alert">Invalid Name - Only letters, dashes and spaces are allowed.'."</div>\r\n";
    }
    // vaildate qty (must be numeric and not empty)
    if (!is_numeric($newLiquidQty)) {
        $errors .= '<div class="alert alert-warning" role="alert">Invalid Quantity - Must be a number and not blank.'."</div>\r\n";
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
        echo '<div class="alert alert-danger" role="alert">Operation aborted.  See Below:'."</div>\r\n";
        echo $errors;
        echo '<p><a href="../index.php" '.'class="btn btn-primary"'.'>'."Go Back...</a></p>\r\n";
    }
    ?>
</div>
<?php
// Page footer
include_once 'footer.php';
?>