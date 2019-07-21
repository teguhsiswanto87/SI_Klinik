<?php
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {
    $session = session_id();
    ?>
    <div class="ui secondary pointing menu">
        <a class="active item ui label" style="text-transform: capitalize" title="Edit Akun"
           href=<?php echo "media.php?m=pengguna&act=edit&id=$_SESSION[id_pengguna]"; ?>>
            <img class="ui right spaced avatar image"
                 src=<?php echo "$_SESSION[photo]"; ?>>
            <?php echo "$_SESSION[nama]"; ?>
        </a>
        <a class="item" style="cursor: default; text-transform: capitalize;">
            <?php echo $_SESSION['status']; ?>
        </a>
        <div class="right menu">
            <a class="ui item" id="btn-logout" type="submit">Logout</a>
        </div>
    </div>

<?php } ?>
