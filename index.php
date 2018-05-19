<?php
/*
        TO DO

*/
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

    <div id="currentstock" class="row">
        <div class="col"></div>
        <div class="col-10">
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
        <div class="col"></div>
    </div>

    <hr>

    <div id="middle-section" class="row">
        <div class="col-1"></div>
        <div class="col" id="neworder">
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
                        <input type="radio" name="size" value="10">&nbsp; 10mL &nbsp; &nbsp;
                        <input type="radio" name="size" value="15">&nbsp; 15mL &nbsp; &nbsp;
                        <input type="radio" name="size" value="30">&nbsp; 30mL &nbsp; &nbsp;
                    </td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>
                        <input type="number" class="form-control" id="orderQty" name="orderQty">
                    </td>
                </tr>
            </table>
            <div class="form-row">
                <div class="col-7"></div>
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-block" style="margin:-5px 0 0 0;">Submit Order</button>
                </div>
            </div>
            </form>
        </div><!-- /col -->
        <div class="col-1"></div>
        <div class="col">
            <h4>Add Flavour</h4>
            <form class="form" action="inc/addrow.php" method="GET">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="col-5">
                    <input type="text" class="form-control" name="qty" placeholder="Qty">
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
            <form action="inc/delrow.php" method="GET">
            <div class="form-row">
                <div class="col">
                    <label>Select Row ID: </label>
                </div>
                <div class="col-5">
                    <input type="text" class="form-control"  name="rowID">
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
            <form action="inc/editrow.php" method="GET">
            <div class="form-row">
                <div class="col-7">
                    <?php flavourfield("name", $conn); ?>
                </div>
                <div class="col-5">
                    <input type="text" name="newQty" class="form-control"  placeholder="New Qty">
                </div>
            </div>
            <div class="form-row">
                <div class="col"></div>
                <div class="col-5">
                    <button class="btn btn-primary btn-block" type="submit">Update</button>
                </div>
            </div>              
            </form>
        </div>
        <div class="col-1"></div>
    </div><!-- /row -->

    <hr>

    <div class="row">
        <div class="col-1"></div>
        <div class="col" id="unfulfilled">
            <h2>Unfulfilled Orders</h2>
            <table class="table table-striped">
                <form action="inc/markfulfilled.php" method="GET">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Size</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Selection</th>
                        <th scope="col">Done</th>
                    </tr>
                </thead>
                <?php unfulfilled_orders($conn); ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button type="submit" class="btn btn-primary">Fulfilled</button></td>
                </tr>
                </form>
            </table>
        </div>
        <div class="col-1"></div>
    </div><!-- /row -->

    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <h2>Fulfilled Orders</h2>
            <table id="fulfilled" class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Size</th>
                        <th>Qty</th>
                        <th>Selection</th>
                        <th>Dispatched</th>
                    </tr>
                </thead>
                <?php fulfilled_orders($conn); ?>
            </table>
        </div>
        <div class="col-1"></div>
    </div><!-- /row -->

</div><!-- /#container -->
<?php include_once 'inc/footer.php'; ?>