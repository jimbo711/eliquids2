<?php include_once 'inc/connect.php'; ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>eLiquid</title>
    <link rel="stylesheet" type="text/css" href="styles/reset.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
    
<div id="main-wrapper">
<div class="clearfix stretch">

    <div id="results" class="wrapper">
        <h2>Current Stock</h2>
        <?php include 'inc/currentstock.php'; ?>
    </div><!-- /#results -->

    <div class="wrapper">
        <!-- Add item to DB -->
        <div id="addrow">
            <h3 class="padtop">Add Row</h3>
            <form action="inc/addrow.php" method="GET">
            <p>
                <input type="text" size="14" name="name" placeholder="Name">
                <input type="text" size="4" name="qty" placeholder="Qty">
                <button type="submit">Add</button>
            </p>
            </form>
        </div>

        <!-- Delete item from DB -->
        <div id="delrow">
            <h3>Delete Row</h3>
            <form action="inc/delrow.php" method="GET">
            <p>Select Row ID: 
                <input type="text" size="4" name="rowID">
                <button type="submit">Delete</button>
            </p>
            </form>
        </div>

        <!-- Change Qty -->
        <div id="editrow">
            <h3>Update Row</h3>
            <form action="inc/editrow.php" method="GET">
            <p>
                <?php include 'inc/flavourfield.php' ?>
                <input type="text" size="5" name="newQty" placeholder="New Qty">
                <button type="submit">Update</button>
            </p>
            </form>
        </div>

    </div><!-- /.wrapper -->

</div><!-- /.clearfix -->

<div id="orders">
    <!-- Add a new order to the database -->
    <h3>New Order</h3>    
    <table class="formTable">
        <form action="neworder.php" method="GET">
        <tr>
            <th>Date</th>
            <td><input type="date" name="date"></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <th>Size</th>
            <td>
                <p><input type="radio" name="size" value="10">10mL</p>
                <p><input type="radio" name="size" value="15">15mL</p>
                <p><input type="radio" name="size" value="30">30mL</p>
            </td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>
                <select name="orderQty">
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
            <td></td>
            <td><button type="submit">Submit</button></td>
        </tr>
        </form>
    </table>
    <h2>Recent Orders</h2>
    <table class="stretch">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Username</th>
            <th>Size</th>
            <th>Qty</th>
            <th>Selection</th>
            <th>Fulfilled</th>
        </tr>
        <tr>
            <td>69</td>
            <td>2018-11-11</td>
            <td>Geoffery Williams</td>
            <td>lordgeof982</td>
            <td>30mL</td>
            <td>5</td>
            <td>Orange, Mandarin, Banana</td>
            <td><input type="checkbox"></td>
        </tr>
        <?php
            include 'inc/recentorders.php';
        ?>
    </table>

</div>

</div><!-- /#wrapper -->



</body>
</html>