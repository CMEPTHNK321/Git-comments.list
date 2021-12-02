<?php

//ВЫВОДИМ ВСЕ КОММЕНТАРИИ 
//Создаем переменную запроса обращающуюся к нашей таблице в базе данных

$str_sql_query4 = "SELECT * FROM $tblName";

//Создаем запрос на вывод из таблицы всех комментариев 

$result = mysqli_query($link, $str_sql_query4);
//        if () {
//    echo "<p class='message_err'>НЕ МОГУ ВЫВЕСТИ КОММЕНТАРИИ!!!</p>";
//    exit();
//}
//echo "<p class='message_welcome'>ДОБРО ПОЖАЛОВАТЬ В НАШ ЧАТ!!!</p>";

//Выводим результат запроса в браузер, предварительно сортируя их соответсвено нашим условиям

while ($row = mysqli_fetch_assoc($result)) {
    if ($row["deleted"] == 0) {
        print ("<div class='one_single_comment'>");
        print ("<p class='date_time'>" . "<span class='polzovatel'>Пользователь:</span>" . $row["name"] . "<span class='show_time'>{$row['create_time']}</span>" . "</p>");
        print ("<div class='text_wrap clearfix'><p class='textes'>" . $row['text'] . "</p></div>");
        print ("</div>");
    }
}