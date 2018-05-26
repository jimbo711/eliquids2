<?php
// If user is not logged in, redirect to login page.
if (!isset($_COOKIE['login'])) {
    header('Location: login.php');
}
// Connect to DB
require_once 'inc/connect.php';
// PHP functions
require_once 'inc/functions.php';
// Assign page title
$page_title = "Stock";
// Page header
require_once 'inc/header.php';
?>
<div class="container">

    <div id="stock" class="row mb-3">
        <h1>Current Stock</h1>
        <table class="table table-striped border-bottom">
            <thead class="thead">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col" class="text-center">Qty</th>
                    <th scope="col" class="text-center">Sold</th>
                </tr>
            </thead>
            <tbody>
                <?php current_stock($conn); ?>
            </tbody>
        </table>
    </div>

    <div class="row mb-4">
        <div class="col-6 col-lg-4">
            <h4>New Flavour</h4>
            <form class="form" action="inc/editmadeliquids.php" onsubmit="return validateAddFlv('addFlavourName','addFlavourQty')" method="GET">
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
                    <button class="btn btn-outline-primary btn-block" name="addflv-btn" type="submit">Add</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-6 col-lg-4">
            <h4>Remove Flavour</h4>
            <form action="inc/editmadeliquids.php" onsubmit="return validateDelRow('delrowid')" method="GET">
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
                    <button class="btn btn-outline-danger btn-block" name="delflv-btn" type="submit">Remove</button>
                </div>
            </div>
            </form>
        </div>

        <div class="col-lg-4">
            <h4>Update Quantity</h4>
            <form action="inc/editmadeliquids.php" method="GET">
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
                    <button class="btn btn-outline-success btn-block" type="submit" name="increase-btn">Increase</button>
                </div>
                <div class="col-4">
                    <button class="btn btn-outline-danger btn-block" type="submit" name="decrease-btn">Decrease</button>
                </div>
                <div class="col-4">
                    <button class="btn btn-outline-primary btn-block" type="submit" name="newqty-btn">New Qty</button>
                </div>
            </div>              
            </form>
        </div>
    </div>

    <div id="bottled" class="row mb-3">
        <h1 class="col-12">Ready-Made Bottles</h1>
        <table class="table table-striped border-bottom">
            <thead class="thead">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Flavour</th>
                    <th scope="col" class="text-center">Qty</th>
                    <th scope="col" class="text-center">Size</th>
                </tr>
            </thead>
            <tbody>
                <?php bottledLiquids($conn); ?>
            </tbody>
        </table>
    </div>

    <div class="row mb-3">
        <div class="col-6 col-lg-4">
            <h4>New Flavour</h4>
            <form class="form" action="inc/editbottledliquids.php" onsubmit="return validateAddFlv('addBottledName','addBottledQty')" method="GET">
            <div class="form-row">
                <div class="col-6">
                    <input type="text" id="addBottledName" class="form-control" name="name" placeholder="Name">
                </div>
                <div class="col-3">
                    <input type="text" id="addBottledQty" class="form-control" name="qty" placeholder="Qty">
                </div>
                <div class="col-3">
                    <select name="size" class="custom-select">
                        <option selected disabled>Size</option>
                        <option value="10">10mL</option>
                        <option value="15">15mL</option>
                        <option value="30">30mL</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col"></div>
                <div class="col-5">
                    <button class="btn btn-outline-primary btn-block" name="addflv-btn" type="submit">Add</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col-6 col-lg-4">
            <h4>Remove Flavour</h4>
            <form action="inc/editbottledliquids.php" onsubmit="return validateDelRow('delbottlerow')" method="GET">
            <div class="form-row">
                <div class="col">
                    <label>Select Row ID: </label>
                </div>
                <div class="col-5">
                    <input type="text" class="form-control" id="delbottlerow" name="rowID">
                </div>
            </div>
            <div class="form-row">
                <div class="col"></div>
                <div class="col-5">
                    <button class="btn btn-outline-danger btn-block" name="delflv-btn" type="submit">Remove</button>
                </div>
            </div>
            </form>
        </div>

        <div class="col-lg-4">
            <h4>Update Quantity</h4>
            <form action="inc/editbottledliquids.php" method="GET">
            <div class="form-row">
                <div class="col-7">
                    <?php bottledflavourfield("name", $conn); ?>
                </div>
                <div class="col-5">
                    <input type="text" name="editqty" class="form-control"  placeholder="Qty">
                </div>
            </div>
            <div class="form-row">
                <div class="col-4">
                    <button class="btn btn-outline-success btn-block" type="submit" name="increase-btn">Increase</button>
                </div>
                <div class="col-4">
                    <button class="btn btn-outline-danger btn-block" type="submit" name="decrease-btn">Decrease</button>
                </div>
                <div class="col-4">
                    <button class="btn btn-outline-primary btn-block" type="submit" name="newqty-btn">New Qty</button>
                </div>
            </div>              
            </form>
        </div>
    </div>

</div><!-- /#container -->
<?php include_once 'inc/footer.php'; ?>