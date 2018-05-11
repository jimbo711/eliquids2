<?php 

include 'inc/connect.php';

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

// Create a string to display the contents of flavour[] array
$selectionString = "";
foreach ($flavours as $choice) {
    if ($selectionString == "") {
        $selectionString .= $choice;
    } else {
        $selectionString .= ', '.$choice;
    } 
}

// prevent sql injection
$date = mysqli_real_escape_string($conn, $date);
$name  = mysqli_real_escape_string($conn, $name);
$username  = mysqli_real_escape_string($conn, $username);
$size  = mysqli_real_escape_string($conn, $size);
$orderQty  = mysqli_real_escape_string($conn, $orderQty);
$selectionString  = mysqli_real_escape_string($conn, $selectionString);

// change chars from html to equiv
$date = htmlspecialchars($date);
$name = htmlspecialchars($name);
$username = htmlspecialchars($username);
$size = htmlspecialchars($size);
$orderQty = htmlspecialchars($orderQty);
$selectionString = htmlspecialchars($selectionString);

// Display data
echo $date.'<br>';
echo $name.'<br>';
echo $username.'<br>';
echo $size.'<br>';
echo $orderQty.'<br>';
echo $selectionString.'<br><br>';

// store query in var
$sql = 
    // insert inputs into these columns
    "INSERT INTO orders (`date`, `name`, `username`, `size`, `orderqty`, `selection`) 
     VALUES ('$date', '$name', '$username', '$size', '$orderQty', '$selectionString')";

// Run Query
if (mysqli_query($conn, $sql)) {
    echo 'row added!';
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
?>