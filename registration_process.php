<?php
session_start();
require_once 'db_connect.php';
//СОЗДАЕМ ПЕРЕМЕННЫЕ КОТОРЫЕ МОГУТ ПОНАДОБИТСЯ
//Создаем переменную значения $valueCookie для куки
//$cookieNameClientReg = isset($_COOKIE["name_reg"]) ? htmlentities($_COOKIE["name_reg"]) : '';
//Создаем переменную для вывода имени в поле name $savedName
//$savedNickNameReg = $cookieNameClientReg;
//Создаем переменную для ввода текста в поле text $savedText
//$savedParol = '';
//Вводим универсальную переменную ошибки $errFlag
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $login = "Введите логин";
}
$errFlag = true;

//$adminLoginError = "Введите логин и пароль";
//Создаем перменную вывода названия ошибки поля name $nameErr
$_SESSION['nickNameErr'] = true;

//Создаем перменную ошибки поля text $textErr
$_SESSION['parolErr'] = true;

//Создаем перменную вывода сообщения о создании комментария $createComment
//$createComment = true;
//Проверяем метод запроса к серверу
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    //РАБОТАЕМ С ПЕРЕМЕННОЙ $name
    //Проверяем, существуют ли  данные для переменной $name 
    //Если существуют, то создаем переменную $name и экранируем её 
    $login = isset($_POST["login"]) ? htmlentities($_POST["login"]) : '';
    
    if($login !== '') {$_SESSION['reg_login_try'] = $login;}

    //Если в поле ввода имени чтото появилось, мы хоти чтоб это оставалось и дальше,
    //поетому присваиваем переменной $savedName новое значение введенное в поле имени, даже если оно не соответсвует требованиям
//    $savedNickNameReg = $login;
    //Проверяем,чтоб переменная $name не была слишком короткой 
    //Вводим переменную ошибки $nameErr

    if (mb_strlen($login) < 4) {
        $errFlag = false;
        $_SESSION['nickNameErr'] = "Длина имени должна быть не менее 5ти символов";
    }

    //Проверяем, чтоб переменная $name не была слишком длинной

    if (mb_strlen($login) > 30) {
        $errFlag = false;
        $_SESSION['nickNameErr'] = "Длина имени должна быть менее 30ти символов";
    }

    //Проверяем, чтоб в переменной $name были только буквы и пробелы

    if (!preg_match("/^[\p{L} ]*$/u", $login)) {
        $errFlag = false;
        $_SESSION['nickNameErr'] = "Только буквы и пробелы допустимы в имени";
    }

    //Меняем значение переменной $valueCookie, если имя изменилось в соответствии с требованиями
//    if ($errFlag === true) {
//        $cookieNameClient = $name;
//    }
    //РАБОТАЕМ С ПЕРЕМЕННОЙ $text
    //Проверяем, существуют ли  данные для переменной $text
    //Если существуют, то создаем переменную $text и экранируем её 

    $password = isset($_POST["password"]) ? htmlentities($_POST["password"]) : '';

    //Проверяем,чтоб переменная $text не была слишком короткой 
    //Вводим переменную ошибки $textErr

    if (mb_strlen($password) < 5) {
        $errFlag = false;
        $_SESSION['parolErr'] = "Длина пароля должна быть не менее 6-ти символов";
    }

    //Проверяем, чтоб переменная $text не была слишком длинной

    if (mb_strlen($password) > 26) {
        $errFlag = false;
        $_SESSION['parolErr'] = "Длина пароля должна быть менее 26-ти символов";
    }

    $password_confirm = isset($_POST["password_confirm"]) ? htmlentities($_POST["password_confirm"]) : '';

    if (mb_strlen($password_confirm) < 5) {
        $errFlag = false;
        $_SESSION['parolErr'] = "Длина пароля должна быть не менее 6-ти символов";
    }

    //Проверяем, чтоб переменная $text не была слишком длинной

    if (mb_strlen($password_confirm) > 26) {
        $errFlag = false;
        $_SESSION['parolErr'] = "Длина пароля должна быть менее 26-ти символов";
    }

    if ($errFlag == false) {
//        $adminLoginError = "Неверный логин или пароль";
//        $adminLoginError = "Неверный логин или пароль";
        header("Location: /main_registration.php");
    }

    if ($password !== $password_confirm) {
        $errFlag = false;
//        $adminLoginError = "Пароли не совпадают!";
        $_SESSION['registr_message'] = "Пароли не совпадают";
        header("Location: /main_registration.php");
    }

    if ($errFlag == true) {

        $str_sql_query12 = "SELECT * FROM  $tblName2 WHERE login='$login'";
        $check2 = mysqli_query($link, $str_sql_query12);
        //функция mysqli_num_rows($check) подсчитывает количество совпадений в запросе
        $ready2 = mysqli_num_rows($check2);
        if ($ready2 > 0) {
            $_SESSION['registr_message'] = "Логин уже существует";
            header("Location: /main_registration.php");
        } else {
            $password = md5($password);
            $str_sql_query10 = "INSERT INTO $tblName2 (`login`, `password`) VALUES ('$login','$password')";
            mysqli_query($link, $str_sql_query10);
//        $_SESSION['userName']=$login;
            $_SESSION['registr_message'] = "Регистрация прошла успешно";
            unset($_SESSION['reg_login_try']);
            header("Location: /main_authorization.php");
        }
    }
//    if ($errFlag == true AND $nickName == $adminName AND $parol == $adminParol) {
//
//        header("Location: /main_administrator.php");
//        //  echo "<h3 style='text-align: center'><a href='administrator.php'> Нажмите для перехода на страницу администратора</a></h3>";
//        //<a href="authorization.php">Авторизация</a>
//    } else {
//        header("Location: /main_authorization.php");
//    }
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
//    //Изменяем занчение перменной $savedText так, чтобы текст отображался, 
//    //даже если были допуще какие либо ошибки при заполнении полей
//
//    if ($errFlag == false) {
//        $savedText = $text;
//    }
}