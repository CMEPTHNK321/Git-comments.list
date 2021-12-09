<?php
session_start();
//if ($_SESSION['adminExist']) {
//    header("Location: /main_administrator.php");
//}
//if ($_SESSION['userExist']) {
//    header("Location: /main_user.php");
//}
setcookie("name_reg", $cookieNameClientReg, time() + 60 * 60 * 24 * 60);
include "registration_process.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="Image/x-icon" href="/images/favicon.jpg" rel="icon">
        <title>Регистрация</title>
        <link rel="stylesheet" href="/style/style_auto_reg.css" type="text/css">
    </head>
    <body>
        <div class="body_wrap">
            <!-- Оформляем кнопки для взаимодействия с PHP -->
            <form class="form_autoreg" action="/registration_process.php" method="post">
                <h1 class="error">Введите логин и пароль для регистрации</h1>
                <label>Логин:</label>
                <div>
                    <input type="text" name="login" size="50"  minlength="5" maxlength="30" <?php if (isset($_SESSION['reg_login_try'])) { ?> value="<?= $_SESSION['reg_login_try'] ?>"<?php } else { ?>placeholder="Введите логин"<?php } ?>"> 
                    <span class="error">* <?php
                        if ($_SESSION['nickNameErr'] !== true) {
                            echo $_SESSION['nickNameErr'];
                        }
                        ?></span>
                </div>
                <label>Пароль:</label>
                <div>
                    <input type="password" name="password"  size="50" minlength="6" maxlength="25" placeholder="Введите пароль"> 
                    <span class="error">*<?php
                        if ($_SESSION['parolErr'] !== true) {
                            echo $_SESSION['parolErr'];
                        }
                        ?></span>
                </div>
                <label>Подтверждение пароля:</label>
                <div>
                    <input type="password" name="password_confirm" size="50"  minlength="6" maxlength="25" placeholder="Подтвердите пароль"> 
                    <span class="error">* <?php
                        if ($_SESSION['parolErr'] !== true) {
                            echo $_SESSION['parolErr'];
                        }
                        ?></span>
                </div>
                <button type="submit">Зарегестрироваться</button>
                <p class="button_authorization_place"><span class="button_autorization">У вас уже есть аккаунт?</span><a href="main_authorization.php">АВТОРИЗИРУЙТЕСЬ!</a></p>
                <?php
                if (isset($_SESSION['registr_message'])) {
                    echo "<p class='reg_mes'>" . $_SESSION['registr_message'] . "</p>";
                    unset($_SESSION['registr_message']);
                }
                ?>
            </form>
            <a class="back_to_chat" href="index.php">Вернуться в чат, как гость</a>
        </div>
    </body>    
</html>