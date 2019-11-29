<form method="get">
<input type="text" name="searchname">
</form>


<table>
<tr>
<th> nev
<a href="?action=order_nev_asc" > + </a> 
<a href="?action=order_nev_desc" > - </a> 
 </th>
 <th> price
 <a href="?action=order_price_asc" > + </a> 
<a href="?action=order_price_desc" > - </a>
 </th>
 <th> id
 <a href="?action=order_id_asc" > + </a> 
<a href="?action=order_id_desc" > - </a>
 </th>
</tr>



<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "termekek";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchsql = "";

if (isset($_GET["searchname"])) {
	 $searchsql = " WHERE name like '%" . $_GET["searchname"] . "%' ";
}
	
	
$orderBy = " ORDER BY id ASC";
if (isset($_GET["action"])) {
	if ($_GET["action"] == "order_nev_asc") {
		$orderBy = " ORDER BY name ASC";
	}
	if ($_GET["action"] == "order_nev_desc") {
		$orderBy = " ORDER BY name DESC";
	}
	if ($_GET["action"] == "order_price_asc") {
		$orderBy = " ORDER BY price ASC";
	}
	if ($_GET["action"] == "order_price_desc") {
		$orderBy = " ORDER BY price DESC";
	}
	if ($_GET["action"] == "order_id_asc") {
		$orderBy = " ORDER BY id ASC";
	}
	if ($_GET["action"] == "order_id_desc") {
		$orderBy = " ORDER BY id DESC";
	}
	
}

$sql = "SELECT * FROM product " . $searchsql .  $orderBy;


$result = $conn->query($sql);



if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>" . "<td>" . $row["name"] . "</td>";
		echo "<td>" . $row["price"] . "</td>" ;
		echo "<td>" . $row["id"] . "</td>" ;

		echo "</tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?> 
</table>