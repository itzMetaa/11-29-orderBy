<form method="get">
<input type="text" name="searchname">
<input type="number" name="limit">
<input type="submit" value="Kereses" name="action">
</form>


<table>
<tr>
<th> id
    <a href="?action=order_id_asc" > + </a> 
    <a href="?action=order_id_desc" > - </a>
</th>
<th> nev
    <a href="?action=order_nev_asc" > + </a> 
    <a href="?action=order_nev_desc" > - </a> 
</th>
<th> faj
    <a href="?action=order_faj_asc" > + </a> 
    <a href="?action=order_faj_desc" > - </a>
</th>
<th> lakohely
    <a href="?action=order_lakohely_asc" > + </a> 
    <a href="?action=order_lakohely_desc" > - </a>
</th>
<th> ero
    <a href="?action=order_ero_asc" > + </a> 
    <a href="?action=order_ero_desc" > - </a>
</th>
<th> jellem
    <a href="?action=order_jellem_asc" > + </a> 
    <a href="?action=order_jellem_desc" > - </a>
</th>
<th> szuletesi
    <a href="?action=order_szuletesi_asc" > + </a> 
    <a href="?action=order_szuletesi_desc" > - </a>
</th>
</tr>


<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "gyurukura";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchsql = "";
if (isset($_GET["searchname"])) {
	 $searchsql = " WHERE nev like '%" . $_GET["searchname"] . "%' ";
}

$limit = "";
if (isset($_GET["limit"])&& is_numeric($_GET["limit"])) {
    $limit = " LIMIT " . $_GET["limit"];
}
    

$orderBy = " ORDER BY az ASC";
if (isset($_GET["action"])) {
    // nev
	if ($_GET["action"] == "order_nev_asc") {
		$orderBy = " ORDER BY nev ASC";
	}
	if ($_GET["action"] == "order_nev_desc") {
		$orderBy = " ORDER BY nev DESC";
    }
    // jellem
	if ($_GET["action"] == "order_jellem_asc") {
		$orderBy = " ORDER BY jellem ASC";
	}
	if ($_GET["action"] == "order_jellem_desc") {
		$orderBy = " ORDER BY jellem DESC";
    }
    // id
	if ($_GET["action"] == "order_id_asc") {
		$orderBy = " ORDER BY az ASC";
	}
	if ($_GET["action"] == "order_id_desc") {
		$orderBy = " ORDER BY az DESC";
    }
    // faj
    if ($_GET["action"] == "order_faj_asc") {
		$orderBy = " ORDER BY faj ASC";
	}
	if ($_GET["action"] == "order_faj_desc") {
		$orderBy = " ORDER BY faj DESC";
    }
    // lakohely
    if ($_GET["action"] == "order_lakohely_asc") {
		$orderBy = " ORDER BY lakohely ASC";
	}
	if ($_GET["action"] == "order_lakohely_desc") {
		$orderBy = " ORDER BY lakohely DESC";
    }
    // ero
    if ($_GET["action"] == "order_ero_asc") {
		$orderBy = " ORDER BY ero ASC";
	}
	if ($_GET["action"] == "order_ero_desc") {
		$orderBy = " ORDER BY ero DESC";
	}
    // szuletesi
    if ($_GET["action"] == "order_szuletesi_asc") {
		$orderBy = " ORDER BY szuletesi ASC";
	}
	if ($_GET["action"] == "order_szuletesi_desc") {
		$orderBy = " ORDER BY szuletesi DESC";
	}
}

$sql = "SELECT * FROM karakterek " . $searchsql .  $orderBy . $limit;

var_dump ($sql);

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>" . "<td>" . $row["az"] . "</td>";
		echo "<td>" . $row["nev"] . "</td>" ;
        echo "<td>" . $row["faj"] . "</td>" ;
        echo "<td>" . $row["lakohely"] . "</td>" ;
        echo "<td>" . $row["ero"] . "</td>" ;
        echo "<td>" . $row["jellem"] . "</td>" ;
        echo "<td>" . $row["szuletesi"] . "</td>" ;

		echo "</tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?> 