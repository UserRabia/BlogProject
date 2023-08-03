<?php
    $posts = $main->get_posts(array(
        "limit" => 10
    ));
    if (empty($posts)) {
        printf ("Записей нет...");
        return;
    }
?>

<div class="posts">
    <?php
        foreach($posts as $row) { ?>
        <article>
            <h3>
                <a href="/?route=post&id=<?= $row["id"] ?>">
                    <?= $row["title"] ?>
                </a>
            </h3>
            <div class="text">
                <?= nl2br($row["text"]) ?>
            </div>
        </article>
    <?php } ?>
</div>
<script src="/js/ajax.js" type="text/javascript"></script>