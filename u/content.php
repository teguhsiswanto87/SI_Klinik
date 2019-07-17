<?php
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {
    if ($_GET['m'] == 'pengguna') {
        include "module/mod_pengguna/pengguna.php";
    } elseif ($_GET['m'] == 'module') {
        include "module/mod_module/module.php";
    } else {
        echo "Modul <b>$_GET[m]</b> sedang dibuat";
    }
}
