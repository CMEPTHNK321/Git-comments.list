<?php
error_reporting(0xffff);

//Подключаемся к базе данных 

include "db_connect.php";

//Обрабатываем запросы клиентов на отправку комментариев

include "client_request_process.php";

setcookie("name", $valueCookie, time() + 60 * 60 * 24 * 60);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Лист Комментариев</title>
        <style>
            .error {color: #ff0000;}
            body {background-attachment: fixed, fixed;
            }
        </style>
    </head>
    <body background="/images/fon.jpg" ">
        <?php
// Выводим сообщение установлено ли соединение с сервером БД или нет

        echo $sbdConnect;

//Выводим сообщение установлено ли соединение с БД или нет

        echo $bdConnect
        ?>  

        <!-- Оформляем кнопки для взаимодействия с PHP -->

        <p><font size=+2>Оставьте ваш комментарий</font></p>
        <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="post" ">
            Имя:<input type="Text" name="name" size="20" placeholder="Ваше имя" minlength="5" maxlength="30" value="<?php echo $savedName; ?>" > 
            <span class="error">* <?php
                if ($nameErr !== true) {
                    echo $nameErr;
                }
                ?></span><br><br>
            <textarea type="Text" name="text" rows="10" cols="70" placeholder="Ваш комментарий" minlength="10" maxlength="750" value="<?php echo $savedText; ?>"></textarea>
            <span class="error">* <?php
                if ($textErr !== true) {
                    echo $textErr;
                }
                ?></span><br><br>
            <input type="Submit" value="Отправить!">
        </form>

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

        <?php
        //Отключаем соединение с БД за ненадобностью, вроде как 
        include "db_disconnect.php";
        ?>
    </body>

</html>