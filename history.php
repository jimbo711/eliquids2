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
$page_title = "History";
// Page header
require_once 'inc/header.php';
?>
<div class="container">

    <div id="fulfilled" class="row">
        <h1>Fulfilled Orders</h1>
        <table id="fulfilled-table" class="table table-striped border-bottom col-12">
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