        <?php
        $sdb_name = "localhost";
        $user_name = "root";
        $user_password = "root";
        $db_name = "test_db";
        $tblName = "ListComments";
      

        //Строки запросов для работы с таблицей
        $str_sql_query1 = "INSERT INTO $tblName (name, text) VALUES ('$name', '$text')";  //Для внесения записей в таблицу - INSERT INTO
        //Обратите внимание, что поле id не указанно в запросе. Дело в том, что при создании оно было отмечено с параметром AUTO_INCREMENT (авто увеличение). 
        //Другими словами, при добавлении записи это поле автоматически получает значение на единицу больше, чем в предыдущей записи. Отсчет начинается с единицы.
        //Но можно и вручную присвоить id, типа (id, name, author, num_pages) 
        //Менять местами можно, типа (author, name, num_pages)

        $str_sql_query2 = "DELETE FROM $tblName WHERE author = 'Зачемто'";  //Для удаления записей используется SQL-запрос с ключевым словом DELETE.
        //Несложно заметить, что после слов DELETE FROM нужно указать имя базы данных (book), а затем условие, по которому можно найти записи для удаления.
        //Если оператор DELETE запускается без определения WHERE, то удаляются все строки. 
        //Можно задать несколько параметров для удаления через AND, типа "DELETE FROM $tblName WHERE author = 'Зачемто' AND name = 'Ктото'";

        $str_sql_query3 = "UPDATE $tblName SET num_pages = 333 WHERE name = 'Чтото'";  //Для изменения уже существующих данных используется команда UPDATE. 
        //После слова UPDATE нужно указать имя таблицы, где необходимо изменить данные. 
        //Затем задается новое значение (в нашем случае мы изменяем количество страниц с какогото значения на 333) и условие.
        //Можно задать несколько параметров для удаления через AND, типа "UPDATE $tblName SET num_pages = 333 WHERE name = 'Чтото' AND author = 'Сидоров'";
        //
        $str_sql_query4 = "SELECT * FROM $tblName";
      
        $str_sql_query6 = "DELETE FROM $tblName WHERE (`name` IS NULL OR `name` = '') AND (`text` IS NULL OR `text` = '')";
        
// соединение с сервером базы данных
        if (!$link = mysqli_connect($sdb_name, $user_name, $user_password)) {
            echo "<br>He могу соединиться с сервером базы данных <br>";
            exit();
        }
        echo "<br>Соединение с сервером базы данных  установлено успешно<br>";
// выбираем базу данных
        if (!mysqli_select_db($link, $db_name)) {
            echo "<br>He могу выбрать базу данных e<br>";
            exit();
        }
        echo "<br>Выбрана база данных <br>";

// выполнение запроса
     
        ?>


