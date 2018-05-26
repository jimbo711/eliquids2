<?php
/***************************************

    Create and populate rows of 'Current Stock' html table
        with data from 'madeliquids' db table.

    - $conn is passed in and is used as the databse connection.

***************************************/
function current_stock($conn) {
    // String to store flavours sold
    $flavours = "";
    // Query all results from orders table
    $results = mysqli_query($conn, "SELECT * FROM orders WHERE fulfilled=1") or die(mysqli_error($conn));
    if (mysqli_num_rows($results) > 0) {
        // Loop through
        while ($row = mysqli_fetch_array($results)) {
            // Get flavour selection
            $selection = $row['selection'];
            // If flavour selection isn't blank
            if ($selection !== "") {
                // Append flavour list, add a comma if needed
                if ($flavours == "") {
                    $flavours .= $selection;
                } else {
                    $flavours .= ", ".$selection;
                }
            }
        }
        // If flavours isn't blank
        if ($flavours !== "") {
            // Turn string into array
            $flavours = str_getcsv($flavours);
            // Trim the whitespace
            $flavours = array_map('trim',$flavours);
            // Count duplicates in array
            $flavours = array_count_values($flavours);
        }
    } else {
        echo "No results";
    }
    // Query all results from madeliquids table
    $results = mysqli_query($conn, "SELECT * FROM madeliquids ORDER BY liquidname ASC") or die(mysqli_error($conn));
    // if one or more rows are returned
    if(mysqli_num_rows($results) > 0){
        // $row = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
        while($row = mysqli_fetch_array($results)){
            $qty = $row['qty'];
            $id  = $row['id'];
            $name = $row['liquidname'];
            // If there is no count of this liquid in the flavours-sold list
            if (!array_key_exists($name,$flavours)) {
                // Zero sold
                $sold = 0;
            } else {
                // Else get the count of this liquid from the $flavours array.
                $sold = $flavours[$name];
            }
            // if qty of liquid is less than 0, make it 0
            if ($qty < 0) {
                $sql = "UPDATE madeliquids SET qty=0 WHERE id='$id';";
                mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $qty = 0;
            }
            // each iterration, create a html table row and fill it with db row data
            echo "<tr>
                      <td>".$id."</td>
                      <td>".$name.'</td>
                      <td class="text-center">'.$qty.'</td>
                      <td class="text-center">'.$sold."</td></tr>\r\n";
        }
    } else {
        echo "No results";
    }
}
/**************************************

    Display select field
        populated with all of the flavours from current stock.

    - $n is passed in and is used as the name of the select field in HTML.
    - $conn is passed in and is used as the database connection.

***************************************/
function flavourfield($name, $conn) {
    // Open select tag
    echo '<select name="'.$name.'"'.' class="form-control"'.'>'."\r\n";
    // First option is blank
    echo '<option value="" disabled selected>Select Flavour...</option>'."\r\n";
    // Query all the liquid names
    $sql = "SELECT liquidname FROM madeliquids ORDER BY liquidname ASC";
    $result = mysqli_query($conn, $sql) 
            or die("Select field query failed: ".mysqli_error($conn));
    // Make them into an array and loop through
    while ($row=mysqli_fetch_array($result)) {
        $liquidname = $row["liquidname"];
        // Create an option in the select feild for each liquid name
        echo "<option>".$liquidname."</option>\r\n";
    }
    // Close select tag
    echo "</select>\r\n";
}
function editFlavourField($name, $flavour, $conn) {
    // Open select tag
    echo '<select name="'.$name.'"'.' class="form-control"'.'>'."\r\n";
    // First option is $f
    echo '<option selected>'.$flavour.'</option>'."\r\n";
    // Query all the liquid names
    $sql = "SELECT liquidname FROM madeliquids ORDER BY liquidname ASC";
    $result = mysqli_query($conn, $sql) 
            or die("Select field query failed: ".mysqli_error($conn));
    // Make them into an array and loop through
    while ($row=mysqli_fetch_array($result)) {
        $liquidname = $row["liquidname"];
        // Create an option in the select feild for each liquid name
        echo "<option>".$liquidname."</option>\r\n";
    }
    // Close select tag
    echo "</select>\r\n";
}
function bottledflavourfield($name, $conn){
    // Open select tag
    echo '<select name="'.$name.'"'.' class="form-control"'.'>'."\r\n";
    // First option is blank
    echo '<option value="" disabled selected>Select Flavour...</option>'."\r\n";
    // Query all the liquid names
    $sql = "SELECT flavour FROM bottledliquids ORDER BY flavour ASC";
    $result = mysqli_query($conn, $sql) 
            or die("Select field query failed: ".mysqli_error($conn));
    // Make them into an array and loop through
    while ($row=mysqli_fetch_array($result)) {
        $flavourname = $row["flavour"];
        // Create an option in the select feild for each liquid name
        echo "<option>".$flavourname."</option>\r\n";
    }
    // Close select tag
    echo "</select>\r\n";
}
/***************************************

    Create and populate rows of 'fulfilled orders' html table
        with data from 'orders' db table.

    - $conn is passed in and is used as the databse connection.

***************************************/
function fulfilled_orders($conn) {
    // Query all results from table
    $results = mysqli_query($conn, "SELECT * FROM orders ORDER BY `dispatched` DESC, `date` ASC") or die(mysqli_error($conn));
    // if one or more rows are returned
    if(mysqli_num_rows($results) > 0){
        // $row = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
        while($row = mysqli_fetch_array($results)){ 
            // each iterration, create a html table row and fill it with db row data
            $fulfilled = $row['fulfilled'];
            if ($fulfilled) {
                echo "<tr".' class="row"'.">\r\n";
                echo "<td".' style="width: 12.499999995%"'.">".$row['date']."</td>\r\n";
                echo "<td".' class="col-2"'.">".$row['name']."</td>\r\n";
                echo "<td".' class="col"'.">".$row['username']."</td>\r\n";
                echo "<td".' class="col-1"'.">".$row['size']."mL</td>\r\n";
                echo "<td".' class="col-1"'.">".$row['orderqty']."</td>\r\n";
                echo "<td".' class="col-3"'.">".$row['selection']."</td>\r\n";
                echo "<td".' style="width: 12.499999995%"'.">".$row['dispatched']."</td>\r\n";
                echo "</tr>\r\n";
            }
        }
    } else {
        echo "No results";
    }
}
/***************************************

    Create and populate rows of 'unfulfilled orders' html table
        with data from 'orders' db table.

    - $conn is passed in and is used as the databse connection.

***************************************/
function unfulfilled_orders($conn) {
    // Query all results from table
    $results = mysqli_query($conn, "SELECT * FROM orders ORDER BY `date` ASC") or die(mysqli_error($conn));
    // if one or more rows are returned
    if(mysqli_num_rows($results) > 0){
        // $row = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
        while($row = mysqli_fetch_array($results)){ 
            // each iterration, create a html table row and fill it with db row data
            $fulfilled = $row['fulfilled'];
            if (!$fulfilled) {
                echo "<tr".' class="row"'.">\r\n";
                echo "<td".' class="col"'.">".$row['date']."</td>\r\n";
                echo "<td".' class="col"'.">".$row['name']."</td>\r\n";
                echo "<td".' class="col"'.">".$row['username']."</td>\r\n";
                echo "<td".' class="col-1 text-center"'.">".$row['size']."mL</td>\r\n";
                echo "<td".' class="col-1 text-center"'.">".$row['orderqty']."</td>\r\n";
                echo "<td".' class="col-3"'.">".$row['selection']."</td>\r\n";
                // Last column will be a checkbox with a value equal to the row ID
                echo "<td".' class="col-1 text-center"'."><input type=\"checkbox\" id=\"edit\" name=\"edit[]\" value=\"".$row['id']."\"></td>\r\n";
                echo "</tr>\r\n";
            }
        }
    } else {
        echo "No results";
    }
}
/***************************************

    Create and populate rows of 'breakdown' html table
        with processed data from 'orders' db table.

    - $conn is passed in and is used as the databse connection.
    - $bottleSize is passed and used at to store the size of the bottles being queried.
    - On the orders page, we call this function once for each size of bottle. (10, 15, 30)

***************************************/
function breakdown($conn, $bottleSize) {
    // This string will hold all the flavour selections
    $flavours = "";
    // Query all unfulfilled orders for with size of $bottleSize
    $results = mysqli_query($conn, "SELECT * FROM orders WHERE fulfilled = 0 AND size = $bottleSize") or die(mysqli_error($conn));
    // if one or more rows are returned
    if(mysqli_num_rows($results) > 0){
        // loop through returned rows
        while($row = mysqli_fetch_array($results)){
            $size = $bottleSize;
            // Get selection
            $selection = $row['selection'];
            // If flavour selection isn't blank
            if ($selection !== "") {
                // Append flavour list, add a comma if needed
                if ($flavours == "") {
                    $flavours .= $selection;
                } else {
                    $flavours .= ", ".$selection;
                }
            }
        }
        if ($flavours !== "") {
            // Turn string into array
            $flavours = str_getcsv($flavours);
            // Trim the whitespace
            $flavours = array_map('trim',$flavours);
            // Count duplicates in array
            $flavours = array_count_values($flavours);
            // Loop through array
            foreach ($flavours as $name=>$count) {
                // Build table row for eah flavour
                echo '<tr>'."\r\n";
                echo '<td>'.$name.'</td>'."\r\n";
                echo '<td class="text-center">'.$size.'</td>'."\r\n";
                echo '<td class="text-center">'.$count.'</td>'."\r\n";
                echo '</tr>'."\r\n";
            }
        }
    } else {
        echo '<div class="alert alert-success" role="alert">No '.$bottleSize.'mL orders.</div>'."\r\n";
    }
}
/***************************************

    Create and populate rows of 'Ready-Made Bottles' html table
        with processed data from 'bottledliquids' db table.

    - $conn is passed in and is used as the databse connection.

***************************************/
function bottledLiquids($conn) {
    // Query all results from bottledliquids table
    $results = mysqli_query($conn, "SELECT * FROM bottledliquids ORDER BY size ASC, flavour ASC") or die(mysqli_error($conn));
    // if one or more rows are returned
    if(mysqli_num_rows($results) > 0){
        // loop through returned rows
        while($row = mysqli_fetch_array($results)){
            $id   = $row['id'];
            $name = $row['flavour'];
            $size = $row['size'];
            $qty  = $row['qty'];
            // Build table row for each flavour
            echo '<tr>'."\r\n";
            echo '<td>'.$id.'</td>'."\r\n";
            echo '<td>'.$name.'</td>'."\r\n";
            echo '<td class="text-center">'.$qty.'</td>'."\r\n";
            echo '<td class="text-center">'.$size.'</td>'."\r\n";
            echo '</tr>'."\r\n";
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">There are no ready-made bottles in the database.'."</div>\r\n";
    }
}
?>