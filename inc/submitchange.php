<?php 
// Connect to DB
require_once 'connect.php';
// Require functions
require_once 'functions.php';
// Set page title
$page_title = "Change Order";
// Set path to root
$path_home = "../";
// Get user input
$rowid    = $_GET['rowid']; // from hidden field
$date     = $_GET['date'];
$name     = $_GET['name'];
$username = $_GET['username'];
$orderQty = $_GET['orderQty'];
$address  = $_GET['address'];
$size     = "";                 // Size is selected via a radio button field in new order form.
if (isset($_GET['size'])) {     // Only assign input to $size if an option was selected.
    $size = $_GET['size'];      // Neglecting this was allowing a uglier looking error to display.
}
$flavours = "";
// Check if any flavours were selected
if (isset($_GET['flavour'])) {
    $flavours = $_GET['flavour'];
}
// Create empty error msg
$errors = "";
// Create string for flavour selection
$selectionString = "";
// If the number of selections is equal to order quantity
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

// Continue if error message is still empty
if ($errors == "") {
    // Remove $name from $address if it's been prepended.
    $address = trim(str_replace($name, "", $address));
    // store query
    // Update db table columns with data from from
    $sql = 
        "UPDATE orders SET 
        `date` = '$date', 
        `name` = '$name', 
        `username` = '$username', 
        `size` = '$size', 
        `orderqty` = '$orderQty', 
        `selection` = '$selectionString', 
        `address` = '$address' 
        WHERE `id` = $rowid;";
    // Run Query
    if (mysqli_query($conn, $sql)) {
        // Redirect home
        echo header('Location: ../index.php');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // Else (there were errors)
    // Page header
    require_once 'header.php';
    ?>
    <div class="container">
        <h1>Woops...</h1>
        <?php
    // report and link to previous page
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