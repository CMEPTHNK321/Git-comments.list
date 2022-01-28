<?php

include "db_connect.php";
//$idActive = isset($_POST["that"]) ? htmlentities($_POST["that"]) : '';
if (isset($_POST['userChange'])) {
    $modeChange = $_POST['mode'];
    $userName = $_POST['userNameChange'];
    
    

//    foreach ($modeChange as $modeChangeValue) {
        
//        $justDelete = $deleteMessageId;

        $str_sql_query16 = "UPDATE $tblName2 SET `group` = '$modeChange' WHERE `login` = '$userName'";

        mysqli_query($link, $str_sql_query16);
    }
//}
header("Location: /distribution.php");