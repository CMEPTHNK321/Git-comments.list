<?php
session_start();
unset($_SESSION['adminExist']);
header("Location: /index.php");
