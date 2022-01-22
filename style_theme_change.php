<?php
session_start();
if (isset($_GET['type']) and in_array($_GET['type'], ['black', 'white', 'main'])) {
    $_SESSION['theme'] = $_GET['type'];
}

header('location: ' . $_SERVER['HTTP_REFERER']);