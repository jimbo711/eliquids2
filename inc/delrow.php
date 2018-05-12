<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" type="text/css" href="../styles/reset.css">
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>
<div id="main-wrapper" class="error">
<h2>Woops...</h2>
<?php

// Make connection
include 'connect.php';

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
    echo "<p>Operation aborted due to errors.  See Below:</p>\r\n";
    echo $errors;
    echo '<p><a href="../index.php">'."Go Back...</a></p>\r\n";
}
?>
</div><!-- /#main-wrapper -->
</body>
</html>