<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Order</title>
    <link rel="stylesheet" type="text/css" href="styles/reset.css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>

<div id="login">
    <form action="inc/verifylogin.php" method="POST">
    <table>
        <tr>
            <th>Username:</th>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <th>Password:</th>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit">Login</button>
            </td>
        </tr>
    </table>
</div><!-- /#login -->

</body>
</html>
<?php

?>