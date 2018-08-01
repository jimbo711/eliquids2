<?php 
// Start a session so we can use the following data on the next page
    session_start();
// Connect to DB
require_once 'inc/connect.php';
// PHP functions
require_once 'inc/functions.php';
// Assign page title
$page_title = "New Order";
// Page header
require_once 'inc/header.php';
?>
<div class="container">
    <?php
    
    // Get user input
    $date     = $_GET['date'];
    $name     = $_GET['name'];
    $username = $_GET['username'];
    $orderQty = $_GET['orderQty'];
    $address  = $_GET['address'];
    $size     = "";                 // Size is selected via a radio button field in new order form.
    if (isset($_GET['size'])) {     // Only assign input to $size if an option was selected.
        $size = $_GET['size'];      // Neglecting this was allowing a uglier looking error to display.
    }
    // prevent sql injection
    $date = mysqli_real_escape_string($conn, $date);
    $name  = mysqli_real_escape_string($conn, $name);
    $username  = mysqli_real_escape_string($conn, $username);
    $size  = mysqli_real_escape_string($conn, $size);
    $orderQty  = mysqli_real_escape_string($conn, $orderQty);
    $address  = mysqli_real_escape_string($conn, $address);
    // change chars from html to equiv
    $date = htmlspecialchars($date);
    $name = htmlspecialchars($name);
    $username = htmlspecialchars($username);
    $size = htmlspecialchars($size);
    $orderQty = htmlspecialchars($orderQty);
    $address = htmlspecialchars($address);
    // Create empty error message
    $errors = "";
    // validate name field (only letters, dashes and spaces)
    if ($name == "") {
        $errors .= '<div class="alert alert-warning" role="alert">You must enter the customer name.'."</div>\r\n";
    } /*else if(!preg_match("/^[a-zA-Z\'\-\040\.]+$/", $name)){
        $errors .= '<div class="alert alert-warning" role="alert">Invalid name - Only letters, dashes and spaces are allowed.'."</div>\r\n";
    }*/
    // validate size field (must be set and must be a number)
    if($size == "" || !is_numeric($size)) {
        $errors .= '<div class="alert alert-warning" role="alert">You must select a bottle size.'."</div>\r\n";
    }
    // validate orderQty (must be set, not blank and must be a number)
    if(!isset($orderQty) || $orderQty == "") {
        $errors .= '<div class="alert alert-warning" role="alert">You must select an order quantity.'."</div>\r\n";
    } else if(!is_numeric($orderQty)) {
        $errors .= '<div class="alert alert-warning" role="alert">Invalid order quantity - must be a number.'."</div>\r\n";
    }
    // validate address
    //  
    
    // Check for errors
    if ($errors !== "") {
        // If there are errors. Exit the script here, report errors and link home.
        echo '<h2>Woops...</h2>';
        exit('<div class="alert alert-danger" role="alert">Operation aborted.  See Below:'."</div>\r\n"
            .$errors
            .'<p><a href="index.php" '.'class="btn btn-primary"'.'>'."Go Back...</a></p>\r\n");
    } else {
        // Set session variables for use on the next page
        $_SESSION['date']     = $date;
        $_SESSION['name']     = $name;
        $_SESSION['username'] = $username;
        $_SESSION['size']     = $size;
        $_SESSION['orderQty'] = $orderQty;
        $_SESSION['address']  = $address;
        $_SESSION['goback']   = $_SERVER['REQUEST_URI']; // Current url path
    }
    ?>

    <h1>New Order</h1>
    <!-- Display User Input -->
    <table class="table">
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
        <tr>
            <th>Shipping Address:</th>
            <td><?php echo $address; ?></td>
        </tr>
    </table>

    <div id="flavourSelection">
        <h3>Flavour Selection:</h3>
        <form action="inc/submitorder.php" method="GET">
            <div class="form-row">
                <div class="col">
                    <input type="checkbox" name="nochoice" value="1" class="mr-2">Not Chosen Yet
                </div>
                <div class="col"></div>
            </div>
            <?php
            // Create a number of selection fields equal to the order quantity
            for ($i=0; $i<$orderQty; $i++) {
                // Populate with flavours from current stock?>
                <div class="form-row">
                    <div class="col-6">
                        <?php flavourfield("flavour[$i]", $conn); ?>
                    </div>
                    <div class="col"></div>
                </div>
            <?php
            }
            ?>
            <div class="form-row">
                <div class="col-3"><a href="index.php" class="btn btn-danger btn-block" role="button">Cancel</a></div>
                <div class="col-3"><button type="submit" class="btn btn-primary btn-block">Confirm</button></div>
                <div class="col"></div>
            </div>
        </form>
    </div>
</div>
<?php
// Page footer
include_once 'inc/footer.php';
?>