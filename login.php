<?php
// Assign page title
$page_title = "Login";
// Page header
require_once 'inc/header.php';
?>

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="inc/verifylogin.php" method="POST">        
                    <div class="form-row">
                        <div class="form-group">
                            <div class="col">
                                <label for="username">Username: </label>
                            </div>
                            <div class="col">
                                <input id="username" class="form-control" type="email" name="username" autocomplete>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="col">
                                <label for="password">Password: </label>
                            </div>
                            <div class="col">
                                <input id="password" class="form-control" type="password" name="password" autocomplete>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col"></div>
                        <div class="col-11"><button class="btn btn-primary btn-block" type="submit">Login</button></div>
                        <div class="col"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- /.container -->


<?php 
// Page footer 
include_once 'inc/footer.php' 
?>