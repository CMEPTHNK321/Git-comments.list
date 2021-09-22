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
    <body background="/images/fon.jpg" background-attachment="fixed">

        <!-- Оформляем кнопки для взаимодействия с PHP -->

        <p><font size=+2>Оставьте ваш комментарий</font></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            Имя:<input type="Text" name="name" size="20" placeholder="Ваше имя" minlength="5" maxlength="30" value="<?php echo $name; ?>"> 
            <span class="error">* <?php
                if (!empty($nameErr)) {
                    echo $nameErr;
                }
                ?></span><br><br>
            <textarea type="Text" name="text" rows="10" cols="70" placeholder="Ваш комментарий" minlength="10" maxlength="750" value="<?php echo $text; ?>"><?php echo $text; ?></textarea>
            <span class="error">* <?php
                if (!empty($textErr)) {
                    echo $textErr;
                }
                ?></span><br><br>
            <input type="Submit" value="Отправить!">
        </form>

        <!-- Начинаем работать с PHP -->

        <?php
        //Подключаемся к базе данных для вывода листа комментариев

        include "db_connect.php";

        //Проверяем на отклик с сервером

        If ($_SERVER["REQUEST_METHOD"] == "POST") {

            //РАБОТАЕМ С ПЕРЕМЕННОЙ $name
            //Проверяем, существуют ли  данные для переменной $name 
            //Если существуют, то создаем переменную $name и экранируем её 
            //Параллельно вводим универсальную переменную ошибки $errFlag


            if (isset($_POST["name"])) {
                $name = htmlentities($_POST["name"]);
                $errFlag = true;

                //Проверяем,чтоб переменная $name не была слишком короткой 
                //Вводим переменную ошибки $nameErr

                if (strlen($name) < 5) {
                    $errFlag = false;
                    $nameErr = "Длина имени должна быть не менее 5ти символов";
                }

                //Проверяем, чтоб переменная $name не была слишком длинной

                if (strlen($name) > 30) {
                    $errFlag = false;
                    $nameErr = "Длина имени должна быть менее 30ти символов";
                }

                //Проверяем, чтоб в переменной $name были только буквы и пробелы

                if (!preg_match("/^[\p{L} ]*$/u", $name)) {
                    $errFlag = false;
                    $nameErr = "Только буквы и пробелы допустимы в имени";
                }
            }

            //РАБОТАЕМ С ПЕРЕМЕННОЙ $text
            //Проверяем, существуют ли  данные для переменной $text
            //Если существуют, то создаем переменную $text и экранируем её 

            if (isset($_POST["text"])) {
                $text = htmlentities($_POST["text"]);

                //Проверяем,чтоб переменная $text не была слишком короткой 
                //Вводим переменную ошибки $textErr

                if (strlen($text) < 10) {
                    $errFlag = false;
                    $textErr = "Длина комментария должна быть не менее 10ти символов";
                }

                //Проверяем, чтоб переменная $text не была слишком длинной

                if (strlen($text) > 750) {
                    $errFlag = false;
                    $nameErr = "Длина комментария должна быть менее 750ти символов";
                }
            }

            if ($errFlag = true) {

                //Создаем переменную запроса для базы данных на создание комментария


                $str_sql_query1 = "INSERT INTO $tblName (name, text) VALUES ('$name', '$text')";

                //Выполняем запрос на создание комментария (создаем запись в базе данных)

                if (!mysqli_query($link, $str_sql_query1)) {
                    echo "<br><font color=\"#ff0000\">HЕ МОГУ СОЗДАТЬ КОММЕНТАРИЙ!!!</font><br>";
                } else {
                    echo "<br><font color=\"#ffffff\" size=\"+3\" >Запись добавлена успешно!</font><br>";
                }
            }
        }

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
