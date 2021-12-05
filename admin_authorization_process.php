<?php

//СОЗДАЕМ ПЕРЕМЕННЫЕ КОТОРЫЕ МОГУТ ПОНАДОБИТСЯ
//Создаем переменную значения $valueCookie для куки
//$cookieNameClient = isset($_COOKIE["name"]) ? htmlentities($_COOKIE["name"]) : '';
//Создаем переменную для вывода имени в поле name $savedName
//$savedNickName = $cookieNameClient;
//Создаем переменную для ввода текста в поле text $savedText
//$savedParol = '';
//Вводим универсальную переменную ошибки $errFlag
$errFlag = true;

$adminName="Maxym";

$adminParol="12345678";

//Создаем перменную вывода названия ошибки поля name $nameErr
$nickNameErr = true;

//Создаем перменную ошибки поля text $textErr
$parolErr = true;

//Создаем перменную вывода сообщения о создании комментария $createComment
//$createComment = true;
//Проверяем метод запроса к серверу
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    //РАБОТАЕМ С ПЕРЕМЕННОЙ $name
    //Проверяем, существуют ли  данные для переменной $name 
    //Если существуют, то создаем переменную $name и экранируем её 
    $nickName = isset($_POST["nickName"]) ? htmlentities($_POST["nickName"]) : '';

    //Если в поле ввода имени чтото появилось, мы хоти чтоб это оставалось и дальше,
    //поетому присваиваем переменной $savedName новое значение введенное в поле имени, даже если оно не соответсвует требованиям
    //$savedNickName = $nickName;
    //Проверяем,чтоб переменная $name не была слишком короткой 
    //Вводим переменную ошибки $nameErr

    if (mb_strlen($nickName) < 4) {
        $errFlag = false;
        $nickNameErr = "Длина имени должна быть не менее 5ти символов";
    }

    //Проверяем, чтоб переменная $name не была слишком длинной

    if (mb_strlen($nickName) > 30) {
        $errFlag = false;
        $nickNameErr = "Длина имени должна быть менее 30ти символов";
    }

    //Проверяем, чтоб в переменной $name были только буквы и пробелы

    if (!preg_match("/^[\p{L} ]*$/u", $nickName)) {
        $errFlag = false;
        $nickNameErr = "Только буквы и пробелы допустимы в имени";
    }

    //Меняем значение переменной $valueCookie, если имя изменилось в соответствии с требованиями
//    if ($errFlag === true) {
//        $cookieNameClient = $name;
//    }
    //РАБОТАЕМ С ПЕРЕМЕННОЙ $text
    //Проверяем, существуют ли  данные для переменной $text
    //Если существуют, то создаем переменную $text и экранируем её 

    $parol = isset($_POST["parol"]) ? htmlentities($_POST["parol"]) : '';

    //Проверяем,чтоб переменная $text не была слишком короткой 
    //Вводим переменную ошибки $textErr

    if (mb_strlen($parol) < 7) {
        $errFlag = false;
        $parolErr = "Длина пароля должна быть не менее 8ми символов";
    }

    //Проверяем, чтоб переменная $text не была слишком длинной

    if (mb_strlen($parol) > 16) {
        $errFlag = false;
        $parolErr = "Длина пароля должна быть менее 16ти символов";
    }

    if ($errFlag == true AND $nickName == $adminName AND $parol == $adminParol) {
        echo "<h3 style='text-align: center'><a href='administrator.php'> Нажмите для перехода на страницу администратора</a></h3>";
        //<a href="authorization.php">Авторизация</a>
    }

//    if ($errFlag == true) {
//
//    //Создаем переменную запроса для базы данных на создание комментария
//
//        $str_sql_query1 = "INSERT INTO $tblName (name, text) VALUES ('$name', '$text')";
//
//    //Выполняем запрос на создание комментария (создаем запись в базе данных)
//
//        if (!mysqli_query($link, $str_sql_query1)) {
//            $createComment = "<br><font color=\"#ff0000\">HЕ МОГУ СОЗДАТЬ КОММЕНТАРИЙ!!!</font><br>";
//        } else {
//            $createComment = "<br><font color=\"#ff00ff\" size=\"+3\" >Запись добавлена успешно!</font><br>";
//        }
//    }
//
//
//    //Изменяем занчение перменной $savedText так, чтобы текст отображался, 
//    //даже если были допуще какие либо ошибки при заполнении полей
//
//    if ($errFlag == false) {
//        $savedText = $text;
//    }
}