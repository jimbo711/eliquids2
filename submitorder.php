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

// Display data
echo $date.'<br>';
echo $name.'<br>';
echo $username.'<br>';
echo $size.'<br>';
echo $orderQty.'<br>';
print_r($flavours);

// 


// Loop through the array and do something with each entry
//foreach ($flavours as $choice) {
    
//

?>