<?php
    if (!empty($_SESSION["user_id"])) {
        include_once "account.php";
        return;
    }
    if ($_POST["authForm"]) {
        $result = $main->auth($_POST);
        echo $result["message"];
        if ($result["success"] == 1) {
            return;
        }
    }
?>

<form method="post">
    <div>
        <input type="text" name="login" placeholder="Введите логин">
    </div>
    <div>
        <input type="password" name="password" placeholder="Введите пароль">
    </div>
    <div>
        <input type="submit" name="authForm" value="Войти">
    </div>
</form>



