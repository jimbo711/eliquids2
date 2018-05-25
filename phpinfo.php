<?php
// If user is not logged in, redirect to login page.
if (!isset($_COOKIE['login'])) {
    header('Location: login.php');
}
// Display phpinfo()
else {
    echo phpinfo();
}