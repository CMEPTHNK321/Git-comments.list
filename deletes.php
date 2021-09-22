<html>
    <head>
        <title>Учись магии</title>
    </head>
    <body background="/images/fon.jpg">
        <?php
        include "db_connect.php";

        $str_sql_query4 = "SELECT * FROM $tblName";

        $str_sql_query6 = "DELETE FROM $tblName WHERE (`name` IS NULL OR `name` = '') AND (`text` IS NULL OR `text` = '')";

        if (!$result1 = mysqli_query($link, $str_sql_query4)) {
            echo "<br>He могу выполнить запрос<br>";
            exit();
        }
        echo "<br>Запрос выполнен<br><br>";

//Удаление пустых строк из столбцов
        while ($row = mysqli_fetch_assoc($result1)) {
            mysqli_query($link, $str_sql_query6);
        }

        echo "Задача выполнена";
        // закрытие соединения с сервером базы данных
        mysqli_close($link);
        ?>
    </body>
</html>