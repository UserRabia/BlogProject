<!DOCTYPE html>

<html>
    <head>
        <link href="/styles/main.css" rel="preload stylesheet" as="style" type="text/css">
        <script src="/js/jquery-3.7.0.min.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <div class="logo">
                <a href="/">
                    <img src="/images/logo.png">
                </a>
            </div>
            <div class="login"> 
                <?php
                    include_once "login.php";
                ?>
            </div>
        </header>
        <main>
            <?php
                if ($_GET["route"]) {
                    include_once $_GET["route"] . ".php";
                }
                else {
                    include_once "homepage.php";
                }
            ?>
        </main>
    </body>
</html>
