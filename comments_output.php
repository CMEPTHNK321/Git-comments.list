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