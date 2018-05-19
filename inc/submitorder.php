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
    // Start session so we can access session variable
    session_start();
    // Get user input
    // But this time we're grabbing all the fields that are named as part of the flavour[] array
    $flavours = "";
    // Check if any flavours were selected
    if (isset($_GET['flavour'])) {
        $flavours  = $_GET['flavour'];
    }
    // Also get the session variables holding the data from the previous form.
    $date      = $_SESSION['date'];
    $name      = $_SESSION['name'];
    $username  = $_SESSION['username'];
    $size      = $_SESSION['size'];
    $orderQty  = $_SESSION['orderQty'];
    // Create empty error message
    $errors = "";
    // Create a string to display the contents of flavour[] array
    $selectionString = "";
    // If flavours were selected
    if ($flavours !== "") {
        // Loop through the flavour[] array
        foreach ($flavours as $choice) {
            // if the selection is blank or not set, append $errors message
            if ($choice == "" || !isset($choice)) {
                // Unless the same message already exists
                if ($errors !== '<div class="alert alert-warning" role="alert">At least one field was not set - all fields must be filled.'."</div>\r\n") {
                    $errors .= '<div class="alert alert-warning" role="alert">At least one field was not set - all fields must be filled.'."</div>\r\n";
                }
            } else {
                if ($selectionString == "") {
                    // if the string is empty, append it
                    $selectionString .= $choice;
                } else {
                    // else append it with a comma first
                    $selectionString .= ', '.$choice;
                }
            }
        }
    } else {
        // No flavours were selected
        $errors .= '<div class="alert alert-warning" role="alert">No flavours were selected.'."</div>\r\n";
    }
    // prevent sql injection
    $selectionString  = mysqli_real_escape_string($conn, $selectionString);
    // change chars from html to equiv
    $selectionString = htmlspecialchars($selectionString);
    // Check that there are at least as many words in the selectionString
    //      as number of bottles ordered. (optional, possibly unnessessary step)
    if (str_word_count($selectionString) < $orderQty) {
        $errors .= '<div class="alert alert-warning" role="alert">Did you select all '.$orderQty.' flavours?'."</div>\r\n";
    }
    // Continue if error message is still empty
    if ($errors == "") {
        // store query
        $sql = 
            // insert inputs for new order into orders table
            "INSERT INTO orders (`date`, `name`, `username`, `size`, `orderqty`, `selection`) 
            VALUES ('$date', '$name', '$username', '$size', '$orderQty', '$selectionString')";
        // Run Query
        if (mysqli_query($conn, $sql)) {
            // Reduce Stock in madeliquids table and add to sold
            foreach ($flavours as $choice) {
                // store query - reduce stock
                $sql = "UPDATE madeliquids
                        SET qty = qty - $size
                        WHERE liquidname = '$choice'";
                // run query
                mysqli_query($conn, $sql);
                // store query - increase number sold
                $sql = "UPDATE madeliquids
                        SET sold = sold + 1
                        WHERE liquidname = '$choice'";
                // run query
                mysqli_query($conn, $sql);
            }
            // Redirect home afterwards
            header('Location: ../index.php');
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        // Else (there were errors), report and link to previous page
        echo '<div class="alert alert-danger" role="alert">Operation aborted.  See Below:'."</div>\r\n";
        echo $errors;
        echo '<p><a href="'.$_SESSION['goback'].'" '.'class="btn btn-primary"'.'>'."Go Back...</a></p>\r\n";
    }
    ?>
</div>
<?php
// Page footer
include_once 'footer.php';
?>