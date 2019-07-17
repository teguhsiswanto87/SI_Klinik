<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>TukuTiket Administrator</title>
        <link rel="shortcut icon" href="https://img.icons8.com/cotton/2x/paper-plane--v2.png"
              type="image/x-icon">
        <!-- Semantic CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.js"></script>

    <body>
    <div class="ui grid">
        <!-- side bar -->
        <div class="three wide column">
            <div class=" ui secondary vertical pointing menu" style="width: 100%;">
                <?php include "menu.php"; ?>
            </div>
        </div>
        <!-- content -->
        <div class="thirteen wide column" style="width: 100%;">
            <?php include "header.php"; ?>
            <?php include "content.php"; ?>
        </div>
    </div>
    </body>
    <!-- javascript addition -->
    <script type="text/javascript" src="../assets/app.js"></script>
    <!-- <script type="text/javascript" src="../assets/js/validation.js"></script> -->

    </html>
<?php } ?>