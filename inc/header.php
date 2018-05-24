<?php
// Default header variables
if (!isset($page_title)) {
    // If page title isn't set, set to default
    $page_title = "eLiquid Data";
}
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
    <script src="<?php echo $path_home; ?>js/script.js"></script>
</head>
<body data-spy="scroll" data-target="#main-nav" data-offset="60">
    <script>
        // Scrollspy Offset Fix
        var shiftWindow = function() { scrollBy(0, -60) }; // adjust -60 based on the navbar height
        if (location.hash) shiftWindow();
        window.addEventListener("hashchange", shiftWindow);
    </script>
    <nav id="main-nav" class="navbar fixed-top navbar-expand navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $path_home; ?>index.php">Eliquid Data</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path_home; ?>index.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path_home; ?>stock.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $path_home; ?>history.php">History</a>
                    </li>
                </ul>
            </div>
        </div>  
    </nav>
