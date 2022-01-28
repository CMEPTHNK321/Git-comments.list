<?php
session_start();

//Проводим проверку на существование сессиии и перенаправляем на соответствующую страницу!
//include "session_exist.php";

if (!$_SESSION['userGroup'] == 'admin') {
    header("Location: /index.php");
}
error_reporting(0xffff);
//Подключаемся к базе данных 
include "db_connect.php";

?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="Image/x-icon" href="/images/favicon.jpg" rel="icon">
        <title>Администратор</title>
        <link rel="stylesheet" href="/style/style_distr_theme_white.css" type="text/css">
       
    </head>
    <body>
        <div class="body_wrap">

            <h2 class="chat_welcome">РЕЖИМ ИЗМЕНЕНИЯ ПРАВ ПОЛЬЗОВАТЕЛЕЙ</h2>  

            <div class="sticky"><a class="registr_author" href="exit.php">Выйти из режима Администратора</a></div>

            <div class="distribution"><a class="right" href="main_administrator.php">Вернуться в режим Админа</a></div>

           <?php
           include_once 'admin_client_output.php';
           ?>
            
            <?php
            //Отключаем соединение с БД за ненадобностью, вроде как 
            include "db_disconnect.php";
            ?>

        </div>
    </body>    
</html>