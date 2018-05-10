<?php include_once 'inc/connect.php'; ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles/reset.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
    
<div id="main-wrapper">
<div class="clearfix">

    <div id="results" class="wrapper">
        <h2>Current Stock</h2>
        <?php include 'inc/results.php'; ?>
    </div><!-- /#results -->

    <!-- Add item to DB -->
    <div id="addrow" class="wrapper">
        <h3 class="padtop">Add Row</h3>
        <form action="inc/addrow.php" method="GET">
        <p>
            <input type="text" name="name" placeholder="Name">
            <input type="text" size="4" name="qty" placeholder="Qty">
            <button type="submit">Add</button>
        </p>
        </form>
    </div>

    <!-- Delete item from DB -->
    <div id="delrow" class="wrapper">
        <h3>Delete Row</h3>
        <form action="inc/delrow.php" method="GET">
        <p>Select Row ID: 
            <input type="text" size="4" name="rowID">
            <button type="submit">Delete</button>
        </p>
        </form>
    </div>

    <!-- Change Qty -->
    <div id="editrow" class="wrapper">
        <h3>Update Row</h3>
        <form action="inc/editrow.php" method="GET">
        <p>
            <select name="name">
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
            <input type="text" size="5" name="newQty" placeholder="New Qty">
            <button type="submit">Update</button>
        </p>
        </form>
    </div>
</div><!-- /.clearfix -->

<div id="orders">
    <h3>New Order</h3>    
    <table class="formTable">
        <tr>
            <th>Date</th>
            <td><input type="date" name="date"></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><input type="text"></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><input type="text" name=""></td>
        </tr>
        <tr>
            <th>Type</th>
            <td>
                <p><input type="radio" name="size" value="10">10mL</p>
                <p><input type="radio" name="size" value="15">15mL</p>
                <p><input type="radio" name="size" value="30">30mL</p>
            </td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>
                <select>
                <?php
                // Populate drop-down with numbers (and values) 1-12
                    for ($i=1; $i<=12; $i++)
                    {
                        ?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php
                    }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Selection</th>
            <td><textarea name="selection"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit">Submit</button></td>
        </tr>
    </table>
    <h2>Recent Orders</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Username</th>
            <th>Bottled</th>
            <th>Posted</th>
        </tr>
    </table>
</div>

</div><!-- /#wrapper -->

</body>
</html>