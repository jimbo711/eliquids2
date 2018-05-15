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
<div id="container">

    <div id="currentstock" class="row">
        <div class="col"></div>
        <div class="col-10">
            <h1>Current Stock</h1>
            <table class="table">
                <thead>
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

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 col-lg-5" id="neworder">
            <h2>New Order</h2>    
            <table class="table">
                <form action="neworder.php" method="GET">
                <tr>
                    <th>Date</th>
                    <td><input type="date" class="form-control" name="date" value="<?php echo date("Y-m-j"); ?>"></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><input type="text" class="form-control" name="name"></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><input type="text" class="form-control" name="username"></td>
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
                        <select class="form-control" name="orderQty">
                        <option></option>
                        <?php
                            // Populate drop-down with numbers (and values) 1-12
                            for ($i=1; $i<=12; $i++) {
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
                    <td><button type="submit" class="btn btn-primary btn-block">Submit</button></td>
                </tr>
                </form>
            </table>
        </div><!-- /col -->
        <div class="col-1"></div>
        <div class="col-1 d-sm-md"></div>
        <div class="col-10 col-lg-4">
            <h4>Add Flavour</h4>
            <form class="form" action="inc/addrow.php" method="GET">
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="col-4">
                    <input type="text" class="form-control" name="qty" placeholder="Qty">
                </div>
            </div>
            <div class="form-row">
                <button class="btn btn-primary btn-block"  type="submit">Add</button>
            </div>
            </form>
        
            <h4>Remove Flavour</h4>
            <form action="inc/delrow.php" method="GET">
            <div class="form-row">
                <div class="col">
                    <label>Select Row ID: </label>
                </div>
                <div class="col">
                    <input type="text" class="form-control"  name="rowID">
                </div>
            </div>
            <div class="form-row">
                <button class="btn btn-danger btn-block" type="submit">Delete</button>
            </div>
            </form>
        

            <h4>Update Quantity</h4>
            <form action="inc/editrow.php" method="GET">
            <div class="form-row">
                <div class="col-7">
                    <?php flavourfield("name", $conn); ?>
                </div>
                <div class="col">
                    <input type="text" name="newQty" class="form-control"  placeholder="New Qty">
                </div>
            </div>
            <div class="form-row">
                <button class="btn btn-primary btn-block" type="submit">Update</button>
            </div>                
            </form>

        </div>
        <div class="col-1"></div>
    </div><!-- /row -->

    

    <div>
        <h2>Unfulfilled Orders</h2>
        <table id="unfulfilled" class="stretch">
            <form action="inc/markfulfilled.php" method="GET">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Name</th>
                <th>Username</th>
                <th>Size</th>
                <th>Qty</th>
                <th>Selection</th>
                <th>Done</th>
            </tr>
            <?php unfulfilled_orders($conn); ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2"><button type="submit">Mark Fulfilled</button></td>
            </tr>
            </form>
        </table>
    </div>

    <div>
        <h2>Fulfilled Orders</h2>
        <table id="fulfilled" class="stretch">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Name</th>
                <th>Username</th>
                <th>Size</th>
                <th>Qty</th>
                <th>Selection</th>
                <th>Dispatched</th>
            </tr>
            <?php fulfilled_orders($conn); ?>
        </table>
    </div>

</div><!-- /#container -->
<?php include_once 'inc/footer.php'; ?>