<html>
    <head>
        <title>Учись магии</title>
    </head>
    <body background="/images/fon.jpg">
        <?php
        $sdb_name = "files.000webhost.com";
        $user_name = "Asuna-god";
        $user_password = "@NH)uo@^$XV8A&srX1I5";
        $db_name = "test_db";
        $tblName = "ListComments";
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
  `name` varchar(100) DEFAULT NULL,
  `text` text,
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

        //Для удобства в самом начале имеет смысл ввести несколько переменных, которые будут содержать в себе имена баз данных, таблиц, пользователя и т.д. 
        //Затем соединяемся с сервером. Для работы с определенной базой данных нужно ее выбрать. 
        //Эту операцию выполняет функция mysql_select_db(), которая принимает в качестве входных параметров имя базы данных и указатель на соединение. 
        //В случае отсутствия указателя используется последнее созданное соединение с сервером базы данных. Функция возвращает TRUE в случае успеха, иначе - FALSE.
        //В нашем примере непосредственное создание таблицы осуществляется с помощью SQL-запроса. 
        //Ключевые слова CREAT TABLE говорят серверу базы данных, что нужно создать таблицу. 
        //Затем следует ее имя (в данном случае book), после чего в скобках описываются все поля этой таблицы с указанием типов данных, 
        //а именно id (идентификационный номер), name (название), author (автор), num_pages (количество страниц). 
        //Для удаления таблицы выполняются такие же действия, но с другим запросом: DROP TABLE book
        ?>
    </body>
</html>