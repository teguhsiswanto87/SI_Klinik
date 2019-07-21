<?php
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    header("location:index.php?error=8");
} else {
    if ($_GET['m'] == 'pengguna') {
        if ($_SESSION['status'] == 'dirut') {
            include "module/mod_pengguna/pengguna.php";
        }
    } elseif ($_GET['m'] == 'module') {
        if ($_SESSION['status'] == 'dirut' || $_SESSION['status'] == 'admin') {
            include "module/mod_module/module.php";
        }
    } else {
        echo "Modul <b>$_GET[m]</b> sedang dibuat";
    }
}
