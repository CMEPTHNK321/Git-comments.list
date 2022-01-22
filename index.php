<?php
session_start();
if ($_SESSION['adminExist']) {
    header("Location: /main_administrator.php");
}
if ($_SESSION['userExist']) {
    header("Location: /main_user.php");
}
error_reporting(0xffff);
//Подключаемся к базе данных 
include "db_connect.php";

//Обрабатываем запросы клиентов на отправку комментариев
include "client_request_process.php";

setcookie("name", $cookieNameClient, time() + 60 * 60 * 24 * 60);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="Image/x-icon" href="/images/favicon.jpg" rel="icon">
        <title>Лист Комментариев</title>
        <!--<link rel="stylesheet" href="/style/style_main_theme_main.css" type="text/css">-->
        <?php
        if (isset($_SESSION['theme'])) {
            print '<link rel="stylesheet" href="/style/style_main_theme_' . $_SESSION['theme'] . '.css" type="text/css">';
            ?>
            <link rel="stylesheet" href="/style/style_main_theme_<?= $_SESSION['theme'] ?>.css" type="text/css">
            <?php
        } else {
//            print '<link rel="stylesheet" href="/style/style_main_theme_white.css" type="text/css">';
            print '<link rel="stylesheet" href="/style/style_main_theme_main.css" type="text/css">';
        }
        ?>
    </head>
    <body>
        <div class="body_wrap">

            <h2 class="chat_welcome">ДОБРО ПОЖАЛОВАТЬ В НАШ ЧАТ!!!</h2>  

            <div class="sticky"><a class="registr_author" href="main_authorization.php">Авторизация и регистрация</a></div>

            <div class="theme"><?php
                if (isset($_SESSION['theme']) and $_SESSION['theme'] === 'black') {
                    print '<a class="registr_author" href="style_theme_change.php?type=white">Белая тема</a>';
                } elseif (isset($_SESSION['theme']) and $_SESSION['theme'] === 'white') {
                    print '<a class="registr_author" href="style_theme_change.php?type=main">Главная тема</a>';
                } else {
                   print '<a class="registr_author" href="style_theme_change.php?type=black">Черная тема</a>'; 
                }
                ?>
            </div>

            <!--            <?php
//// Выводим сообщение установлено ли соединение с сервером БД или нет
//           echo $sbdConnect;
//
////Выводим сообщение установлено ли соединение с БД или нет
//           echo $bdConnect
            ?>  -->

            <?php
            //Выводим комментарии
            include "comments_output.php";
            ?>

            <?php
            //Выводим сообщение о том создался комментарий или нет
            if ($createComment !== true) {
                echo $createComment;
            }
            ?>

            <!-- Оформляем кнопки для взаимодействия с PHP -->
            <div class="form">
                <p class="agitation_main">Оставьте ваш комментарий</p>
                <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="post" >
                    Имя:<input type="Text" name="name" size="20" placeholder="Ваше имя" minlength="5" maxlength="30" value="<?php echo $savedName; ?>" > 
                    <span class="error">* <?php
                        if ($nameErr !== true) {
                            echo $nameErr;
                        }
                        ?></span><br><br>
                    <textarea type="Text" name="text" rows="10" cols="70" placeholder="Ваш комментарий" minlength="10" maxlength="750"><?php echo $savedText; ?></textarea>
                    <span class="error">* <?php
                        if ($textErr !== true) {
                            echo $textErr;
                        }
                        ?></span><br><br>
                    <input type="Submit" value="Отправить!">
                </form>
            </div>

            <?php
//Отключаем соединение с БД за ненадобностью, вроде как 
            include "db_disconnect.php";
            ?>
        </div>
    </body>    
</html>