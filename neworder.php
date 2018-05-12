<?php include_once 'inc/connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Order</title>
    <link rel="stylesheet" type="text/css" href="styles/reset.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
<div id="main-wrapper" class="error">

<?php

// Start a session so we can use the following data on the next page
session_start();

// Get user input
$date     = $_GET['date'];
$name     = $_GET['name'];
$username = $_GET['username'];
$size     = $_GET['size'];
$orderQty = $_GET['orderQty'];

// Set session variables
$_SESSION['date']     = $date;
$_SESSION['name']     = $name;
$_SESSION['username'] = $username;
$_SESSION['size']     = $size;
$_SESSION['orderQty'] = $orderQty;

// Create empty error message
$errors = "";

// validate name field (only letters, dashes and spaces)
if ($name == "") {
    $errors .= "<p>You must enter the customer name.</p>\r\n";
} else if(!preg_match("/^[a-zA-Z\'\-\040\.]+$/", $name)){
    $errors .= "<p>Invalid name - Only letters, dashes and spaces are allowed.</p>\r\n";
}
// validate size field (must be set and must be a number)
if(!isset($size) || !is_numeric($size)) {
    $errors .= "<p>You must select a bottle size.</p>\r\n";
}
// validate orderQty (must be set, not blank and must be a number)
if(!isset($orderQty) || $orderQty == "") {
    $errors .= "<p>You must select an order quantity.</p>\r\n";
} else if(!is_numeric($orderQty)) {
    $errors .= "<p>Invalid order quantity - must be a number.</p>\r\n";
}

// Check for errors
if ($errors !== "") {
    // If there are errors. Exit the script here, report errors and link home.
    echo '<h2>Woops...</h2>';
    exit($errors.'<p><a href="index.php">'."Go Back...</a></p>\r\n");
}
?>

<h2>New Order</h2>
<!-- Display User Input -->
<table>
    <tr>
        <th>Date of Purchase:</th>
        <td><?php echo $date; ?></td>
    </tr>
    <tr>
        <th>Customer Name:</th>
        <td><?php echo $name; ?></td>
    </tr>
    <tr>
        <th>ebay User ID:</th>
        <td><?php echo $username; ?></td>
    </tr>
    <tr>
        <th>Bottle Size:</th>
        <td><?php echo $size; ?>mL</td>
    </tr>
    <tr>
        <th>Order Quantity:</th>
        <td><?php echo $orderQty; ?></td>
    </tr>
</table>

<div id="flavourSelection">
    <h3>Flavour Selection:</h3>
    <ul>
        <form action="inc/submitorder.php" method="GET">
        <?php
        // Create a number of selection fields equal to the order quantity
        for ($i=0; $i<$orderQty; $i++) {
        ?>
            <li>
            <?php // Each is named as part of the flavour[] array ?>
            <select name="flavour[<?php echo $i; ?>]">
                <?php // First option is blank ?>
                <option></option>
                <?php
                // Query all the liquid names
                $sql = "SELECT liquidname FROM madeliquids";
                $result = mysqli_query($conn, $sql) 
                        or die("Select field query failed: ".mysqli_error($conn));
                // Make them into an array and loop through
                while ($row=mysqli_fetch_array($result)) {
                    $liquidname = $row["liquidname"];
                    // Create an option in the select feild for each liquid name
                    echo "<option>".$liquidname."</option>\r\n";
                }
                ?>
            </select>
            </li>
        <?php
        }
        ?>
        <li><button type="submit">Confirm</button></li>
        </form>
    </ul>
</div>

</div><!-- /#main-wrapper -->
</body>
</html>