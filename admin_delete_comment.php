<?php
include "db_connect.php";
$idActive = isset($_POST["that"]) ? htmlentities($_POST["that"]) : '';

//$idActive = $_POST["that"];
//   $idActive = $conn->real_escape_string($_POST["that"]);


$str_sql_query15 = "UPDATE $tblName SET deleted = '1' WHERE id = '$idActive'";

mysqli_query($link, $str_sql_query15);

header("Location: administrator.php");