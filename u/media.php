<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {
    include "../config/functions.php";

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Medical Clinic Administrator</title>
        <link rel="shortcut icon" href="https://img.icons8.com/doodle/48/000000/hospital.png"
              type="image/x-icon">
        <!-- Semantic CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.js"></script>
        <!-- Animate CSS [gak jadi]-->
<!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">-->

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


    <!--  KUMPULAN MODAL  -->
    <!--  delete modal -->
    <div class="ui tiny modal delete" style='width: 25rem;margin: 0 auto;'>
        <div class="header" id="delete-modal-title">Hapus Data ID=</div>
        <div class="content">
            <p id="delete-modal-text">Anda yakin hapus data </p>
        </div>
        <div class="actions">
            <div class="ui cancel red button">Batal</div>
            <div class="ui ok right labeled icon button green">
                Hapus
                <i class='checkmark icon'></i>
            </div>
        </div>
    </div>
    <!-- logout modal -->
    <div class="ui basic modal logout">
        <div class="ui icon header">
            <i class="info circle icon"></i>
            Keluar dari Administrator Medical Clinic?
        </div>
        <div class="content">
            <p> <?php echo "<b style='text-transform: capitalize'> $_SESSION[username]</b>"; ?>, Anda bisa login
                kembali kapan pun dan dimana pun</p>
        </div>
        <div class="actions">
            <div class="ui yellow basic cancel inverted button">
                <i class="remove icon"></i>
                Tidak
            </div>
            <div class="ui blue ok inverted button">
                <i class="checkmark icon"></i>
                Ya
            </div>
        </div>
    </div>

    </body>
    <!-- javascript addition -->
    <script type="text/javascript" src="../assets/app.js"></script>
    <!-- <script type="text/javascript" src="../assets/js/validation.js"></script> -->

    </html>
<?php } ?>