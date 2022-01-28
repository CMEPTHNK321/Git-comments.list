<?php

if ($_SESSION['adminExist']) {
    header("Location: /main_administrator.php");
} elseif ($_SESSION['userExist']) {
    header("Location: /main_user.php");
} elseif ($_SESSION['moderExist']) {
    header("Location: /main_moderator.php");
} else {
    header("Location: /index.php");
}
