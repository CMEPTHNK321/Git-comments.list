<?php

include "db_connect.php";
//$idActive = isset($_POST["that"]) ? htmlentities($_POST["that"]) : '';
if (isset($_POST["delete_multiple_messages"])) {
    $idActive = $_POST["that"];


    foreach ($idActive as $deleteMessageValue) {
        
//        $justDelete = $deleteMessageId;

        $str_sql_query15 = "UPDATE $tblName SET deleted = '1' WHERE id = '$deleteMessageValue'";

        mysqli_query($link, $str_sql_query15);
    }
}
header("Location: main_administrator.php");