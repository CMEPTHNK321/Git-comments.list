<?php
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
        <link rel="stylesheet" href="styles.css" type="text/css">
    </head>
    <body>
        <div class="body_wrap">
            <?php
// Выводим сообщение установлено ли соединение с сервером БД или нет
            echo $sbdConnect;

//Выводим сообщение установлено ли соединение с БД или нет
            echo $bdConnect
            ?>  

            <?php
            //Выводим сообщение о том создался комментарий или нет
            if ($createComment !== true) {
                echo $createComment;
            }
            ?>

            <?php
            //Выводим комментарии
            include "comments_output.php";
            ?>

            <!-- Оформляем кнопки для взаимодействия с PHP -->
            <h1>Оставьте ваш комментарий</h1>
            <div class="form">
                <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="post" ">
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