<?php
//ВЫВОДИМ СПИСОК ПОЛЬЗОВАТЕЛЕЙ
//Создаем переменную запроса обращающуюся к нашей таблице в базе данных
//$str_sql_query14 = "SELECT `login`,`group` FROM $tblName2 ORDER BY `login` ASC";   ('admin','moder','user','ban')    , `login` ASC
$str_sql_query14 = "SELECT `group`,`login` FROM $tblName2 ORDER BY FIELD(`group`,'admin','moder','user','ban'), `login` ASC";
//print $str_sql_query14;
//Создаем запрос на вывод из таблицы всех комментариев 
$resultChange = mysqli_query($link, $str_sql_query14);
?>

<!--<form  action="admin_client_change.php" method="post">-->

<?php
while ($rowChange = mysqli_fetch_assoc($resultChange)) {

    if ($rowChange['group'] == 'admin') {
        $changeColor = "#96bb72";
    } elseif ($rowChange['group'] == 'moder') {
        $changeColor = "#ffdb00";
    } elseif ($rowChange['group'] == 'user') {
        $changeColor = "#67E300";
    } else {
        $changeColor = "#E065BB";
    }
    ?>
    <form class="form" style="background-color: <?= $changeColor ?>"  action="admin_client_change.php" method="post">
        <p><span class="useless">Пользователь:  <span class="user"><?= $rowChange["login"] ?></span></span>
            <span class="status">Статус:  <span class="stat"><?= $rowChange["group"] ?></span></span>
            <input type="hidden" name="userNameChange" value="<?= $rowChange["login"] ?>">
            <span class="change"><select name="mode">
                    <option disabled selected >Изменить статус</option>
                    <option value="user">User</option>
                    <option value="admin">Administrator</option>
                    <option value="moder">Moderator</option>
                    <option value="ban">Ban</option>
                </select>
                <input type="submit" name="userChange" value="Применить"></span></p>
    </form>

    <?php
}
?>
<!--</form>-->