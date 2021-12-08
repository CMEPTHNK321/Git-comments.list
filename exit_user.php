<?php
session_start();
unset($_SESSION['userExist']);
header("Location: /index.php");
