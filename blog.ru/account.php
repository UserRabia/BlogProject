<?php
    $user = $main->get_user_data($_SESSION["user_id"]);
    if ($_GET["route"] == "logout") {
        $result = $main->logout();
        echo $result;
    }
?>

<div class="account">
    <div>
        <b>Пользователь <?= $user["username"];?></b>
    </div>
    <div>
        <a href="/?route=addpost">Добавить пост</a>
    </div>
    <div>
        <a href="/?route=logout">Выйти</a>
    </div>
</div>