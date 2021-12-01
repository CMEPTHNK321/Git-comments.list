<?php

//ВЫВОДИМ ВСЕ КОММЕНТАРИИ 
//Создаем переменную запроса обращающуюся к нашей таблице в базе данных

$str_sql_query4 = "SELECT * FROM $tblName";

//Создаем запрос на вывод из таблицы всех комментариев 

if (!$result = mysqli_query($link, $str_sql_query4)) {
    echo "<p class='message_err'>НЕ МОГУ ВЫВЕСТИ КОММЕНТАРИИ!!!</p>";
    exit();
}
echo "<p class='message_output'>Вывожу все комментарии</p>";

//Выводим результат запроса в браузер, предварительно сортируя их соответсвено нашим условиям

while ($row = mysqli_fetch_assoc($result)) {
    if ($row["deleted"] == 0) {
        print ("<div class='one_single_comment'>");
        print ("<p class='date_time'>" . $row["create_time"]);
        print ("<span class='polzovatel'>Пользователь:</span>" . $row["name"] . "</p>");
        print ("<div class='text_wrap clearfix'><p class='comments'>Комментарий:</p><p class='textes'>" . $row['text'] . "</p></div>");
        print ("</div>");
    }
}