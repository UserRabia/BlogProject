<?php
    $posts = $main->get_posts(array(
        "id" => $_GET["id"]
    ));
    if (empty($posts)) {
        printf ("Запись не существует :(");
        return;
    }
    $row = $posts[0];
    if ($_POST["deletePost"]) {
        echo $main->delete_post();
    }
?>

<div class="posts">
    <article>
        <h3>
            <?= $row["title"] ?>
        </h3>
        <div class="date">
            <?= date("d.m.Y, H:i",strtotime($row["pub_date"]))?>
        </div>
        <div class="text">
            <?= nl2br($row["text"]) ?>
        </div>
        <?php if($_SESSION["user_id"] == $row["author_id"]) { ?>
        <div class="tools">
            <div>
                <a href="/?route=addpost&id=<?= $row["id"] ?>">
                    Изменить
                </a>
            </div>
            <div>
                <form method="post" onsubmit="return confirm('Вы действительно хотите удалить запись?');">
                    <input type="submit" name="deletePost" value="Удалить">
                </form>
            </div>
        </div>
        <?php } ?>
    </article>
</div>