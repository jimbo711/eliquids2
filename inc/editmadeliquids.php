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
    /*
        If ADD FLAVOUR was clicked
    */
    if (isset($_GET['addflv-btn'])) {
        // Get user input
        $newLiquidName = trim($_GET['name']);
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
    }
    /*
        If REMOVE FLAVOUR was clicked
    */
    if (isset($_GET['delflv-btn'])) {
        // Get user input
        $rowID = $_GET['rowID'];
        // Create empty error message
        $errors = "";
        // Validate input
        if (!is_numeric($rowID)) {
            $errors .= '<div class="alert alert-warning" role="alert">Invalid row ID - You must enter a number.'."</div>\r\n";
        }
        // Continue if error message is still empty
        if ($errors == "") {
            // Store query
            $sql = "DELETE FROM madeliquids WHERE id='$rowID'";
            // Run Query
            if (mysqli_query($conn, $sql)) {
                // Return home
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
    }
    // If one of the three update options were clicked
    if (isset($_GET['increase-btn']) || isset($_GET['decrease-btn']) || isset($_GET['newqty-btn'])) {
        // Get user input
        $name = "";
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
        }
        $newQty = $_GET['editqty'];
        // Create empty error message
        $errors = "";
        // validate name field (only letters, dashes and spaces)
        if($name == ""){
            $errors .= '<div class="alert alert-warning" role="alert">Blank Field - You must choose a flavour to update.'."</div>\r\n";
        }
        // vaildate qty (must be numeric and not empty)
        if (!is_numeric($newQty)) {
            $errors .= '<div class="alert alert-warning" role="alert">Invalid Quantity - Quantity must be a number.'."</div>\r\n";
        }
        // Continue if error message is still empty
        if ($errors == "") {
            /*
                If INCREASE was clicked
            */
            if (isset($_GET['increase-btn'])) {
                $sql = "UPDATE madeliquids SET qty = qty + $newQty WHERE liquidname='$name'";
                if (mysqli_query($conn, $sql)) {
                    header('Location: ../index.php');
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            }
            /*
                If DECREASE was clicked
            */
            if (isset($_GET['decrease-btn'])) {
                $sql = "UPDATE madeliquids SET qty = qty - $newQty WHERE liquidname='$name'";
                if (mysqli_query($conn, $sql)) {
                    header('Location: ../index.php');
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            }
            /*
                If NEW QTY was clicked
            */
            if (isset($_GET['newqty-btn'])) {
                $sql = "UPDATE madeliquids SET qty = $newQty WHERE liquidname='$name'";
                if (mysqli_query($conn, $sql)) {
                    header('Location: ../index.php');
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            }
        } else {
            // Else (there were errors), report and link home
            echo '<div class="alert alert-danger" role="alert">Operation aborted.  See Below:'."</div>\r\n";
            echo $errors;
            echo '<p><a href="../index.php" '.'class="btn btn-primary"'.'>'."Go Back...</a></p>\r\n";
        }
    }
    ?>
</div>
<?php
// Page footer
include_once 'footer.php';
?>