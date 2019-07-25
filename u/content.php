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
    } elseif ($_GET['m'] == 'pasien') {
        if ($_SESSION['status'] == 'dirut' || $_SESSION['status'] == 'admin') {
            include "module/mod_pasien/pasien.php";
        }
    } elseif ($_GET['m'] == 'petugas') {
        if ($_SESSION['status'] == 'dirut' || $_SESSION['status'] == 'admin') {
            include "module/mod_petugas/petugas.php";
        }
    } elseif ($_GET['m'] == 'dokter') {
        if ($_SESSION['status'] == 'dirut' || $_SESSION['status'] == 'admin') {
            include "module/mod_dokter/dokter.php";
        }
    } elseif ($_GET['m'] == 'direktur') {
        if ($_SESSION['status'] == 'dirut' || $_SESSION['status'] == 'admin') {
            include "module/mod_direktur/direktur.php";
        }
    }
     else {
        echo "Modul <b>$_GET[m]</b> sedang dibuat";
    }
}
