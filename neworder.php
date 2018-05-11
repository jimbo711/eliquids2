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
<div id="main-wrapper">

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
        for ($i=0; $i<$orderQty; $i++)
        {
            ?>
                <li>
                <!-- Each is named as part of the flavour[] array -->
                <select name="flavour[<?php echo $i; ?>]">
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