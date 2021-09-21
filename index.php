<html>
    <head>
        <meta charset="UTF-8">
        <title>Лист Комментариев</title>
        <style>
            .error {color: #ff0000;}
        </style>
    </head>
    <body background="/images/fon.jpg">

        <?php
        error_reporting(0);
        // Определяем переменные и устанавливаем пустые значения
        $name1Err = $text1Err = "";
        $name1 = $text1 = "";

        //Пишем функцию, которая будет проводить проверку :
        //1.Функция хтмлспеЦиалчарс () преобразует специальные символы в сущности HTML.
        //2.Прокладка ненужных символов (лишнего пространства, табуляции, новой строки) из входных данных пользователя (с помощью функции PHP Trim ())
        //3.Удаление обратной косой черты (\) из входных данных пользователя (с помощью функции PHP stripslashes ())

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        If ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $name1Err = "Введите имя";
            } else {
                $name1 = test_input($_POST["name"]);
            }
        }

        //Проверяем чтоб были только Буквы и пробелы - без цифри всякой ерунды
        if (!preg_match("/^[a-zA-Z ]*$/", $name1)) {
            $name1Err = "Только буквы и пробелы допустимы в имени";
        }

        If ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["text"])) {
                $text1Err = "Напишите Комментарий";
            } else {
                $text1 = test_input($_POST["text"]);
            }
        }
        ?>

        <!-- Оформляем кнопки для взаимодействия с PHP -->

        <p><font size=+2>Оставьте ваш комментарий</font></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            Имя:<input type="Text" name="name" size="20" placeholder="Ваше имя" maxlength="30" minlength="5" value="<?php echo $name1; ?>"> 
            <span class="error">* <?php echo $name1Err; ?></span><br><br>
            <textarea type="Text" name="text" rows="10" cols="70" placeholder="Ваш комментарий" maxlength="750" minlength="10" <?php echo $text1; ?>></textarea>
            <span class="error">* <?php echo $text1Err; ?></span><br><br>
            <input type="Submit" value="Отправить!">
        </form>

        <?php
        $name = $_POST["name"];
        $text = htmlspecialchars($_POST["text"]);
        include "db_connect.php";

//пишем запрос
        $str_sql_query1 = "INSERT INTO $tblName (name, text) VALUES ('$name', '$text')";

//выполняем запрос от пользователя
        if (!empty($name)) {
            if (!empty($text)) {
                if (!mysqli_query($link, $str_sql_query1)) {
                    echo "<br>He могу выполнить запрос на запись<br>";
                } else {
                    echo "<br>Запись добавлена успешно<br>";
                }
            } else {
                echo "Заполните поле комментария";
            }
        }


// выполнение запроса на вывод всех комментариев
        $str_sql_query4 = "SELECT * FROM $tblName";

        if (!$result = mysqli_query($link, $str_sql_query4)) {
            echo "<br>He могу выполнить запрос<br>";
            exit();
        }
        echo "<br>Запрос выполнен<br><br>";
// вывод результата запроса
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
// закрытие соединения с сервером базы данных
        mysqli_close($link);
        ?>

    </body>

</html>
