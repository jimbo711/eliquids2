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
    ?>
</div>
<?php
// Page footer
include_once 'footer.php';
?>