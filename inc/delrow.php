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
    <div class="row">
        <div class="col"></div>
        <div class="col-10 mx-auto">
        <h1>Woops...</h1>
        <?php
        // Get user input
        $rowID = $_GET['rowID'];
        // Create empty error message
        $errors = "";
        // Validate input
        if (!is_numeric($rowID)) {
            $errors .= "<p>Invalid row ID - You must enter a number.</p>\r\n";
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
            echo "<p>Operation aborted.  See Below:</p>\r\n";
            echo $errors;
            echo '<p><a href="../index.php" '.'class="btn btn-primary"'.'>'."Go Back...</a></p>\r\n";
        }
        ?>
        </div>
        <div class="col"></div>
    </div>
</div>
<?php
// Page footer
include_once 'footer.php';
?>