<?php
//ВЫВОДИМ ВСЕ КОММЕНТАРИИ 
//Создаем переменную запроса обращающуюся к нашей таблице в базе данных
$str_sql_query4 = "SELECT * FROM $tblName";

//Создаем запрос на вывод из таблицы всех комментариев 
$result = mysqli_query($link, $str_sql_query4);

//устанавливаем локаль для вывода времени на русском
//setlocale(LC_ALL, 'ru_RU.CP1251', 'rus_RUS.CP1251', 'Russian_Russia.1251'); // 'ru_RUS', 'ru_RUS.UTF-8', 'ru', 'russian'
//strftime("%Y %B %d %H:%M", $commentUnixTime)
//Выводим результат запроса в браузер, предварительно сортируя их соответсвено нашим условиям
while ($row = mysqli_fetch_assoc($result)) {
    if ($row["deleted"] == 0) {

        //задаем переменную времени комментария
        $commentUnixTime = strtotime($row['create_time']);

        $id = $row["id"];

        //задаем переменную цвета времени комментария
        $commentDateColor = "#CCC";  //#CCC

        if (strtotime(date("Y-m-d")) <= $commentUnixTime) {
            $commentDateColor = "black";
        }

//        else if (Y-)
        else if (strtotime(date("Y-m-01")) >= $commentUnixTime) {
            $commentDateColor = "red"; //rgba(100,100,100, 0.3)
        } else {
            $commentDateColor = "green";
        }

        ?>
        <form action="admin_delete_comment.php" method="post" >
            <div class='one_single_comment'>
                <p class='date_time'>
                    <span class='polzovatel'>Пользователь:</span>
                    <?= $row["name"] ?> 
                    <span class='show_time' style="color:<?= $commentDateColor ?>"><?= date("Y M d H:i", $commentUnixTime) ?></span>
                    <span class='write'>написал</span>
                    <span class="delete_button">
                        <input type="text" name="that" value = "<?= $id ?>">
                        <input type="submit" value="Удалить">
                        <!--<input type="submit" name="that" value="<?= $id ?>"><span><<Удалить комментраий</span>-->
                    </span></p>
                <div class='text_wrap clearfix'>
                    <p class='textes'><?= $row['text'] ?></p>
                </div>
            </div>
        </form>
        <?php
    }
}