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
    $name = "";
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
    }
    $newQty = $_GET['newQty'];
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