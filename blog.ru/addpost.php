<?php
    if (empty($_SESSION["user_id"])) {
        printf("Доступ запрещен!");
        return;
    }
    if ($_POST["addPost"]) {
        $result = $main->add_post($_POST);
        echo $result["message"];
        $post = $_POST;
    }
    if ($_GET["id"]) {
        $posts = $main->get_posts(array(
            "id" => $_GET["id"]
        ));
        if (empty($posts)) {
            printf ("Запись не существует :(");
            return;
        }
        $post = $posts[0];
        $edit = true;
    }
    if ($_POST["editPost"]) {
        $result = $main->edit_post($_POST);
        echo $result["message"];
        $post = $_POST;
    }
?>

<h3>Расскажите, что у Вас нового?</h3>
<form method="post">
    <div class="add">
        <div>
            <label>Заголовок</label>
            <div>
                <input type="text" name="title" value="<?= $post["title"]?>">
            </div>
        </div>
        <div>
            <label>Пост</label>
            <div>
                <textarea name="text"><?= $post["text"]?></textarea>
            </div>
        </div>
        <div>
            <?php if ($edit) { ?>
                <input type="submit" name="editPost" value="Изменить">
            <?php } else { ?>
                <input type="submit" name="addPost" value="Опубликовать">
            <?php } ?>
            
        </div>
    </div>
</form>