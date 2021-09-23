<?php
error_reporting(0xffff);

//Подключаемся к базе данных 

include "db_connect.php";

//Обрабатываем запросы клиентов на отправку комментариев

include "client_request.php";
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

        <!-- Оформляем кнопки для взаимодействия с PHP -->

        <p><font size=+2>Оставьте ваш комментарий</font></p>
        <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" method="post">
            Имя:<input type="Text" name="name" size="20" placeholder="Ваше имя" minlength="5" maxlength="30" value="<?php
            if (isset($_POST["name"])) {
                echo $name;
            }
            ?>"> 
            <span class="error">* <?php
                if (!empty($nameErr)) {
                    echo $nameErr;
                }
                ?></span><br><br>
            <textarea type="Text" name="text" rows="10" cols="70" placeholder="Ваш комментарий" minlength="10" maxlength="750" value="<?php
            if (!empty($errFlag) and $errFlag == FALSE) {
                echo $text;
            }
            ?>"></textarea>
            <span class="error">* <?php
                if (!empty($textErr)) {
                    echo $textErr;
                }
                ?></span><br><br>
            <input type="Submit" value="Отправить!">
        </form>

        <?php
        //ВЫВОДИМ ВСЕ КОММЕНТАРИИ 
        //Создаем переменную запроса обращающуюся к нашей таблице в базе данных

        $str_sql_query4 = "SELECT * FROM $tblName";

        //Создаем запрос на вывод из таблицы всех комментариев 

        if (!$result = mysqli_query($link, $str_sql_query4)) {
            echo "<br><font color=\"#ff0000\">НЕ МОГУ ВЫВЕСТИ КОММЕНТАРИИ!!!</font><br>";
            exit();
        }
        echo "<br><font color='#0000ff'>Вывожу все комментарии</font><br><br>";

        //Выводим результат запроса в браузер, предварительно сортируя их соответсвено нашим условиям

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["deleted"] == 0) {
                print ($row["create_time"]);
                echo "&nbsp &nbsp <b>Пользователь:</b> &nbsp";
                print ($row["name"]);
                echo " <br> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <i><u>Комментарий</u></i><b>:</b> &nbsp";
                print ($row["text"]);
                echo "<br><br>";
            }
        }

        mysqli_close($link);
        ?>
    </body>

</html>



