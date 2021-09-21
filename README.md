  <?php
        $sdb_name = "*****";
        $user_name = "*****";
        $user_password = "*****";
        $db_name = "*****";
        $tblName = "*****";
// соединение с сервером базы данных
        if (!$link = mysqli_connect($sdb_name, $user_name, $user_password)) {
            echo "<br>He могу соединиться с сервером базы данных $sdb_name<br>";
            exit();
        }
        echo "<br>Соединение с сервером базы данных $sdb_name установлено успешно<br>";
// выбираем базу данных
        if (!mysqli_select_db($link, $db_name)) {
            echo "<br>He могу выбрать базу данных $db_name<br>";
            exit();
        }
        echo "<br>Выбрана база данных $db_name<br>";
// строка запроса
        $str_sql_query = "CREATE TABLE $tblName (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `\"$tblName\"_id_IDX` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4"
        ;
// выполнение запроса
        if (!mysqli_query($link, $str_sql_query)) {
            echo "<br>He могу выполнить запрос на создание таблицы $tblName<br>";
            exit();
        }
        echo "<br>Таблица $tblName создана успешно<br>";
        // закрытие соединения с сервером базы данных
        mysqli_close($link);
        ?>