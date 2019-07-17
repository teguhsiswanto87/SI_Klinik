<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biodata Dosen Page</title>
    <!-- Semantic CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/semantic.min.js"></script>
    <link rel="stylesheet" href="../assets/app.css">

<body>
    <h1 class="ui header center aligned">Apo Shop Sign Up Form</h1>
    <div class="ui grid container">
        <div class="ten wide column">
            <h2 class="ui header center aligned">Manage Your Shop Account</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                Aenean commodo ligula eget Lorem ipsum dolor sit amet,
                consectetuer adipiscing elit. Aenean commodo ligula ege
            </p>
            <img src="https://demo.w3layouts.com/demos_new/template_demo/18-05-2019/gadget_signup_form-demo_Free/1576182126/web/images/b11.png" alt="ini adalah gambar laptop" srcset="" class="ui centered image">


        </div>
        <div class="six wide column">
            <div class="ui grid card-2">
                <div class="sixteen wide column">
                    <h2 class="ui header"></h2>
                    <form class="ui form" method="POST" id="form-pegawai-tambah">
                        <div class="field">
                            <label>Username*</label>
                            <input type="text" name="username" placeholder="Username" autofocus>
                        </div>
                        <div class="field">
                            <label>Nama Pegawai</label>
                            <input type="text" name="nama" placeholder="nama lengkap">
                        </div>
                        <div class="ui grid">
                            <div class="eight wide column">
                                <div class="field">
                                    <label>Jabatan</label>
                                    <input type="text" name="jabatan" placeholder="Jabatan">
                                </div>
                            </div>
                            <div class="eight wide column">
                                <div class="field">
                                    <label>Gender</label>
                                    <div class="ui fluid selection dropdown">
                                        <input type="hidden" name="jenis_kelamin">
                                        <div class="default text">Gender</div>
                                        <i class="dropdown icon"></i>
                                        <div class="menu">
                                            <div class="item" data-value="1">Laki-Laki</div>
                                            <div class="item" data-value="0">Perempuan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ui grid">
                            <div class="eight wide column">
                                <div class="field">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="password">
                                </div>
                            </div>
                            <div class="eight wide column">
                                <div class="field">
                                    <label>Ulangi Password</label>
                                    <input type="password" name="ulangipassword" placeholder="password">
                                </div>
                            </div>
                        </div>
                        <div class="ui error message"></div>
                        <button class="ui fluid primary button" type="submit">Sign Up</button>
                        <p style="margin-bottom: 0.5rem !important;">Have an account,<br> <a href="index.php">Sign In</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- javascript addition -->
<script type="text/javascript" src="../assets/app.js"></script>
<!-- <script type="text/javascript" src="../assets/js/validation.js"></script> -->

</html>