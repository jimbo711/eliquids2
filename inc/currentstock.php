<?php
/***********************************
    Display items in database
***********************************/
// Query all results from table
$results = mysqli_query($conn, "SELECT * FROM madeliquids") or die(mysqli_error($conn));
// if one or more rows are returned
if(mysqli_num_rows($results) > 0){
    // Create html table
    echo "<table>\r\n";
    echo "<tr><th>ID</th><th>Name</th><th>Qty</th><th>Sold</th></tr>\r\n";
    
    // $row = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
    while($row = mysqli_fetch_array($results)){ 
        // each iterration, create a html table row and fill it with db row data
        echo "<tr><td>".$row['id']."</td><td>".$row['liquidname']."</td><td>".$row['qty']."</td><td>".$row['sold']."</td></tr>\r\n";
    }
    // Close the html table
    echo "</table>\r\n";
} else {
    echo "No results";
}
?>