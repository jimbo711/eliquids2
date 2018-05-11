<?php

/***********************************
    Display items in database
***********************************/
// Query all results from table
$results = mysqli_query($conn, "SELECT * FROM orders") or die(mysqli_error($conn));
// if one or more rows are returned
if(mysqli_num_rows($results) > 0){
    // $row = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
    while($row = mysqli_fetch_array($results)){ 
        // each iterration, create a html table row and fill it with db row data
        $fulfilled = $row['fulfilled'];
        if (!$fulfilled) {
            echo "<tr>\r\n";
            echo "<td>".$row['id']."</td>\r\n";
            echo "<td>".$row['date']."</td>\r\n";
            echo "<td>".$row['name']."</td>\r\n";
            echo "<td>".$row['username']."</td>\r\n";
            echo "<td>".$row['size']."mL</td>\r\n";
            echo "<td>".$row['orderqty']."</td>\r\n";
            echo "<td>".$row['selection']."</td>\r\n";
            // Last column will be a checkbox with a value equal to the row ID
            echo "<td><input type=\"checkbox\" name=\"fulfilled[]\" value=\"".$row['id']."\"></td>\r\n";
            echo "</tr>\r\n";
        }
    }
} else {
    echo "No results";
}

?>