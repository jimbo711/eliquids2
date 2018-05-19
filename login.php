<?php
// Assign page title
$page_title = "Login";
if (!isset($path_home)) {
    // If path to root isn't set, set to default
    $path_home = ""; // Assign "../" on other pages where necessary
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo $path_home; ?>styles/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="<?php echo $path_home; ?>js/neworder.js"></script>
    <style type="text/css">
    html, body {height: 100%;}
    .container:nth-child(2),
    .container .row.justify-content-center.align-items-center {
        height: 100%;
        min-height: 100%;
    }
    </style>
</head>
<body>

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