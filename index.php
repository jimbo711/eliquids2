<?php
// If user is not logged in, redirect to login page.
if (!isset($_COOKIE['login'])) {
    header('Location: login.php');
}
// Connect to DB
require_once 'inc/connect.php';
// PHP functions
require_once 'inc/functions.php';
// Page header
require_once 'inc/header.php';
?>

<div class="container">
    
    <div id="stock" class="row">
        <h1>Current Stock</h1>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Sold</th>
                </tr>
            </thead>
            <tbody>
            <?php current_stock($conn); ?>
            </tbody>
        </table>
    </div>
    <hr>
    <div id="neworder" class="row">
        <div class="col">
            <h2>New Order</h2>    
            <table class="table">
                <form action="neworder.php" onsubmit="return validateOrder()" method="GET">
                <tr>
                    <th>Date</th>
                    <td><input type="date" class="form-control" name="date" value="<?php echo date("Y-m-j"); ?>"></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><input type="text" class="form-control" id="name" name="name"></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><input type="text" class="form-control" id="username" name="username"></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="size" id="radio10ml" value="10">
                            <label class="form-check-label" for="radio10ml">10mL</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="size" id="radio20ml" value="15">
                            <label class="form-check-label" for="radio20ml">15mL</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="size" id="radio30ml" value="30">
                            <label class="form-check-label" for="radio30ml">30mL</label>
                        </div>                    
                    </td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>
                        <input type="number" class="form-control" id="orderQty" name="orderQty">
                    </td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><textarea class="form-control" rows="4" id="address" name="address" placeholder="Seperate lines with a comma followed by a space"></textarea></td>
                </tr>
            </table>
            <div class="form-row">
                <div class="col"></div>
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-block" style="margin:-5px 0 0 0;">Submit Order</button>
                </div>
            </div>
            </form>
        </div><!-- /col -->
        <div class="col-sm">
            <h4>New Flavour</h4>
            <form class="form" action="inc/addrow.php" onsubmit="return validateAddFlv()" method="GET">
            <div class="form-row">
                <div class="col">
                    <input type="text" id="addFlavourName" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="col-5">
                    <input type="text" id="addFlavourQty" class="form-control" name="qty" placeholder="Qty">
                </div>
            </div>
            <div class="form-row">
                <div class="col"></div>
                <div class="col-5">
                    <button class="btn btn-primary btn-block" type="submit">Add</button>
                </div>
            </div>
            </form>
        
            <h4>Remove Flavour</h4>
            <form action="inc/delrow.php" onsubmit="return validateDelRow()" method="GET">
            <div class="form-row">
                <div class="col">
                    <label>Select Row ID: </label>
                </div>
                <div class="col-5">
                    <input type="text" class="form-control" id="delrowid" name="rowID">
                </div>
            </div>
            <div class="form-row">
                <div class="col"></div>
                <div class="col-5">
                    <button class="btn btn-danger btn-block" type="submit">Remove</button>
                </div>
            </div>
            </form>

            <h4>Update Quantity</h4>
            <form action="inc/editqty.php" method="GET">
            <div class="form-row">
                <div class="col-7">
                    <?php flavourfield("name", $conn); ?>
                </div>
                <div class="col-5">
                    <input type="text" name="editqty" class="form-control"  placeholder="mL">
                </div>
            </div>
            <div class="form-row">
                <div class="col-4">
                    <button class="btn btn-success btn-block" type="submit" name="increase">Increase</button>
                </div>
                <div class="col-4">
                    <button class="btn btn-danger btn-block" type="submit" name="decrease">Decrease</button>
                </div>
                <div class="col-4">
                    <button class="btn btn-primary btn-block" type="submit" name="newqty">New Qty</button>
                </div>
            </div>              
            </form>
        </div>
    </div><!-- /row -->
    <hr>
    <div id="unfulfilled" class="row">
        <h2>Unfulfilled Orders</h2>
        <table id="unfulfilled-table" class="table table-striped col-12">
            <form action="inc/markfulfilled.php" name="unfulfilledorders" method="GET">
            <thead>
                <tr class="row">
                    <th style="width: 12.499999995%">Date</th>
                    <th class="col-2">Name</th>
                    <th class="col">Username</th>
                    <th class="col-1">Size</th>
                    <th class="col-1">Qty</th>
                    <th class="col-3">Selection</th>
                    <th style="width: 12.499999995%">Done</th>
                </tr>
            </thead>
            <?php unfulfilled_orders($conn); ?>
            <tr class="row justify-content-end">
                <td class="col-7 col-md-8 col-lg-9"></td>
                <td class="col">
                    Select All
                    <input type="checkbox" name="checkall" class="mx-2" onClick="checkAll('edit');">
                    <button type="submit" name="editorder" class="btn btn-primary">Edit</button>
                    <button name="markdone" type="submit" class="btn btn-primary">Fulfilled</button>
                </td>
            </tr>
            </form>
        </table>
    </div><!-- /row -->

    <div id="fulfilled" class="row">
        <h2>Fulfilled Orders</h2>
        <table id="fulfilled-table" class="table table-striped col-12">
            <thead>
                <tr class="row">
                    <th style="width: 12.499999995%">Date</th>
                    <th class="col-2">Name</th>
                    <th class="col">Username</th>
                    <th class="col-1">Size</th>
                    <th class="col-1">Qty</th>
                    <th class="col-3">Selection</th>
                    <th style="width: 12.499999995%">Dispatched</th>
                </tr>
            </thead>
            <?php fulfilled_orders($conn); ?>
        </table>
    </div><!-- /row -->

</div><!-- /#container -->
<?php include_once 'inc/footer.php'; ?>