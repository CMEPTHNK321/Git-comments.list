<html>
    <head>
        <meta charset="UTF-8">
        <title>Лист Комментариев</title>
    </head>
    <body background="/images/fon.jpg">
        <p><font size=+2>Оставьте ваш комментарий</font></p>
        <form action="test.php" method="post">
           Имя:<input type="Text" name="name" size="20" placeholder="Ваше имя" maxlength="12" minlength="5"><br>
            <textarea type="Text" name="text" rows="10" cols="70" placeholder="Ваш комментарий" maxlength="750" minlength="10"></textarea><br>
            <input type="Submit" value="Отправить!">
        </form>
         <?php
         $sdb_name = "localhost";
        $user_name = "root";
        $user_password = "root";
        $db_name = "test_db";
        $tblName = "ListComments";
        $name = $_POST["name"];
        $text = $_POST["text"];

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
        
        $str_sql_query4 = "SELECT * FROM $tblName";
        
        $str_sql_query5 = "DELETE t1,t2 FROM t1,t2,t3 WHERE t1.id=t2.id AND t2.id=t3.id";

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

// выполнение запроса
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
        
        
         $str_sql_query4 = "SELECT * FROM $tblName";
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
            echo "&nbsp &nbsp <b>Пользователь</b>:";
            print ($row["name"]);
            echo " <br> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <i><u>Комментарий</u></i>:";
            print ($row["text"]);
            echo "<br><br>";}
        }
// закрытие соединения с сервером базы данных
        mysqli_close($link);
        ?>
    </body>
</html>
