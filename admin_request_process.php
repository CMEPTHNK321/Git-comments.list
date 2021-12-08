<?php

//СОЗДАЕМ ПЕРЕМЕННЫЕ КОТОРЫЕ МОГУТ ПОНАДОБИТСЯ
//Создаем переменную значения $valueCookie для куки
$cookieNameClient = isset($_COOKIE["name"]) ? htmlentities($_COOKIE["name"]) : '';

//Создаем переменную для вывода имени в поле name $savedName
$savedName = $cookieNameClient;

//Создаем переменную для ввода текста в поле text $savedText
$savedText = '';

//Вводим универсальную переменную ошибки $errFlag
$errFlag = true;

//Создаем перменную вывода названия ошибки поля name $nameErr
$nameErr = true;

//Создаем перменную ошибки поля text $textErr
$textErr = true;

//Создаем перменную вывода сообщения о создании комментария $createComment
$createComment = true;

//Проверяем метод запроса к серверу
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    //РАБОТАЕМ С ПЕРЕМЕННОЙ $name
    //Проверяем, существуют ли  данные для переменной $name 
    //Если существуют, то создаем переменную $name и экранируем её 
    $name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : '';

    //Если в поле ввода имени чтото появилось, мы хоти чтоб это оставалось и дальше,
    //поетому присваиваем переменной $savedName новое значение введенное в поле имени, даже если оно не соответсвует требованиям

    $savedName = $name;

    //Проверяем,чтоб переменная $name не была слишком короткой 
    //Вводим переменную ошибки $nameErr

    if (mb_strlen($name) < 5) {
        $errFlag = false;
        $nameErr = "Длина имени должна быть не менее 5ти символов";
    }

    //Проверяем, чтоб переменная $name не была слишком длинной

    if (mb_strlen($name) > 30) {
        $errFlag = false;
        $nameErr = "Длина имени должна быть менее 30ти символов";
    }

    //Проверяем, чтоб в переменной $name были только буквы и пробелы

    if (!preg_match("/^[\p{L} ]*$/u", $name)) {
        $errFlag = false;
        $nameErr = "Только буквы и пробелы допустимы в имени";
    }

    //Меняем значение переменной $valueCookie, если имя изменилось в соответствии с требованиями

    if ($errFlag === true) {
        $cookieNameClient = $name;
    }

    //РАБОТАЕМ С ПЕРЕМЕННОЙ $text
    //Проверяем, существуют ли  данные для переменной $text
    //Если существуют, то создаем переменную $text и экранируем её 

    $text = isset($_POST["text"]) ? htmlentities($_POST["text"]) : '';

    //Проверяем,чтоб переменная $text не была слишком короткой 
    //Вводим переменную ошибки $textErr

    if (mb_strlen($text) < 10) {
        $errFlag = false;
        $textErr = "Длина комментария должна быть не менее 10ти символов";
    }

    //Проверяем, чтоб переменная $text не была слишком длинной

    if (mb_strlen($text) > 750) {
        $errFlag = false;
        $textErr = "Длина комментария должна быть менее 750ти символов";
    }



    if ($errFlag == true) {

        //Создаем переменную запроса для базы данных на создание комментария

        $str_sql_query1 = "INSERT INTO $tblName (name, text) VALUES ('$name', '$text')";

        //Выполняем запрос на создание комментария (создаем запись в базе данных)

        mysqli_query($link, $str_sql_query1);
//         if (!) {   $createComment = "<br><font color=\"#ff0000\">HЕ МОГУ СОЗДАТЬ КОММЕНТАРИЙ!!!</font><br>";
//        } else {
//            $createComment = "<br><p style=\"color:#ff00ff; font-size:large; margin\">Запись добавлена успешно!</p><br>";
//        }
    }


    //Изменяем занчение перменной $savedText так, чтобы текст отображался, 
    //даже если были допуще какие либо ошибки при заполнении полей

    if ($errFlag == false) {
        $savedText = $text;
    }


//  $idActive = isset($_POST["that"]) ? htmlentities($_POST["that"]) : '';
//    
// //$idActive = $_POST["that"];
//    
// //   $idActive = $conn->real_escape_string($_POST["that"]);
//
//
//            $str_sql_query15 = "UPDATE $tblName SET deleted = '1' WHERE id = '$idActive'";
//
//            mysqli_query($link, $str_sql_query15);
//        }
//    }
}