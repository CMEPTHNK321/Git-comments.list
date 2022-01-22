<?php
session_start();
unset($_SESSION['userExist']);
unset($_SESSION['userName']);
header("Location: /index.php");
