<?php 
// Connect to DB
require_once 'connect.php';
// Require functions
require_once 'functions.php';
// Set page title
if (isset($_GET['editorder'])) {
    $page_title = "Change Order";
} else if (isset($_GET['markdone'])) {
    $page_title = "Woops...";
}
// Set path to root
$path_home = "../";
// Page header
require_once 'header.php';
?>
<div class="container">
    <h1><?php echo $page_title; ?></h1>
    <?php
    // If mark fulfilled button was clicked
    if (isset($_GET['markdone'])) {
        // Get user input
        $fulfilled  = $_GET['edit'];
        // Check at least one box was checked
        if (count($fulfilled) > 0) {
            // Loop through array of checked boxes
            // The values will correspond to a row id which we want to update (mark fulfilled)
            foreach ($fulfilled as $order) {
                // Store query - set fulfilled column to true where row ID matches selected checkbox value
                $sql = "UPDATE orders SET fulfilled = 1 WHERE id = '$order'";
                // Run Query
                mysqli_query($conn, $sql) or die(mysqli_error($conn));
                // Store query - enter current date into 'dispatched' column
                $date = date("Y-m-d");
                $sql = "UPDATE orders SET dispatched = '$date' WHERE id = '$order'";
                // Run Query
                mysqli_query($conn, $sql) or die(mysqli_error($conn));
                // Store Query - get row from db that matches checked order
                $sql = "SELECT * FROM orders WHERE id = '$order'";
                // Store values as array
                $results = mysqli_query($conn, $sql);
                // Create an array from values
                if (mysqli_num_rows($results) > 0) {
                    // Loop through the array
                    while ($row = mysqli_fetch_array($results)){
                        // Store flavour selection as array
                        $selection = str_getcsv($row['selection']);
                        // Store order size
                        $size = $row['size'];
                        // Loop through the array
                        foreach ($selection as $choice) {
                            // Remove whitespace
                            $choice = trim($choice);
                            // store query - reduce stock
                            $sql = "UPDATE madeliquids
                                    SET qty = qty - '$size'
                                    WHERE liquidname = '$choice'";
                            // run query
                            mysqli_query($conn, $sql) or die(mysqli_error($conn));
                            // store query - increase number sold
                            $sql = "UPDATE madeliquids
                                    SET sold = sold + 1
                                    WHERE liquidname = '$choice'";
                            // run query
                            mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        }
                    }
                }
            }
            // Redirect home
            header('Location: ../index.php');
        }
    // If edit button was clicked
    } else if (isset($_GET['editorder'])) {
        // Get user input
        $ids = $_GET['edit'];
        // Check at least one box was checked
        if (count($ids) > 0) {
            // Loop through array of checked boxes
            foreach ($ids as $rowid) {
                // Query results from table
                $results = mysqli_query($conn, "SELECT * FROM orders WHERE id = '$rowid'") or die(mysqli_error($conn));
                // if one or more rows are returned
                if(mysqli_num_rows($results) > 0){
                    while($row = mysqli_fetch_array($results)){ 
                        ?>
                        <div class="row">
                            <div class="col">
                                <form action="submitchange.php" class= onsubmit="return validateOrder()" method="GET">
                                    <table class="table">
                                    <tr>
                                        <th>Date</th>
                                        <td><input type="date" class="form-control" name="date" value="<?php echo $row['date']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td><input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td><input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th>Size</th>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="size" id="radio10ml" value="10" 
                                                <?php if ($row['size'] == 10) { echo 'checked'; } ?>>
                                                <label class="form-check-label" for="radio10ml">10mL</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="size" id="radio20ml" value="15"
                                                <?php if ($row['size'] == 15) { echo 'checked'; } ?>>
                                                <label class="form-check-label" for="radio20ml">15mL</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="size" id="radio30ml" value="30"
                                                <?php if ($row['size'] == 30) { echo 'checked'; } ?>>
                                                <label class="form-check-label" for="radio30ml">30mL</label>
                                            </div>                    
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td>
                                            <input type="number" class="form-control" id="orderQty" name="orderQty" value="<?php echo $row['orderqty']; ?>" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>
                                            <textarea class="form-control" rows="4" id="address" name="address"><?php echo str_replace(", ","\r\n",$row['address']); ?></textarea>
                                        </td>
                                    </tr>
                                    <tr class="d-none">
                                        <th>Row ID</th>
                                        <td><input type="number" class="form-control" id="rowid" name="rowid" value="<?php echo $row['id']; ?>"></td>
                                    </tr>
                                    <?php
                                    // Quantity of the order
                                    $orderQty = $row['orderqty'];

                                    // Get flavour selections and put in array
                                    $selection = str_getcsv($row['selection']);
                                    
                                    // If there are less flavour selections in db than ordered
                                    if (count($selection) < $orderQty) {
                                        // if there are 3 orders, loop 3 times
                                        for ($j=0; $j<$orderQty; $j++) {
                                            // Execute the next block for each item in array
                                            foreach ($selection as $choice) {
                                                ?>
                                                <tr>
                                                    <th></th>
                                                    <td>
                                                    <?php
                                                    // If there is no selection
                                                    if ($choice == "") {
                                                        // Display default flavour select field
                                                        flavourfield("flavour[$j]", $conn);
                                                    // Else (there is a selection)
                                                    } else {
                                                        // Display the current stored selection
                                                        editFlavourField("flavour[$j]", $choice, $conn);
                                                    }
                                                    ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        }
                                    } else {
                                        // Execute the next block for each item in array
                                        foreach ($selection as $i=>$choice) {
                                            ?>
                                            <tr>
                                                <th></th>
                                                <td>
                                                <?php
                                                // If there is no selection
                                                if ($choice == "") {
                                                    // Display default flavour select field
                                                    flavourfield("flavour[$i]", $conn);
                                                // Else (there is a selection)
                                                } else {
                                                    // Display the current stored selection
                                                    editFlavourField("flavour[$i]", $choice, $conn);
                                                }
                                                ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                </table>
                                <div class="form-row">
                                    <div class="col"></div>
                                    <div class="col-5">
                                        <button type="submit" class="btn btn-primary btn-block" style="margin:-5px 0 0 0;">Submit Order</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="col"></div>
                        </div>
                        <?php
                    }
                }
            }
        }
    } else {
        // Else (nothing was selected), report and link home
        echo '<div class="alert alert-danger" role="alert">Nothing was selected.'."</div>\r\n";
        echo '<p><a href="../index.php" '.'class="btn btn-primary"'.'>'."Go Back...</a></p>\r\n";
    }
    ?>
</div>
<?php
// Page footer
include_once 'footer.php';
?>