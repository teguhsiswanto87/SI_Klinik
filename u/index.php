<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Klinik- Ngopi Login Administrator</title>
    <!-- Semantic CDN -->
    <link rel="shortcut icon" href="https://img.icons8.com/cotton/64/000000/medical-mobile-app-2.png"
          type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.js"></script>
    <!--additional-->
    <link rel="stylesheet" href="../assets/app.css">

<body>
<h1 class="ui header center aligned">Klinik Login Administrator</h1>
<div class="ui grid container">
    <div class="ten wide column">
        <h3 class="ui header center aligned">Medical Clinic Management</h3>
        <p>
            Anda sebagai administrator dapat memanajemen jadwal dokter, <i>memposting</i> artikel, mengelola data
            pasien,
            mengelola pembayaran, dan mencetak kuitansi
        </p>
        <img src="https://img.icons8.com/clouds/2x/medical-doctor.png"
             alt="ini adalah gambar laptop" srcset="" class="ui centered image"
             style="margin-top: 2rem ;">
    </div>

    <div class="six wide column">
        <div class="ui grid card-2" style="margin-top: 2rem">
            <div class="sixteen wide column">
                <!--                <h2 class="ui header"></h2>-->
                <form class="ui form" method="POST" action="login_check.php" name="formLogin"
                      onsubmit="return loginAuth()">
                    <div class="field">
                        <label>Username*</label>
                        <input type="text" name="username" placeholder="Username" maxlength="50" minlength="4" autofocus
                        >
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" maxlength="50" minlength="4"
                        >
                    </div>
                    <div class="field">

                        <!--  Check error when login  -->
                        <?php
                        include_once "../config/functions.php";
                        $login = new LoginCheck();
                        $login->checkLogin("error");
                        ?>

                    </div>
                    <button class="ui fluid primary button" name="btnLogin" type="submit">Log In</button>
                    <!-- Sign Up di Invisible dulu -->
                    <p style="margin-bottom: 1rem !important; display: none;">
                        Don't have an account,<br>
                        <a href="index-signup.php">SignUp</a>
                    </p>

                </form>
            </div>
        </div>
    </div>
</div>
</body>
<!-- javascript addition -->
<script type="text/javascript" src="../assets/app.js"></script>
<!-- <script type="text/javascript" src="../assets/js/validation.js"></script> -->

</head></html>