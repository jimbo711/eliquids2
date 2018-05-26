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
    <div class="row">
        <div id="neworder" class="col">
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
        <div class="col">
            <h2>Breakdown</h2>
            <table class="table border-bottom">
                <thead>
                    <tr>
                        <th scope="col">Flavour</th>
                        <th scope="col" class="text-center">Size</th>
                        <th scope="col" class="text-center">Count</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    breakdown($conn, 10);
                    breakdown($conn, 15);
                    breakdown($conn, 30);
                    ?>
                </tbody>
            </table>
        </div>
    </div><!-- /row -->
    <hr>
    <div id="unfulfilled" class="row">
        <h1>Unfulfilled Orders</h1>
        <table id="unfulfilled-table" class="table table-striped border-bottom">
            <form action="inc/markfulfilled.php" name="unfulfilledorders" method="GET">
            <thead>
                <tr class="row">
                    <th class="col">Date</th>
                    <th class="col">Name</th>
                    <th class="col">Username</th>
                    <th class="col-1 text-center">Size</th>
                    <th class="col-1 text-center">Qty</th>
                    <th class="col-3">Selection</th>
                    <th class="col-1" class="text-center"></th>
                </tr>
            </thead>
            <?php unfulfilled_orders($conn); ?>
            <tr class="row justify-content-end">
                <td class="col">
                    <button type="submit" name="remove" class="btn btn-outline-danger">Remove</button>
                </td>
                <td class="col" style="text-align:right">
                    <button name="markdone" type="submit" class="btn btn-outline-primary mr-2">Mark Fulfilled</button>
                    <button type="submit" name="editorder" class="btn btn-outline-primary mr-2">View/Edit</button>
                    <button type="button" name="checkall" class="btn btn-outline-secondary" onClick="checkAll('edit');">Select All</button>
                </td>
            </tr>
            </form>
        </table>
    </div><!-- /row -->

</div><!-- /#container -->
<?php include_once 'inc/footer.php'; ?>