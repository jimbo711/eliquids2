<?php 

include 'connect.php';

session_start();

// Get user input
// But this time we're grabbing all the fields that are named as part of the flavour[] array
$flavours  = $_GET['flavour'];

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
// Loop through the flavour[] array
foreach ($flavours as $choice) {
    // if the selection is blank or not set, add to $errors
    if ($choice == "" || !isset($choice)) {
        $errors .= "<p>A field wasn't set - all fields must be filled.</p>\r\n";
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
// prevent sql injection
$selectionString  = mysqli_real_escape_string($conn, $selectionString);
// change chars from html to equiv
$selectionString = htmlspecialchars($selectionString);

// Check that there are at least as many words in the selectionString
//      as number of bottles ordered. (optional, possibly unnessessary step)
if (str_word_count($selectionString) < $orderQty) {
    $errors .= "<p>There doesn't seem to be enough selections.  Did you select all ".$orderQty." flavours?</p>\r\n";
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
    // Else (there were errors), report and link home
    echo "<p>Operation aborted due to errors.  See Below:</p>\r\n";
    echo $errors;
    echo '<p><a href="../index.php">'."Go Back...</a></p>\r\n";
}


?>