<?php
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {

    ?>
    <div class="ui secondary pointing menu">
        <a class="active item ui label" style="text-transform: capitalize">
            <img class="ui right spaced avatar image"
                 src="https://cdn1.iconfinder.com/data/icons/user-interface-1-glyph/32/ui_avatar_profil_user_circle-128.png">
            <?php echo "$_SESSION[full_name]"; ?>
        </a>
        <a class="item" style="cursor: default">
            <?php echo "$_SESSION[position]"; ?>
        </a>
        <div class="right menu">
            <!-- <a class="ui item" href="logout.php" id="btn-logout"> -->
            <!-- Logout -->
            <!-- </a> -->
            <a class="ui item" id="btn-logout" type="submit">Logout</a>
        </div>
    </div>
    <!-- logout modal -->
    <script type="text/javascript" src="../assets/app.js"></script>

    <div class="ui basic modal">
        <div class="ui icon header">
            <i class="bullhorn icon"></i>
            Keluar dari Administrator Web TukuTiket ?
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
    <script>
        $(document).ready(function () {
            $('#btn-logout').click(function () {
                $('.ui.modal').modal({
                    closable: true,
                    onDeny: function () {

                    },
                    onApprove: function () {
                        window.location.href = 'logout.php';
                    }
                }).modal('show');
            });
        });
    </script>
<?php } ?>