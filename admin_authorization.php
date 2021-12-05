<?php
include "admin_authorization_process.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="Image/x-icon" href="/images/favicon.jpg" rel="icon">
        <title>Лист Комментариев</title>
        <link rel="stylesheet" href="styles.css" type="text/css">
    </head>
    <body>
        <div class="body_wrap">

            <!-- Оформляем кнопки для взаимодействия с PHP -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                Nickname: <input type="text" name="nickName" size="20"  minlength="5" maxlength="30" > 
                <span class="error">* <?php
                    if ($nickNameErr !== true) {
                        echo $nickNameErr;
                    }
                    ?></span><br><br>
                Parol: <input type="text" name="parol" size="20"  minlength="8" maxlength="16"> 
                <span class="error">* <?php
                    if ($parolErr !== true) {
                        echo $parolErr;
                    }
                    ?></span><br><br>
                <input type="submit">
            </form>
        </div>
    </body>    
</html>