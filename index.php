<html>
    <head>
        <meta charset="UTF-8">
        <title>Удаление</title>
    </head>
    <body background="/images/fon.jpg">
        <p><font size=+2>Оставьте ваш комментарий</font></p>
        <form action="index.php" method="post">
           Имя:<input type="Text" name="name" size="20" placeholder="Ваше имя" maxlength="12" minlength="5"><br>
            <textarea type="Text" name="text" rows="10" cols="70" placeholder="Ваш комментарий" maxlength="750" minlength="10"></textarea><br>
            <input type="Submit" value="Отправить!">
        </form>
         <?php
           $name = $_POST["name"];
        $text = $_POST["text"];
         include "db_connect.php";
       if (!empty($name)) {
            if (!empty($text)) {
                if (!mysqli_query($link, $str_sql_query1)) {
                    echo "<br>He могу выполнить запрос на запись<br>";
                    exit();
                }
                echo "<br>Запись добавлена успешно<br>";
            } else {
                echo "Заполните все поля";
                exit();
            }
        }
        
        
// выполнение запроса
        if (!$result = mysqli_query($link, $str_sql_query4)) {
            echo "<br>He могу выполнить запрос<br>";
            exit();
        }
        echo "<br>Запрос выполнен<br><br>";
// вывод результата запроса
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["deleted"]==0){
            print ($row["create_time"]);
            echo "&nbsp &nbsp <b>Пользователь:</b> &nbsp";
            print ($row["name"]);
            echo " <br> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <i><u>Комментарий</u></i><b>:</b> &nbsp";
            print ($row["text"]);
            echo "<br><br>";}
        }
// закрытие соединения с сервером базы данных
        mysqli_close($link);
        ?>
    </body>
</html>
