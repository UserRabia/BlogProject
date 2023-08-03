<?php
    session_start();
    include_once "config.php";
    include_once "mainClass.php";

    $main = new Main;

    if($_GET["route"] == "addPosts") {
        $posts = $main->get_posts(array(
            "limit" => 10,
            "start" => (int)$_GET["page"] * 10 + 1,
        ));

        if(empty($posts)) return;
?>

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
<?php } } ?>
