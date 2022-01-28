<?php
session_start();
if (isset($_GET['type']) and in_array($_GET['type'], ['black', 'white', 'main'])) {
    $_SESSION['theme'] = $_GET['type'];
} 

if ( $_SESSION['theme'] ==  'main') {
   unset($_SESSION['theme']) ;
}

header('location: ' . $_SERVER['HTTP_REFERER']);