<?php

session_start();
require_once 'db_connect.php';
//$_SESSION['userExist'] = 0;
//$_SESSION['adminExist'] = 0;
//СОЗДАЕМ ПЕРЕМЕННЫЕ КОТОРЫЕ МОГУТ ПОНАДОБИТСЯ
//Создаем переменную значения $valueCookie для куки
//$cookieNameClient = isset($_COOKIE["name"]) ? htmlentities($_COOKIE["name"]) : '';
//Создаем переменную для вывода имени в поле name $savedName
//$savedNickName = $cookieNameClient;
//Создаем переменную для ввода текста в поле text $savedText
//$savedParol = '';
//Вводим универсальную переменную ошибки $errFlag
$errFlag = true;

//$adminName = "Maxym";
//
//$adminParol = "12345678";
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
    $nickName = isset($_POST["nickName"]) ? htmlentities($_POST["nickName"]) : '';

    if ($nickName !== '') {
        $_SESSION['login_try'] = $nickName;
    }

//unset($_SESSION['login_try']);
//Если в поле ввода имени чтото появилось, мы хоти чтоб это оставалось и дальше,
//поетому присваиваем переменной $savedName новое значение введенное в поле имени, даже если оно не соответсвует требованиям
//$savedNickName = $nickName;
//Проверяем,чтоб переменная $name не была слишком короткой 
//Вводим переменную ошибки $nameErr

    if (mb_strlen($nickName) < 4) {
        $errFlag = false;
        $_SESSION['nickNameErr'] = "Длина имени должна быть не менее 5ти символов";
    }

//Проверяем, чтоб переменная $name не была слишком длинной

    if (mb_strlen($nickName) > 30) {
        $errFlag = false;
        $_SESSION['nickNameErr'] = "Длина имени должна быть менее 30ти символов";
    }

//Проверяем, чтоб в переменной $name были только буквы и пробелы

    if (!preg_match("/^[\p{L} ]*$/u", $nickName)) {
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

    $parol = isset($_POST["parol"]) ? htmlentities($_POST["parol"]) : '';

//Проверяем,чтоб переменная $text не была слишком короткой 
//Вводим переменную ошибки $textErr

    if (mb_strlen($parol) < 5) {
        $errFlag = false;
        $_SESSION['parolErr'] = "Длина пароля должна быть не менее 6-ти символов";
    }

//Проверяем, чтоб переменная $text не была слишком длинной

    if (mb_strlen($parol) > 26) {
        $errFlag = false;
        $_SESSION['parolErr'] = "Длина пароля должна быть менее 26ти символов";
    }

    if ($errFlag == false) {
//        $adminLoginError = "Неверный логин или пароль";
        $_SESSION['registr_message'] = "Пароль или логин не соответствует требованиям";
        header("Location: /main_authorization.php");
        exit();
    }

//    if ($errFlag == true AND $nickName == $adminName AND $parol == $adminParol) {
//
//        $_SESSION['userGroup'] = 'admin';
//        unset($_SESSION['login_try']);
//        header("Location: /main_administrator.php");
//        exit();
//  echo "<h3 style='text-align: center'><a href='administrator.php'> Нажмите для перехода на страницу администратора</a></h3>";
//<a href="authorization.php">Авторизация</a>
//    }

    if ($errFlag == true) {
//шифруем пароль
        $parol = md5($parol);

        //Создаем и выполняем запрос по поиску пользователей в базе данных
        $str_sql_query11 = "SELECT `group` FROM  $tblName2 WHERE `login`='$nickName' AND `password`='$parol'";
        $check = mysqli_query($link, $str_sql_query11);
//функция mysqli_num_rows($check) подсчитывает количество совпадений в запросе
//        $ready = mysqli_num_rows($check);
        $ready = mysqli_fetch_assoc($check);
        if ($ready["group"] == "user") {
            $_SESSION['userName'] = $nickName;
            $_SESSION['userGroup'] = 'user';
            unset($_SESSION['login_try']);
            header("Location: /main_user.php");
            exit();
        } elseif ($ready["group"] == "moder") {
            $_SESSION['userName'] = $nickName;
            $_SESSION['userGroup'] = 'moder';
            unset($_SESSION['login_try']);
            header("Location: /main_moderator.php");
            exit();
        } elseif ($ready["group"] == "admin") {
            $_SESSION['userGroup'] = 'admin';
            unset($_SESSION['login_try']);
            header("Location: /main_administrator.php");
            exit();
        } elseif ($ready["group"] == "ban") {
            $_SESSION['registr_message'] = "Данный аккаунт заблокирован";
            header("Location: /main_authorization.php");
            exit();
        } else {
            $_SESSION['registr_message'] = "Не верный логин или пароль";
            header("Location: /main_authorization.php");
            exit();
        }
// //Создаем и выполняем запрос по поиску модераторов в базе данных
//        $str_sql_query12 = "SELECT * FROM  $tblName2 WHERE login='$nickName' AND password='$parol' AND group='moder'";
//        $checkModer = mysqli_query($link, $str_sql_query12);
////функция mysqli_num_rows($check) подсчитывает количество совпадений в запросе
//        $readyModer = mysqli_num_rows($checkModer);
//        if ($readyModer > 0) {
//            $_SESSION['userName'] = $nickName;
//            $_SESSION['moderExist'] = 1;
//            unset($_SESSION['login_try']);
//            header("Location: /main_moderator.php");
//            exit();
//        }
    } else {
//            $adminLoginError = "Неверный логин или пароль";
        $_SESSION['registr_message'] = "Не верный логин или пароль";
        header("Location: /main_authorization.php");
        exit();
    }
}