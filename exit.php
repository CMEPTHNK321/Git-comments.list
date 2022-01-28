<?php
session_start();
unset($_SESSION['userGroup']);
header("Location: /index.php");
