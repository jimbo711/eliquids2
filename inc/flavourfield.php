<?php

// Open select tag
echo '<select name="name">'."\r\n";

// First option is blank
echo "<option></option>\r\n";

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

?>